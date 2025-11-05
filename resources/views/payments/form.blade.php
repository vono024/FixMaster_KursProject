<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Оплата заявки #{{ $repair->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ $repair->title }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $repair->device_type }}</p>
                </div>

                <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 mb-6">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 dark:text-gray-300">Вартість ремонту:</span>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($repair->final_cost, 2) }} грн</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('payments.process', $repair) }}" id="payment-form">
                    @csrf

                    <input type="hidden" name="amount" value="{{ $repair->final_cost }}">

                    <div class="mb-6">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-3">
                            Оберіть спосіб оплати
                        </label>

                        <div class="space-y-3">
                            <label class="flex items-center p-4 border-2 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition
                                {{ old('payment_method') === 'card' ? 'border-blue-500 bg-blue-50 dark:bg-blue-900' : 'border-gray-300 dark:border-gray-600' }}">
                                <input type="radio" name="payment_method" value="card" required
                                       class="w-4 h-4 text-blue-600 focus:ring-blue-500"
                                    {{ old('payment_method') === 'card' ? 'checked' : '' }}>
                                <div class="ml-3">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">💳 Банківська картка</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Visa, MasterCard</div>
                                </div>
                            </label>

                            <label class="flex items-center p-4 border-2 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition
                                {{ old('payment_method') === 'online' ? 'border-blue-500 bg-blue-50 dark:bg-blue-900' : 'border-gray-300 dark:border-gray-600' }}">
                                <input type="radio" name="payment_method" value="online" required
                                       class="w-4 h-4 text-blue-600 focus:ring-blue-500"
                                    {{ old('payment_method') === 'online' ? 'checked' : '' }}>
                                <div class="ml-3">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">🌐 Онлайн-банкінг</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Privat24, Monobank</div>
                                </div>
                            </label>

                            <label class="flex items-center p-4 border-2 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition
                                {{ old('payment_method') === 'cash' ? 'border-blue-500 bg-blue-50 dark:bg-blue-900' : 'border-gray-300 dark:border-gray-600' }}">
                                <input type="radio" name="payment_method" value="cash" required
                                       class="w-4 h-4 text-blue-600 focus:ring-blue-500"
                                    {{ old('payment_method') === 'cash' ? 'checked' : '' }}>
                                <div class="ml-3">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">💵 Готівка</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">При отриманні</div>
                                </div>
                            </label>
                        </div>

                        @error('payment_method')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex space-x-3">
                        <button type="submit" id="submit-btn"
                                class="flex-1 bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded">
                            <span id="btn-text">Оплатити {{ number_format($repair->final_cost, 2) }} грн</span>
                            <span id="btn-loading" class="hidden">Обробка...</span>
                        </button>
                        <a href="{{ route('repairs.show', $repair) }}"
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-4 rounded">
                            Скасувати
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('payment-form').addEventListener('submit', function() {
            document.getElementById('submit-btn').disabled = true;
            document.getElementById('btn-text').classList.add('hidden');
            document.getElementById('btn-loading').classList.remove('hidden');
        });
    </script>
</x-app-layout>
