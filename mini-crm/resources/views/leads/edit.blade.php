<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Редактировать лид</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto bg-white p-6 shadow rounded">

        <form method="POST" action="{{ route('leads.update',$lead) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Имя</label>
                <input name="full_name" value="{{ $lead->full_name }}" class="border rounded w-full p-2">
            </div>

            <div class="mb-3">
                <label>Телефон</label>
                <input name="phone" value="{{ $lead->phone }}" class="border rounded w-full p-2">
            </div>

            <div class="mb-3">
                <label>Статус</label>
                <select name="status" class="border rounded w-full p-2">
                    @foreach(\App\Enums\LeadStatus::cases() as $status)
                        <option value="{{ $status->value }}" 
                            @selected($lead->status->value === $status->value)>
                            {{ ucfirst(str_replace('_', ' ', $status->value)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Заметка</label>
                <textarea name="note" class="border rounded w-full p-2">{{ $lead->note }}</textarea>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Сохранить
            </button>
        </form>

    </div>
</x-app-layout>
