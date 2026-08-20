<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Категория --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Категория
        </label>

        <select
            name="category_id"
            class="w-full rounded-lg border-gray-300"
            required
        >
            <option value="">
                Выберите категорию
            </option>

            @foreach($categories as $category)

                <option
                    value="{{ $category->id }}"
                    @selected(old('category_id', $vehicle->category_id ?? '') == $category->id)
                >
                    {{ $category->name }}
                </option>

            @endforeach

        </select>

        @error('category_id')
            <p class="text-sm text-red-600 mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>


    {{-- Марка --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Марка
        </label>

        <input
            type="text"
            name="brand"
            value="{{ old('brand', $vehicle->brand ?? '') }}"
            class="w-full rounded-lg border-gray-300"
            required
        >
    </div>


    {{-- Модель --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Модель
        </label>

        <input
            type="text"
            name="model"
            value="{{ old('model', $vehicle->model ?? '') }}"
            class="w-full rounded-lg border-gray-300"
            required
        >
    </div>


    {{-- Год --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Год выпуска
        </label>

        <input
            type="number"
            name="year"
            value="{{ old('year', $vehicle->year ?? '') }}"
            class="w-full rounded-lg border-gray-300"
            required
        >
    </div>


    {{-- Госномер --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Госномер
        </label>

        <input
            type="text"
            name="license_plate"
            value="{{ old('license_plate', $vehicle->license_plate ?? '') }}"
            class="w-full rounded-lg border-gray-300"
            required
        >
    </div>


    {{-- VIN --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            VIN
        </label>

        <input
            type="text"
            name="vin"
            value="{{ old('vin', $vehicle->vin ?? '') }}"
            class="w-full rounded-lg border-gray-300"
        >
    </div>


    {{-- Цвет --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Цвет
        </label>

        <input
            type="text"
            name="color"
            value="{{ old('color', $vehicle->color ?? '') }}"
            class="w-full rounded-lg border-gray-300"
        >
    </div>


    {{-- Коробка --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Коробка передач
        </label>

        <select
            name="transmission"
            class="w-full rounded-lg border-gray-300"
        >

            <option value="automatic"
                @selected(old('transmission', $vehicle->transmission ?? '') === 'automatic')
            >
                Автомат
            </option>

            <option value="manual"
                @selected(old('transmission', $vehicle->transmission ?? '') === 'manual')
            >
                Механика
            </option>

        </select>
    </div>


    {{-- Топливо --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Топливо
        </label>

        <select
            name="fuel_type"
            class="w-full rounded-lg border-gray-300"
        >

            @foreach([
                'petrol' => 'Бензин',
                'diesel' => 'Дизель',
                'hybrid' => 'Гибрид',
                'electric' => 'Электро'
            ] as $key=>$label)

                <option
                    value="{{ $key }}"
                    @selected(old('fuel_type', $vehicle->fuel_type ?? '') === $key)
                >
                    {{ $label }}
                </option>

            @endforeach

        </select>
    </div>


    {{-- Места --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Количество мест
        </label>

        <input
            type="number"
            name="seats"
            value="{{ old('seats', $vehicle->seats ?? 5) }}"
            class="w-full rounded-lg border-gray-300"
        >
    </div>


    {{-- Пробег --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Пробег
        </label>

        <input
            type="number"
            name="mileage"
            value="{{ old('mileage', $vehicle->mileage ?? 0) }}"
            class="w-full rounded-lg border-gray-300"
        >
    </div>


    {{-- Цена --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Цена за день (€)
        </label>

        <input
            type="number"
            step="0.01"
            name="daily_rate"
            value="{{ old('daily_rate', $vehicle->daily_rate ?? '') }}"
            class="w-full rounded-lg border-gray-300"
        >
    </div>


    {{-- Статус --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Статус
        </label>

        <select
            name="status"
            class="w-full rounded-lg border-gray-300"
        >

            @foreach([
                'available'=>'Доступен',
                'reserved'=>'Забронирован',
                'rented'=>'В аренде',
                'maintenance'=>'Обслуживание'
            ] as $key=>$label)

                <option
                    value="{{ $key }}"
                    @selected(old('status', $vehicle->status ?? 'available') === $key)
                >
                    {{ $label }}
                </option>

            @endforeach

        </select>
    </div>


</div>


{{-- Описание --}}
<div class="mt-6">

    <label class="block text-sm font-medium text-gray-700 mb-1">
        Описание
    </label>

    <textarea
        name="description"
        rows="4"
        class="w-full rounded-lg border-gray-300"
    >{{ old('description', $vehicle->description ?? '') }}</textarea>

</div>
