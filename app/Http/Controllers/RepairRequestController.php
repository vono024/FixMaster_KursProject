<?php

namespace App\Http\Controllers;

use App\Models\RepairRequest;
use App\Models\User;
use App\Http\Requests\StoreRepairRequest;
use App\Http\Requests\UpdateRepairRequest;
use Illuminate\Http\Request;

class RepairRequestController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'client') {
            $repairs = RepairRequest::where('client_id', $user->id)
                ->with('master')
                ->latest()
                ->paginate(10);
        } elseif ($user->role === 'master') {
            $repairs = RepairRequest::where(function($query) use ($user) {
                $query->where('master_id', $user->id)
                    ->orWhere('status', 'new');
            })
                ->with('client')
                ->latest()
                ->paginate(10);
        } else {
            $repairs = RepairRequest::with(['client', 'master'])
                ->latest()
                ->paginate(10);
        }

        return view('repairs.index', compact('repairs'));
    }

    public function create()
    {
        return view('repairs.create');
    }

    public function store(StoreRepairRequest $request)
    {
        $repair = RepairRequest::create([
            'client_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'device_type' => $request->device_type,
            'scheduled_date' => $request->scheduled_date,
            'status' => 'new',
        ]);

        return redirect()->route('repairs.show', $repair)->with('success', 'Заявку створено успішно!');
    }

    public function show(RepairRequest $repair)
    {
        $user = auth()->user();

        if ($user->role === 'master' && $repair->master_id !== $user->id && $repair->master_id !== null && $repair->status !== 'new') {
            abort(403, 'Немає доступу до цієї заявки');
        }

        if ($user->role === 'client' && $repair->client_id !== $user->id) {
            abort(403, 'Немає доступу до цієї заявки');
        }

        $repair->load(['client', 'master', 'review', 'messages.sender']);

        return view('repairs.show', compact('repair'));
    }

    public function edit(RepairRequest $repair)
    {
        if (!$repair->canBeEditedBy(auth()->user())) {
            abort(403, 'Ви не можете редагувати цю заявку');
        }

        return view('repairs.edit', compact('repair'));
    }

    public function update(UpdateRepairRequest $request, RepairRequest $repair)
    {
        if (!$repair->canBeEditedBy(auth()->user())) {
            abort(403, 'Ви не можете редагувати цю заявку');
        }

        $repair->update($request->validated());

        return redirect()->route('repairs.show', $repair)->with('success', 'Заявку оновлено!');
    }

    public function destroy(RepairRequest $repair)
    {
        if (!$repair->canBeDeletedBy(auth()->user())) {
            abort(403, 'Ви не можете видалити цю заявку');
        }

        $repair->delete();

        return redirect()->route('repairs.index')->with('success', 'Заявку видалено!');
    }

    public function assign(Request $request, RepairRequest $repair)
    {
        $user = auth()->user();

        if ($user->role !== 'master' && $user->role !== 'admin') {
            abort(403);
        }

        if ($repair->status !== 'new') {
            return back()->with('error', 'Цю заявку вже взято в роботу');
        }

        $repair->update([
            'master_id' => $user->id,
            'status' => 'assigned',
        ]);

        return redirect()->route('repairs.show', $repair)->with('success', 'Ви взяли заявку в роботу!');
    }

    public function updateStatus(Request $request, RepairRequest $repair)
    {
        $validated = $request->validate([
            'status' => 'required|in:assigned,in_progress,completed,cancelled',
        ]);

        $repair->update([
            'status' => $validated['status'],
            'completed_at' => $validated['status'] === 'completed' ? now() : null,
        ]);

        if ($validated['status'] === 'completed') {
            return redirect()->route('repairs.show', $repair)->with('success', 'Роботу завершено! Клієнт може залишити відгук.');
        }

        return back()->with('success', 'Статус оновлено!');
    }
}
