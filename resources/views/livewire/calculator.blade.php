<div>
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 flex items-center justify-center p-4"
        x-data="calculator()">
        <div class="w-full max-w-sm">
            <!-- Calculator Container -->
            <div class="bg-black rounded-3xl shadow-2xl overflow-hidden border border-gray-800">

                <!-- Tab Navigation -->
                <div class="bg-gray-900 p-1 m-4 rounded-2xl flex">
                    <button @click="activeTab = 'calculator'"
                        :class="activeTab === 'calculator' ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white'"
                        class="flex-1 py-3 px-4 rounded-xl font-medium transition-all duration-200 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm1 2a1 1 0 000 2h6a1 1 0 100-2H7zm6 7a1 1 0 011 1v3a1 1 0 11-2 0v-3a1 1 0 011-1zm-3 3a1 1 0 100 2h.01a1 1 0 100-2H10zm-4 1a1 1 0 011-1h.01a1 1 0 110 2H7a1 1 0 01-1-1zm1-4a1 1 0 100 2h.01a1 1 0 100-2H7zm2 0a1 1 0 100 2h.01a1 1 0 100-2H9zm4 0a1 1 0 100 2h.01a1 1 0 100-2H13zm-6-3a1 1 0 100 2h.01a1 1 0 100-2H7zm2 0a1 1 0 100 2h.01a1 1 0 100-2H9zm4 0a1 1 0 100 2h.01a1 1 0 100-2H13z"
                                clip-rule="evenodd" />
                        </svg>
                        Calculator
                    </button>
                    <button @click="activeTab = 'history'"
                        :class="activeTab === 'history' ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white'"
                        class="flex-1 py-3 px-4 rounded-xl font-medium transition-all duration-200 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd" />
                        </svg>
                        History
                    </button>
                </div>

                <!-- Calculator Tab -->
                <div x-show="activeTab === 'calculator'" class="pb-6">

                    <!-- Display Screen -->
                    <div class="bg-gray-800 mx-4 mb-4 rounded-2xl p-6 min-h-[120px] flex flex-col justify-end">
                        @if ($previousCalculation)
                            <div class="text-sm text-gray-400 mb-2 text-right font-mono">{{ $previousCalculation }}
                            </div>
                        @endif
                        <div class="text-4xl text-white text-right font-mono break-all" x-text="display">
                            {{ $display }}</div>
                    </div>

                    <!-- Calculator Buttons -->
                    <div class="px-4 space-y-3">

                        <!-- Row 1: Clear, Backspace, Functions -->
                        <div class="grid grid-cols-4 gap-3">
                            <button @click="clearAll()"
                                class="calculator-btn bg-gray-600 hover:bg-gray-500 text-white">AC</button>
                            <button @click="backspace()"
                                class="calculator-btn bg-gray-600 hover:bg-gray-500 text-white">
                                ⌫
                            </button>
                            <button @click="appendFunction('Math.sqrt(')"
                                class="calculator-btn bg-gray-600 hover:bg-gray-500 text-white">√</button>
                            <button @click="appendOperator('/')"
                                class="calculator-btn bg-orange-500 hover:bg-orange-400 text-white">÷</button>
                        </div>

                        <!-- Row 2: 7, 8, 9, × -->
                        <div class="grid grid-cols-4 gap-3">
                            <button @click="appendNumber('7')"
                                class="calculator-btn bg-gray-700 hover:bg-gray-600 text-white">7</button>
                            <button @click="appendNumber('8')"
                                class="calculator-btn bg-gray-700 hover:bg-gray-600 text-white">8</button>
                            <button @click="appendNumber('9')"
                                class="calculator-btn bg-gray-700 hover:bg-gray-600 text-white">9</button>
                            <button @click="appendOperator('*')"
                                class="calculator-btn bg-orange-500 hover:bg-orange-400 text-white">×</button>
                        </div>

                        <!-- Row 3: 4, 5, 6, - -->
                        <div class="grid grid-cols-4 gap-3">
                            <button @click="appendNumber('4')"
                                class="calculator-btn bg-gray-700 hover:bg-gray-600 text-white">4</button>
                            <button @click="appendNumber('5')"
                                class="calculator-btn bg-gray-700 hover:bg-gray-600 text-white">5</button>
                            <button @click="appendNumber('6')"
                                class="calculator-btn bg-gray-700 hover:bg-gray-600 text-white">6</button>
                            <button @click="appendOperator('-')"
                                class="calculator-btn bg-orange-500 hover:bg-orange-400 text-white">-</button>
                        </div>

                        <!-- Row 4: 1, 2, 3, + -->
                        <div class="grid grid-cols-4 gap-3">
                            <button @click="appendNumber('1')"
                                class="calculator-btn bg-gray-700 hover:bg-gray-600 text-white">1</button>
                            <button @click="appendNumber('2')"
                                class="calculator-btn bg-gray-700 hover:bg-gray-600 text-white">2</button>
                            <button @click="appendNumber('3')"
                                class="calculator-btn bg-gray-700 hover:bg-gray-600 text-white">3</button>
                            <button @click="appendOperator('+')"
                                class="calculator-btn bg-orange-500 hover:bg-orange-400 text-white">+</button>
                        </div>

                        <!-- Row 5: 0, ., = -->
                        <div class="grid grid-cols-4 gap-3">
                            <button @click="appendNumber('0')"
                                class="calculator-btn bg-gray-700 hover:bg-gray-600 text-white col-span-2">0</button>
                            <button @click="appendNumber('.')"
                                class="calculator-btn bg-gray-700 hover:bg-gray-600 text-white">.</button>
                            <button @click="calculate()"
                                class="calculator-btn bg-orange-500 hover:bg-orange-400 text-white">=</button>
                        </div>

                        <!-- Scientific Functions -->
                        <div class="grid grid-cols-4 gap-3 pt-2">
                            <button @click="appendFunction('Math.sin(')"
                                class="calculator-btn bg-blue-600 hover:bg-blue-500 text-white text-sm">sin</button>
                            <button @click="appendFunction('Math.cos(')"
                                class="calculator-btn bg-blue-600 hover:bg-blue-500 text-white text-sm">cos</button>
                            <button @click="appendFunction('Math.tan(')"
                                class="calculator-btn bg-blue-600 hover:bg-blue-500 text-white text-sm">tan</button>
                            <button @click="appendFunction('Math.log(')"
                                class="calculator-btn bg-blue-600 hover:bg-blue-500 text-white text-sm">log</button>
                        </div>
                    </div>
                </div>

                <!-- History Tab -->
                <div x-show="activeTab === 'history'" class="pb-6">
                    <div class="px-6">
                        <div class="space-y-3 max-h-96 overflow-y-auto">
                            @forelse($history as $calc)
                                <div class="bg-gray-800 p-4 rounded-xl cursor-pointer hover:bg-gray-700 transition-all duration-200"
                                    wire:click="$set('display', '{{ $calc['result'] }}')"
                                    @click="activeTab = 'calculator'">
                                    <div class="text-sm text-gray-400 font-mono">{{ $calc['expression'] }}</div>
                                    <div class="text-xl font-semibold text-white font-mono">= {{ $calc['result'] }}
                                    </div>
                                    <div class="text-xs text-gray-500 mt-2">
                                        {{ \Carbon\Carbon::parse($calc['created_at'])->diffForHumans() }}
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <svg class="w-12 h-12 mx-auto text-gray-600 mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-gray-500">No calculations yet</p>
                                    <p class="text-gray-600 text-sm mt-1">Your calculation history will appear here</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function calculator() {
                return {
                    display: '{{ $display }}',
                    activeTab: 'calculator',

                    appendNumber(num) {
                        if (this.display === '0' && num !== '.') {
                            this.display = num;
                        } else {
                            this.display += num;
                        }
                    },

                    appendOperator(op) {
                        // Prevent multiple operators in a row
                        const lastChar = this.display.slice(-1);
                        if (['+', '-', '*', '/'].includes(lastChar)) {
                            this.display = this.display.slice(0, -1) + op;
                        } else {
                            this.display += op;
                        }
                    },

                    appendFunction(func) {
                        if (this.display === '0') {
                            this.display = func;
                        } else {
                            this.display += func;
                        }
                    },

                    clearAll() {
                        this.display = '0';
                        @this.call('clear');
                    },

                    backspace() {
                        if (this.display.length > 1) {
                            this.display = this.display.slice(0, -1);
                        } else {
                            this.display = '0';
                        }
                    },

                    calculate() {
                        @this.call('calculate', this.display);
                        // The display will be updated by Livewire after calculation
                    }
                }
            }
        </script>
    </div>

    <style>
        .calculator-btn {
            height: 60px;
            border-radius: 16px;
            font-size: 24px;
            font-weight: 600;
            transition: all 0.15s ease;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: system-ui, -apple-system, sans-serif;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
        }

        .calculator-btn:active {
            transform: scale(0.95);
        }

        /* Custom scrollbar for history */
        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 3px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
</div>
