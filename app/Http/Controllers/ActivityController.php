<?php
namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::with(['latestUpdate.user'])->latest()->get();
        return view('activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $activity = Activity::create($validated);

        // Create initial update as pending
        ActivityUpdate::create([
            'activity_id' => $activity->id,
            'user_id'     => Auth::id(),
            'status'      => 'pending',
            'remark'      => 'Activity created',
        ]);

        return redirect()->route('activities.index')->with('success', 'Activity created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        $activity->load(['updates.user']);
        return view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        return view('activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $activity->update($validated);

        return redirect()->route('activities.index')->with('success', 'Activity updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activities.index')->with('success', 'Activity deleted successfully.');
    }

    /**
     * Update the status of an activity.
     */
    public function updateStatus(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,done',
            'remark' => 'nullable|string',
        ]);

        ActivityUpdate::create([
            'activity_id' => $activity->id,
            'user_id'     => Auth::id(),
            'status'      => $validated['status'],
            'remark'      => $validated['remark'],
        ]);

        return back()->with('success', 'Status updated successfully.');
    }

    /**
     * Show daily activities view.
     */
    public function daily(Request $request)
    {
        $date = $request->input('date', now()->toDateString());

        $updates = ActivityUpdate::with(['activity', 'user'])
            ->whereDate('created_at', $date)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('activities.daily', compact('updates', 'date'));
    }

    /**
     * Show reporting view.
     */
    public function report(Request $request)
    {
        $query = ActivityUpdate::with(['activity', 'user']);

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $updates = $query->orderBy('created_at', 'desc')->paginate(20);
        $users   = \App\Models\User::all();

        return view('activities.report', compact('updates', 'users'));
    }
}
