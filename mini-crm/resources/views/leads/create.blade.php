<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Создать лид</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto bg-white p-6 shadow rounded">

        <form method="POST" action="{{ route('leads.store') }}">
            @csrf

            <div class="mb-3">
                <label>Имя</label>
                <input name="full_name" class="border rounded w-full p-2" required>
                @error('full_name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-3">
                <label>Телефон</label>
                <input name="phone" class="border rounded w-full p-2" required>
                @error('phone') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-3">
                <label>Статус</label>
                <select name="status" class="border rounded w-full p-2">
                    <option value="new">Новый</option>
                    <option value="in_progress">В работе</option>
                    <option value="done">Закрыт</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Заметка</label>
                <textarea name="note" class="border rounded w-full p-2"></textarea>
                @error('note') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Создать
            </button>
        </form>

    </div>
</x-app-layout>
