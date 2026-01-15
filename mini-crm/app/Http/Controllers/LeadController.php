<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class LeadController extends Controller
{
    use AuthorizesRequests, DispatchesJobs;
    public function index(Request $request)
    {
        $query = Lead::query()
            ->where('assigned_to', auth()->id());
        if ($request->filled('search')) {
            $search = $request->string('search');

            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        $leads = $query
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('leads.index', compact('leads'));
    }

    public function create()
    {
        return view('leads.create');
    }

    public function store(StoreLeadRequest $request)
    {
        Lead::create([
            'full_name'   => $request->full_name,
            'phone'       => $request->phone,
            'status'      => $request->status,
            'note'        => $request->note,
            'assigned_to' => auth()->id(),
        ]);

        return redirect()
            ->route('leads.index')
            ->with('success', 'Лид успешно создан');
    }

    public function show(Lead $lead)
    {
        $this->authorize('view', $lead);

        $lead->load('tasks');

        return view('leads.show', compact('lead'));
    }


    public function edit(Lead $lead)
    {
        $this->authorize('update', $lead);

        return view('leads.edit', compact('lead'));
    }


    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        $this->authorize('update', $lead);

        $lead->update([
            'full_name' => $request->full_name,
            'phone'     => $request->phone,
            'status'    => $request->status,
            'note'      => $request->note,
        ]);

        return redirect()
            ->route('leads.show', $lead)
            ->with('success', 'Лид обновлён');
    }

    public function destroy(Lead $lead)
    {
        $this->authorize('delete', $lead);

        $lead->delete();

        return redirect()
            ->route('leads.index')
            ->with('success', 'Лид удалён');
    }
}
