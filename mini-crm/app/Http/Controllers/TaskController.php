<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests, DispatchesJobs;

    public function store(StoreTaskRequest $request, Lead $lead)
    {
        $this->authorize('view', $lead);

        $lead->tasks()->create([
            'title'   => $request->title,
            'due_at'  => $request->due_at,
            'is_done' => false,
        ]);

        return back()->with('success', 'Задача добавлена');
    }

    public function create(StoreTaskRequest $request, Lead $lead)
    {
        $this->authorize('view', $lead);

        $lead->tasks()->create([
            'title'   => $request->title,
            'due_at'  => $request->due_at,
            'is_done' => false,
        ]);

        return back()->with('success', 'Задача добавлена');
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', arguments: $task->lead);

        $task->update([
            'title'   => $request->title ?? $task->title,
            'due_at'  => $request->due_at ?? $task->due_at,
            'is_done' => $request->boolean('is_done', $task->is_done),
        ]);

        return back()->with('success', 'Задача обновлена');
    }


    public function destroy(Task $task)
    {
        $task->load('lead');
        $this->authorize('delete', $task);

        $task->delete();

        return back()->with('success', 'Задача удалена');
    }
}
