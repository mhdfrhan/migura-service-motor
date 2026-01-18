<div class="fixed inset-0 bg-gray-50 flex flex-col">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-lg mx-auto px-4 py-3 flex items-center gap-3">
            <a wire:navigate href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div class="text-2xl">🤖</div>
            <div class="flex-1">
                <h1 class="font-semibold text-gray-900 text-sm">Migura AI Assistant</h1>
                <p class="text-xs text-green-600 relative mt-px flex items-center gap-2">
                    <span class="flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    <span>Online • AI Powered</span>
                </p>
            </div>
            <button wire:click="clearChat" type="button"
                class="text-gray-400 hover:text-red-500 transition-colors p-2 hover:bg-red-50 rounded-lg"
                title="Clear conversation">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Chat Area -->
    <div id="chat-area" class="flex-1 overflow-y-auto scroll-smooth">
        <div class="max-w-lg mx-auto px-4 py-4 space-y-4">
            <!-- Messages -->
            @foreach ($messages as $message)
                <div wire:key="msg-{{ $message['id'] }}"
                    class="flex gap-2 items-end {{ $message['type'] === 'user' ? 'flex-row-reverse' : '' }}">
                    <!-- Bot Avatar -->
                    @if ($message['type'] === 'bot')
                        <div class="text-xl flex-shrink-0">🤖</div>
                    @endif

                    <!-- Message Bubble -->
                    <div class="max-w-[75%]">
                        <div
                            class="px-4 py-3 rounded-2xl shadow-sm {{ $message['type'] === 'user' ? 'bg-sky-500 text-white rounded-tr-none' : 'bg-white text-gray-900 rounded-tl-none border border-gray-200' }}">
                            <p class="text-sm leading-relaxed whitespace-pre-line">{{ $message['text'] }}</p>
                        </div>
                        <div class="flex items-center gap-2 mt-1 px-1">
                            <span
                                class="text-xs {{ $message['type'] === 'user' ? 'text-gray-600 text-right' : 'text-gray-500' }}">
                                {{ $message['timestamp'] }}
                            </span>
                            @if ($message['type'] === 'bot' && isset($message['intent']))
                                <span class="text-xs text-gray-400">
                                    • {{ ucwords(str_replace('_', ' ', $message['intent'])) }}
                                    @if (isset($message['confidence']))
                                        ({{ number_format($message['confidence'], 0) }}%)
                                    @endif
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Typing Indicator -->
            @if ($isTyping)
                <div class="flex gap-2 items-end" wire:key="typing">
                    <div class="text-xl">🤖</div>
                    <div class="bg-white border border-gray-200 rounded-2xl rounded-tl-none px-4 py-3 shadow-sm">
                        <div class="flex gap-1">
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 150ms">
                            </div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 300ms">
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Quick Reply Buttons -->
            @if (!empty($quickReplies))
                <div class="space-y-2 pt-2">
                    <p class="text-xs text-gray-500 font-medium px-1">Quick Replies:</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($quickReplies as $index => $reply)
                            <button wire:key="quick-{{ $index }}"
                                wire:click="selectQuickReply('{{ $reply }}')" type="button"
                                class="px-4 py-2 bg-white hover:bg-sky-50 border border-gray-300 hover:border-sky-400 text-sky-600 text-sm rounded-xl transition-all shadow-sm hover:shadow">
                                {{ $reply }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Message Input Area -->
    <div class="bg-white border-t border-gray-200 shadow-lg">
        <div class="max-w-lg mx-auto px-4 py-3">
            <form wire:submit.prevent="sendMessage" class="flex items-center gap-2">
                <!-- Input Field -->
                <input wire:model="userInput" type="text" placeholder="Ketik pesan Anda..." autocomplete="off"
                    class="flex-1 px-4 py-3 bg-gray-100 border-0 rounded-full text-sm focus:ring-2 focus:ring-sky-400 focus:bg-white transition-all">

                <!-- Send Button -->
                <button type="submit" wire:loading.attr="disabled"
                    class="w-10 h-10 bg-sky-500 hover:bg-sky-600 disabled:bg-gray-300 disabled:cursor-not-allowed rounded-full flex items-center justify-center transition-colors flex-shrink-0 shadow-md hover:shadow-lg">
                    <svg wire:loading.remove class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    <svg wire:loading class="w-5 h-5 text-white animate-spin" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                </button>
            </form>
            <p class="text-xs text-gray-400 mt-2 text-center flex items-center justify-center gap-2">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Powered by AI • Intent Recognition • Context-Aware
            </p>
        </div>
    </div>

    @script
        <script>
            // Auto-scroll to bottom when new message arrives
            $wire.on('scroll-to-bottom', () => {
                setTimeout(() => {
                    const chatArea = document.getElementById('chat-area');
                    if (chatArea) {
                        chatArea.scrollTop = chatArea.scrollHeight;
                    }
                }, 100);
            });

            // Handle redirects
            $wire.on('redirect', (url) => {
                window.location.href = url[0];
            });

            // Auto-scroll on initial load
            document.addEventListener('DOMContentLoaded', () => {
                setTimeout(() => {
                    const chatArea = document.getElementById('chat-area');
                    if (chatArea) {
                        chatArea.scrollTop = chatArea.scrollHeight;
                    }
                }, 300);
            });
        </script>
    @endscript
</div>
