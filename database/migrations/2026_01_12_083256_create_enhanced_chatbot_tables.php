<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Table untuk menyimpan intent patterns
        Schema::create('chatbot_intents', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., 'booking', 'faq_price', 'complaint'
            $table->text('description')->nullable();
            $table->json('patterns'); // Array of patterns to match
            $table->json('responses'); // Array of possible responses
            $table->json('actions')->nullable(); // Actions to trigger (e.g., show booking form)
            $table->json('quick_replies')->nullable(); // Suggested replies
            $table->integer('priority')->default(0); // Higher = checked first
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Table untuk menyimpan konteks percakapan
        Schema::create('chatbot_contexts', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->index();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('current_intent')->nullable();
            $table->json('variables')->nullable(); // Store context variables
            $table->integer('step')->default(0); // Current conversation step
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });

        // Table untuk menyimpan FAQ
        Schema::create('chatbot_faqs', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // 'price', 'hours', 'location', etc.
            $table->text('question');
            $table->text('answer');
            $table->json('keywords'); // Keywords for matching
            $table->integer('view_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Update existing chatbot_conversations table
        if (Schema::hasTable('chatbot_conversations')) {
            Schema::table('chatbot_conversations', function (Blueprint $table) {
                if (!Schema::hasColumn('chatbot_conversations', 'intent')) {
                    $table->string('intent')->nullable()->after('message');
                }
                if (!Schema::hasColumn('chatbot_conversations', 'confidence')) {
                    $table->decimal('confidence', 5, 2)->nullable()->after('intent');
                }
                if (!Schema::hasColumn('chatbot_conversations', 'sentiment')) {
                    $table->enum('sentiment', ['positive', 'neutral', 'negative'])->nullable()->after('confidence');
                }
                if (!Schema::hasColumn('chatbot_conversations', 'context_id')) {
                    $table->foreignId('context_id')->nullable()->after('sentiment')->constrained('chatbot_contexts')->onDelete('set null');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatbot_faqs');
        Schema::dropIfExists('chatbot_contexts');
        Schema::dropIfExists('chatbot_intents');

        if (Schema::hasTable('chatbot_conversations')) {
            Schema::table('chatbot_conversations', function (Blueprint $table) {
                $table->dropColumn(['intent', 'confidence', 'sentiment', 'context_id']);
            });
        }
    }
};
