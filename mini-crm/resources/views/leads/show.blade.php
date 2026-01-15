<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Карточка лида</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto space-y-6">

        <div class="bg-white p-6 shadow rounded">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-bold">{{ $lead->full_name }}</h3>
                    <p class="mt-1">Телефон: {{ $lead->phone }}</p>
                    <p>Статус: 
                        <span class="font-medium text-sm 
                            @if(($lead->status->value ?? $lead->status) === 'new') text-blue-600
                            @elseif(($lead->status->value ?? $lead->status) === 'in_progress') text-yellow-600
                            @else text-green-600 @endif">
                            {{ ucfirst($lead->status->value ?? $lead->status) }}
                        </span>
                    </p>
                </div>
                @if($lead->assigned_to === auth()->id())
                    <div class="space-x-3">
                        <a href="{{ route('leads.edit', $lead) }}" class="text-blue-600 hover:underline">Редактировать</a>

                        <form action="{{ route('leads.destroy', $lead) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Удалить</button>
                        </form>
                    </div>
                @endif
            </div>

            @if($lead->note)
                <p class="mt-3 text-gray-700">{{ $lead->note }}</p>
            @endif
        </div>

        <div class="bg-white p-6 shadow rounded">
            <h3 class="font-bold mb-3">Задачи</h3>

            @if($lead->assigned_to === auth()->id())
                <form method="POST" action="{{ route('tasks.store', $lead) }}" class="mb-4">
                    @csrf
                    <div class="flex gap-2">
                        <input name="title" class="border rounded p-2 w-full" placeholder="Название задачи" required>
                        <input type="datetime-local" name="due_at" class="border rounded p-2">
                        <button class="bg-green-600 text-white px-4 rounded hover:bg-green-700 transition">
                            Добавить
                        </button>
                    </div>
                </form>
            @else
                <p class="text-red-600 mb-4">Вы не можете добавлять задачи к этому лиду.</p>
            @endif

            @if($lead->tasks->isEmpty())
                <p class="text-gray-500">Задач пока нет.</p>
            @else
                <table class="w-full border-collapse border">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="p-2 text-left">Название</th>
                            <th class="p-2 text-left">Срок</th>
                            <th class="p-2 text-left">Статус</th>
                            @if($lead->assigned_to === auth()->id())
                                <th class="p-2 text-right">Действия</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lead->tasks as $task)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-2">{{ $task->title }}</td>
                                <td class="p-2">{{ $task->due_at ?? '—' }}</td>
                                <td class="p-2">{{ $task->is_done ? '✔ Выполнено' : '— В работе' }}</td>

                                @if($lead->assigned_to === auth()->id())
                                    <td class="p-2 text-right space-x-2">

                                        <form method="POST" action="{{ route('tasks.update', $task) }}" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="is_done" value="{{ $task->is_done ? 0 : 1 }}">
                                            <button class="text-blue-600 hover:underline">
                                                {{ $task->is_done ? 'Снять' : 'Выполнить' }}
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:underline">Удалить</button>
                                        </form>

                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>
</x-app-layout>
