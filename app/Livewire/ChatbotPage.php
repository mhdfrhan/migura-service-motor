<?php

namespace App\Livewire;

use App\Services\ChatbotService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class ChatbotPage extends Component
{
    public $messages = [];

    public $userInput = '';

    public $sessionId;

    public $quickReplies = [];

    public $isTyping = false;

    protected $chatbotService;

    public function boot(ChatbotService $chatbotService)
    {
        $this->chatbotService = $chatbotService;
    }

    public function mount()
    {
        // Generate or retrieve session ID
        $this->sessionId = session('chatbot_session_id', Str::uuid()->toString());
        session(['chatbot_session_id' => $this->sessionId]);

        // Load conversation history if exists
        $this->loadHistory();

        // Send initial greeting if no history
        if (empty($this->messages)) {
            $this->sendInitialGreeting();
        }
    }

    public function sendMessage()
    {
        if (empty(trim($this->userInput))) {
            return;
        }

        $userMessage = trim($this->userInput);
        $this->userInput = '';

        // Add user message to UI
        $this->messages[] = [
            'id' => Str::uuid()->toString(),
            'type' => 'user',
            'text' => $userMessage,
            'timestamp' => now()->format('H:i'),
        ];

        // Show typing indicator
        $this->isTyping = true;

        // Process message through chatbot service
        $response = $this->chatbotService->processMessage(
            $userMessage,
            Auth::id(),
            $this->sessionId
        );

        // Simulate typing delay
        usleep(800000); // 0.8 seconds

        // Hide typing indicator
        $this->isTyping = false;

        // Add bot response to UI
        $this->messages[] = [
            'id' => Str::uuid()->toString(),
            'type' => 'bot',
            'text' => $response['response'],
            'timestamp' => now()->format('H:i'),
            'intent' => $response['intent'],
            'confidence' => $response['confidence'],
            'sentiment' => $response['sentiment'],
        ];

        // Update quick replies
        $this->quickReplies = $response['quick_replies'] ?? [];

        // Handle actions
        if (! empty($response['actions'])) {
            $this->handleActions($response['actions']);
        }

        // Dispatch event to scroll to bottom
        $this->dispatch('scroll-to-bottom');
    }

    public function selectQuickReply($reply)
    {
        $this->userInput = $reply;
        $this->sendMessage();
    }

    public function clearChat()
    {
        $this->messages = [];
        $this->quickReplies = [];
        $this->sessionId = Str::uuid()->toString();
        session(['chatbot_session_id' => $this->sessionId]);
        $this->sendInitialGreeting();
    }

    private function loadHistory()
    {
        $history = $this->chatbotService->getConversationHistory($this->sessionId, 50);

        foreach ($history as $item) {
            $this->messages[] = [
                'id' => $item['id'] ?? Str::uuid()->toString(),
                'type' => $item['sender'],
                'text' => $item['message'],
                'timestamp' => date('H:i', strtotime($item['created_at'])),
            ];
        }
    }

    private function sendInitialGreeting()
    {
        $greetingTime = (int) date('H');
        $greeting = 'Selamat malam';

        if ($greetingTime < 12) {
            $greeting = 'Selamat pagi';
        } elseif ($greetingTime < 15) {
            $greeting = 'Selamat siang';
        } elseif ($greetingTime < 18) {
            $greeting = 'Selamat sore';
        }

        $userName = Auth::check() ? Auth::user()->name : 'teman';

        $message = "$greeting, $userName! 👋\n\nSaya adalah Asisten Migura dengan teknologi AI. Ada yang bisa saya bantu hari ini?";

        $this->messages[] = [
            'id' => Str::uuid()->toString(),
            'type' => 'bot',
            'text' => $message,
            'timestamp' => now()->format('H:i'),
        ];

        $this->quickReplies = [
            'Booking sekarang',
            'Lihat harga',
            'Jam operasional',
            'Lokasi kami',
        ];
    }

    private function handleActions(array $actions)
    {
        foreach ($actions as $action) {
            if ($action === 'redirect_to_booking') {
                $this->dispatch('redirect', route('booking.index'));
            }
        }
    }

    public function render()
    {
        return view('livewire.chatbot-page')->layout('layouts.main');
    }
}
