<?php

namespace App\Http\Controllers;

use App\Models\RepairRequest;
use App\Models\User;
use App\Models\Notification;
use App\Http\Requests\StoreRepairRequest;
use App\Http\Requests\UpdateRepairRequest;
use App\Events\RepairStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RepairRequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $repairs = RepairRequest::with(['client', 'master'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } elseif ($user->isMaster()) {
            $repairs = RepairRequest::with(['client'])
                ->where('master_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $repairs = RepairRequest::with(['master'])
                ->where('client_id', $user->id)
                ->orderBy('created_at', 'desc')
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
        $validated = $request->validated();
        $validated['client_id'] = Auth::id();
        $validated['status'] = 'new';

        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('repair-photos', 'public');
                $photos[] = $path;
            }
            $validated['photos'] = $photos;
        }

        $repair = RepairRequest::create($validated);

        Notification::create([
            'user_id' => Auth::id(),
            'repair_request_id' => $repair->id,
            'type' => 'new_request',
            'message' => 'Вашу заявку №' . $repair->id . ' успішно створено',
            'sent_at' => now(),
        ]);

        return redirect()->route('repairs.show', $repair)
            ->with('success', 'Заявку на ремонт створено успішно');
    }

    public function show(RepairRequest $repair)
    {
        $this->authorize('view', $repair);

        $repair->load(['client', 'master', 'statuses.changedBy', 'review']);

        return view('repairs.show', compact('repair'));
    }

    public function edit(RepairRequest $repair)
    {
        $this->authorize('update', $repair);

        if (!$repair->isEditable()) {
            return redirect()->route('repairs.show', $repair)
                ->with('error', 'Цю заявку вже не можна редагувати');
        }

        return view('repairs.edit', compact('repair'));
    }

    public function update(UpdateRepairRequest $request, RepairRequest $repair)
    {
        $this->authorize('update', $repair);

        if (!$repair->isEditable()) {
            return redirect()->route('repairs.show', $repair)
                ->with('error', 'Цю заявку вже не можна редагувати');
        }

        $validated = $request->validated();

        if ($request->hasFile('photos')) {
            if ($repair->photos) {
                foreach ($repair->photos as $photo) {
                    Storage::disk('public')->delete($photo);
                }
            }

            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('repair-photos', 'public');
                $photos[] = $path;
            }
            $validated['photos'] = $photos;
        }

        $repair->update($validated);

        return redirect()->route('repairs.show', $repair)
            ->with('success', 'Заявку оновлено успішно');
    }

    public function destroy(RepairRequest $repair)
    {
        $this->authorize('delete', $repair);

        if ($repair->photos) {
            foreach ($repair->photos as $photo) {
                Storage::disk('public')->delete($photo);
            }
        }

        $repair->delete();

        return redirect()->route('repairs.index')
            ->with('success', 'Заявку видалено');
    }

    public function changeStatus(Request $request, RepairRequest $repair)
    {
        $this->authorize('changeStatus', $repair);

        $request->validate([
            'status' => 'required|in:assigned,in_progress,completed,closed,cancelled',
            'comment' => 'nullable|string|max:500',
        ]);

        $oldStatus = $repair->status;
        $repair->update(['status' => $request->status]);

        if ($request->status === 'completed') {
            $repair->update([
                'completed_at' => now(),
                'actual_completion_date' => now()->toDateString(),
            ]);
        }

        $repair->statuses()->create([
            'status' => $request->status,
            'comment' => $request->comment,
            'changed_by' => Auth::id(),
        ]);

        event(new RepairStatusChanged($repair, $oldStatus, $request->status));

        return redirect()->route('repairs.show', $repair)
            ->with('success', 'Статус змінено успішно');
    }

    public function assignMaster(Request $request, RepairRequest $repair)
    {
        $this->authorize('assign', $repair);

        $request->validate([
            'master_id' => 'required|exists:users,id',
        ]);

        $master = User::findOrFail($request->master_id);

        if (!$master->isMaster()) {
            return back()->with('error', 'Обраний користувач не є майстром');
        }

        $repair->update([
            'master_id' => $master->id,
            'status' => 'assigned',
        ]);

        $repair->statuses()->create([
            'status' => 'assigned',
            'comment' => 'Призначено майстра: ' . $master->name,
            'changed_by' => Auth::id(),
        ]);

        Notification::create([
            'user_id' => $master->id,
            'repair_request_id' => $repair->id,
            'type' => 'new_assignment',
            'message' => 'Вам призначено нову заявку №' . $repair->id,
            'sent_at' => now(),
        ]);

        return redirect()->route('repairs.show', $repair)
            ->with('success', 'Майстра призначено');
    }
}
