<div class="city-selector-component">
    <!-- Попап -->
    <div class="popup popup-primary popup-city-selector w-[300px] ml-[-150px] sm:w-[600px] sm:ml-[-300px]" >
        <div class="popup_header py-2 relative">
            <h3 class="text-2xl text-blue-primary font-medium">Выберите город</h3>
            <div class="close_popup"></div>
        </div>
        <div class="popup_body px-4 py-4">

            <!-- Поиск -->
            <div class="mb-4">
                <input
                    type="text"
                    id="city-search"
                    placeholder="Поиск по городам..."
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 outline-none"
                    autocomplete="off"
                />
            </div>

            <!-- Форма -->
            <form action="{{ route('region.update') }}" method="POST" id="city-form">
                @csrf
                <input type="hidden" name="city" id="selected-city" required>
                <input type="hidden" name="region_name" id="region_name_input">
                <input type="hidden" name="region_code" id="region_code_input">

                <!-- Список городов -->
                <div id="cities-list" class="grid grid-cols-2 sm:grid-cols-3 gap-2 max-h-60 overflow-y-auto">
                    @foreach ($cities as $city)
                        <label class="city-item flex items-center space-x-2 cursor-pointer hover:bg-gray-100 hover:text-green-primary p-1 rounded">
                            <input
                                type="radio"
                                name="city_option"
                                value="{{ $city->name }}"
                                data-region="{{ $city->region }}"
                                data-code="{{ $city->region_code }}"
                                class="city-radio hidden"
                            >
                            <span>{{ $city->name }}</span>
                        </label>
                    @endforeach
                </div>
            </form>

            <!-- Нет результатов -->
            <div id="no-results" class="text-center text-gray-500 hidden mt-4">
                Города не найдены
            </div>
        </div>
    </div>
</div>

<!-- Скрипт только один раз на странице -->
@pushOnce('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('city-search');
            const cityItems = document.querySelectorAll('.city-item');
            const noResults = document.getElementById('no-results');
            const selectedCityInput = document.getElementById('selected-city');
            const regionNameInput = document.getElementById('region_name_input');
            const regionCodeInput = document.getElementById('region_code_input');
            const form = document.getElementById('city-form');

            // Фокус при открытии попапа (через ваш JS)
            /*document.addEventListener('popupOpened', function (e) {
                if (e.detail.popup === 'popup-city-selector') {
                    setTimeout(() => searchInput?.focus(), 300);
                }
            });*/

            // Фильтрация
            searchInput?.addEventListener('input', function () {
                const query = this.value.toLowerCase().trim();
                let visibleCount = 0;

                cityItems.forEach(item => {
                    const cityName = item.textContent.toLowerCase();
                    if (!query || cityName.includes(query)) {
                        item.style.display = 'flex';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                noResults.classList.toggle('hidden', visibleCount > 0);
            });

            // Выбор города
            document.querySelectorAll('.city-radio').forEach(radio => {
                radio.addEventListener('change', function () {
                    if (this.checked) {
                        selectedCityInput.value = this.value;
                        regionNameInput.value = this.dataset.region || this.value;
                        regionCodeInput.value = this.dataset.code || '';
                        form.submit();
                    }
                });
            });

            // Enter → выбрать первый видимый
            searchInput?.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    const firstVisible = document.querySelector('.city-item[style*="flex"]');
                    if (firstVisible) {
                        const radio = firstVisible.querySelector('.city-radio');
                        radio.checked = true;
                        selectedCityInput.value = radio.value;
                        regionNameInput.value = radio.dataset.region || radio.value;
                        regionCodeInput.value = radio.dataset.code || '';
                        form.submit();
                    }
                }
            });
        });
    </script>
@endPushOnce
