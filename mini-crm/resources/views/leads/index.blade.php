<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Лиды</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-4">

        <div class="bg-white p-4 shadow rounded">
            <form method="GET" action="{{ route('leads.index') }}" class="grid grid-cols-4 gap-3">

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Поиск по имени или телефону"
                       class="border rounded p-2 col-span-2"/>

                <select name="status" class="border rounded p-2">
                    <option value="">Все статусы</option>
                    <option value="new" @selected(request('status')=='new')>Новый</option>
                    <option value="in_progress" @selected(request('status')=='in_progress')>В работе</option>
                    <option value="done" @selected(request('status')=='done')>Закрыт</option>
                </select>

                <button class="bg-blue-600 text-white rounded p-2">
                    Фильтровать
                </button>
            </form>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('leads.create') }}"
               class="bg-green-600 text-white px-4 py-2 rounded">
                Создать лид
            </a>
        </div>

        <div class="bg-white shadow rounded">
            <table class="w-full border">
                <thead>
                <tr class="bg-gray-100">
                    <th class="p-2">Имя</th>
                    <th class="p-2">Телефон</th>
                    <th class="p-2">Статус</th>
                    <th class="p-2">Создан</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach($leads as $lead)
                    <tr class="border-b">
                        <td class="p-2">{{ $lead->full_name }}</td>
                        <td class="p-2">{{ $lead->phone }}</td>
                        <td class="p-2">{{ $lead->status }}</td>
                        <td class="p-2">{{ $lead->created_at->format('d.m.Y') }}</td>
                        <td class="p-2 text-right">
                            <a href="{{ route('leads.show',$lead) }}" class="text-blue-600">Открыть</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="p-3">
                {{ $leads->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
