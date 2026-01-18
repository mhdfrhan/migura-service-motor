<?php

namespace App\Services;

use App\Models\ChatbotContext;
use App\Models\ChatbotConversation;
use App\Models\ChatbotFaq;
use App\Models\ChatbotIntent;
use Illuminate\Support\Str;

class ChatbotService
{
    /**
     * Process user message and generate response
     */
    public function processMessage(string $message, ?int $userId = null, ?string $sessionId = null): array
    {
        // Generate session ID if not provided
        $sessionId = $sessionId ?? Str::uuid()->toString();

        // Clean and normalize message
        $normalizedMessage = $this->normalizeMessage($message);

        // Get or create context
        $context = $this->getOrCreateContext($sessionId, $userId);

        // Detect intent
        $intentData = $this->detectIntent($normalizedMessage);

        // Detect sentiment
        $sentiment = $this->detectSentiment($normalizedMessage);

        // Generate response
        $response = $this->generateResponse($intentData, $context);

        // Update context
        $this->updateContext($context, $intentData['name'], $response);

        // Save conversation
        $this->saveConversation($userId, $sessionId, $message, $response, $intentData, $sentiment, $context->id);

        return [
            'response' => $response['message'],
            'quick_replies' => $response['quick_replies'] ?? [],
            'actions' => $response['actions'] ?? [],
            'intent' => $intentData['name'],
            'confidence' => $intentData['confidence'],
            'sentiment' => $sentiment,
            'session_id' => $sessionId,
        ];
    }

    /**
     * Normalize user message for better matching
     */
    private function normalizeMessage(string $message): string
    {
        // Convert to lowercase
        $message = mb_strtolower($message, 'UTF-8');

        // Remove special characters except spaces and question marks
        $message = preg_replace('/[^\p{L}\p{N}\s\?]/u', '', $message);

        // Remove extra whitespace
        $message = preg_replace('/\s+/', ' ', $message);

        return trim($message);
    }

    /**
     * Detect intent from user message using pattern matching
     */
    private function detectIntent(string $message): array
    {
        $intents = ChatbotIntent::active()->ordered()->get();
        $bestMatch = null;
        $highestScore = 0;

        foreach ($intents as $intent) {
            $score = $this->calculateIntentScore($message, $intent);

            if ($score > $highestScore) {
                $highestScore = $score;
                $bestMatch = $intent;
            }
        }

        // Fallback intent if no match
        if (! $bestMatch || $highestScore < 0.3) {
            $bestMatch = ChatbotIntent::where('name', 'fallback')->first();
            $highestScore = 0.5;
        }

        return [
            'name' => $bestMatch->name,
            'intent' => $bestMatch,
            'confidence' => round($highestScore * 100, 2),
        ];
    }

    /**
     * Calculate intent matching score
     */
    private function calculateIntentScore(string $message, ChatbotIntent $intent): float
    {
        $patterns = $intent->patterns;
        $maxScore = 0;

        foreach ($patterns as $pattern) {
            // Exact match
            if ($message === mb_strtolower($pattern, 'UTF-8')) {
                return 1.0;
            }

            // Contains pattern
            if (str_contains($message, mb_strtolower($pattern, 'UTF-8'))) {
                $score = 0.8;
                $maxScore = max($maxScore, $score);
            }

            // Word match (tokenization)
            $messageWords = explode(' ', $message);
            $patternWords = explode(' ', mb_strtolower($pattern, 'UTF-8'));
            $matchingWords = count(array_intersect($messageWords, $patternWords));

            if ($matchingWords > 0) {
                $score = $matchingWords / max(count($messageWords), count($patternWords));
                $maxScore = max($maxScore, $score);
            }

            // Levenshtein distance for similarity
            $distance = levenshtein($message, mb_strtolower($pattern, 'UTF-8'));
            $maxLength = max(strlen($message), strlen($pattern));
            if ($maxLength > 0) {
                $similarity = 1 - ($distance / $maxLength);
                if ($similarity > 0.7) {
                    $maxScore = max($maxScore, $similarity);
                }
            }
        }

        return $maxScore;
    }

