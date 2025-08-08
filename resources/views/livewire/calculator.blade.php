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
                        Calculator
                    </button>
                    <button @click="activeTab = 'history'"
                        :class="activeTab === 'history' ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white'"
                        class="flex-1 py-3 px-4 rounded-xl font-medium transition-all duration-200 flex items-center justify-center gap-2">
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

                    <!-- Buttons -->
                    <div class="px-4 space-y-3">
                        <div class="grid grid-cols-4 gap-3">
                            <button @click="clearAll()" class="calculator-btn bg-gray-600 text-white">AC</button>
                            <button @click="backspace()" class="calculator-btn bg-gray-600 text-white">⌫</button>
                            <button @click="appendParentheses()" class="calculator-btn bg-gray-600 text-white">(
                                )</button>
                            <button @click="appendOperator('/')"
                                class="calculator-btn bg-orange-500 text-white">÷</button>
                        </div>
                        <div class="grid grid-cols-4 gap-3">
                            <button @click="appendNumber('7')" class="calculator-btn bg-gray-700 text-white">7</button>
                            <button @click="appendNumber('8')" class="calculator-btn bg-gray-700 text-white">8</button>
                            <button @click="appendNumber('9')" class="calculator-btn bg-gray-700 text-white">9</button>
                            <button @click="appendOperator('*')"
                                class="calculator-btn bg-orange-500 text-white">×</button>
                        </div>
                        <div class="grid grid-cols-4 gap-3">
                            <button @click="appendNumber('4')" class="calculator-btn bg-gray-700 text-white">4</button>
                            <button @click="appendNumber('5')" class="calculator-btn bg-gray-700 text-white">5</button>
                            <button @click="appendNumber('6')" class="calculator-btn bg-gray-700 text-white">6</button>
                            <button @click="appendOperator('-')"
                                class="calculator-btn bg-orange-500 text-white">-</button>
                        </div>
                        <div class="grid grid-cols-4 gap-3">
                            <button @click="appendNumber('1')" class="calculator-btn bg-gray-700 text-white">1</button>
                            <button @click="appendNumber('2')" class="calculator-btn bg-gray-700 text-white">2</button>
                            <button @click="appendNumber('3')" class="calculator-btn bg-gray-700 text-white">3</button>
                            <button @click="appendOperator('+')"
                                class="calculator-btn bg-orange-500 text-white">+</button>
                        </div>
                        <div class="grid grid-cols-4 gap-3">
                            <button @click="appendNumber('0')"
                                class="calculator-btn bg-gray-700 text-white col-span-2">0</button>
                            <button @click="appendNumber('.')" class="calculator-btn bg-gray-700 text-white">.</button>
                            <button @click="calculate()" class="calculator-btn bg-orange-500 text-white">=</button>
                        </div>
                        <div class="grid grid-cols-4 gap-3 pt-2">
                            <button @click="appendFunction('sin(')"
                                class="calculator-btn bg-blue-600 text-white text-sm">sin</button>
                            <button @click="appendFunction('cos(')"
                                class="calculator-btn bg-blue-600 text-white text-sm">cos</button>
                            <button @click="appendFunction('tan(')"
                                class="calculator-btn bg-blue-600 text-white text-sm">tan</button>
                            <button @click="appendFunction('sqrt(')"
                                class="calculator-btn bg-blue-600 text-white text-sm">√</button>
                        </div>
                        <div class="grid grid-cols-4 gap-3 pt-2">
                            <button @click="appendFunction('log(')"
                                class="calculator-btn bg-purple-600 text-white text-sm">log</button>
                            <button @click="appendFunction('pow(')"
                                class="calculator-btn bg-purple-600 text-white text-sm">x^y</button>
                            <button @click="appendNumber('3.14159')"
                                class="calculator-btn bg-purple-600 text-white text-sm">π</button>
                            <button @click="appendFunction('abs(')"
                                class="calculator-btn bg-purple-600 text-white text-sm">|x|</button>
                        </div>
                    </div>
                </div>

                <!-- History Tab -->
                <div x-show="activeTab === 'history'" class="pb-6">
                    <div class="px-6">
                        <div class="space-y-3 max-h-96 overflow-y-auto">
                            @forelse($history as $calc)
                                <div class="bg-gray-800 p-4 rounded-xl cursor-pointer hover:bg-gray-700"
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
                                <div class="text-center py-12 text-gray-500">No calculations yet</div>
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
                            const lastChar = this.display.slice(-1);
                            if (!isNaN(lastChar) || lastChar === ')') {
                                this.display += '*' + func;
                            } else {
                                this.display += func;
                            }
                        }
                    },
                    appendParentheses() {
                        const openCount = (this.display.match(/\(/g) || []).length;
                        const closeCount = (this.display.match(/\)/g) || []).length;
                        const lastChar = this.display.slice(-1);
                        if (openCount === closeCount) {
                            if (this.display === '0') {
                                this.display = '(';
                            } else if (!isNaN(lastChar) || lastChar === ')') {
                                this.display += '*(';
                            } else {
                                this.display += '(';
                            }
                        } else {
                            this.display += ')';
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
                    },
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
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</div>