    /**
     * Detect sentiment from user message
     */
    private function detectSentiment(string $message): string
    {
        $positiveWords = ['bagus', 'mantap', 'suka', 'senang', 'puas', 'terima kasih', 'thanks', 'good', 'great', 'excellent', 'baik', 'oke'];
        $negativeWords = ['jelek', 'buruk', 'kecewa', 'mahal', 'lama', 'complaint', 'komplain', 'tidak puas', 'bad', 'poor', 'masalah'];

        $positiveCount = 0;
        $negativeCount = 0;

        foreach ($positiveWords as $word) {
            if (str_contains($message, $word)) {
                $positiveCount++;
            }
        }

        foreach ($negativeWords as $word) {
            if (str_contains($message, $word)) {
                $negativeCount++;
            }
        }

        if ($negativeCount > $positiveCount) {
            return 'negative';
        }

        if ($positiveCount > $negativeCount) {
            return 'positive';
        }

        return 'neutral';
    }

    /**
     * Generate response based on intent and context
     */
    private function generateResponse(array $intentData, ChatbotContext $context): array
    {
        $intent = $intentData['intent'];
        $responses = $intent->responses;

        // Select random response for variety
        $message = $responses[array_rand($responses)];

        // Get quick replies
        $quickReplies = $intent->quick_replies ?? [];

        // Get actions
        $actions = $intent->actions ?? [];

        // Context-aware modifications
        if ($context->step > 0) {
            $message = $this->addContextualInfo($message, $context);
        }

        return [
            'message' => $message,
            'quick_replies' => $quickReplies,
            'actions' => $actions,
        ];
    }

    /**
     * Add contextual information to response
     */
    private function addContextualInfo(string $message, ChatbotContext $context): string
    {
        $variables = $context->variables ?? [];

        foreach ($variables as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }

        return $message;
    }

    /**
     * Get or create context for session
     */
    private function getOrCreateContext(string $sessionId, ?int $userId = null): ChatbotContext
    {
        $context = ChatbotContext::where('session_id', $sessionId)
            ->active()
            ->first();

        if (! $context) {
            $context = ChatbotContext::create([
                'session_id' => $sessionId,
                'user_id' => $userId,
                'current_intent' => null,
                'variables' => [],
                'step' => 0,
                'expires_at' => now()->addHours(24),
            ]);
        }

        return $context;
    }

    /**
     * Update context with new intent and response
     */
    private function updateContext(ChatbotContext $context, string $intentName, array $response): void
    {
        $context->update([
            'current_intent' => $intentName,
            'step' => $context->step + 1,
            'expires_at' => now()->addHours(24),
        ]);
    }

    /**
     * Save conversation to database
     */
    private function saveConversation(
        ?int $userId,
        string $sessionId,
        string $userMessage,
        array $botResponse,
        array $intentData,
        string $sentiment,
        int $contextId
    ): void {
        // Save user message
        ChatbotConversation::create([
            'user_id' => $userId,
            'session_id' => $sessionId,
            'sender' => 'user',
            'message' => $userMessage,
            'intent' => $intentData['name'],
            'confidence' => $intentData['confidence'],
            'sentiment' => $sentiment,
            'context_id' => $contextId,
        ]);

        // Save bot response
        ChatbotConversation::create([
            'user_id' => $userId,
            'session_id' => $sessionId,
            'sender' => 'bot',
            'message' => $botResponse['message'],
            'intent' => $intentData['name'],
            'context_id' => $contextId,
        ]);
    }

    /**
     * Search FAQs by keywords
     */
    public function searchFAQs(string $query): array
    {
        $normalizedQuery = $this->normalizeMessage($query);
        $queryWords = explode(' ', $normalizedQuery);

        $faqs = ChatbotFaq::active()
            ->get()
            ->map(function ($faq) use ($queryWords) {
                $score = 0;
                $keywords = $faq->keywords;

                foreach ($queryWords as $word) {
                    foreach ($keywords as $keyword) {
                        if (str_contains(mb_strtolower($keyword, 'UTF-8'), $word)) {
                            $score++;
                        }
                    }
                }

                $faq->score = $score;

                return $faq;
            })
            ->filter(fn($faq) => $faq->score > 0)
            ->sortByDesc('score')
            ->take(5)
            ->values()
            ->toArray();

        return $faqs;
    }

    /**
     * Get conversation history
     */
    public function getConversationHistory(string $sessionId, int $limit = 20): array
    {
        return ChatbotConversation::where('session_id', $sessionId)
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get()
            ->reverse()
            ->values()
            ->toArray();
    }
}
