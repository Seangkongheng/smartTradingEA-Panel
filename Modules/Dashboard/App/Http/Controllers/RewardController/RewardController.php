<?php

namespace Modules\Dashboard\App\Http\Controllers\RewardController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Dashboard\App\Models\Reward;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rewards = Reward::with('users')->get();

        return view('dashboard::reward.index', compact('rewards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::role('user')->get();

        return view('dashboard::reward.createOrUpdate', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_public' => 'required|boolean',
            'users' => 'nullable|array',
        ]);

        $reward = Reward::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_public' => $request->is_public,
        ]);

        $reward->users()->sync($request->users ?? []);

        return redirect()->route('admin.rewards.index')->with('success', 'Reward created successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $reward = Reward::with('users')->findOrFail($id);

        return view('dashboard::reward.show', compact('reward'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rewardEdit = Reward::with('users')->findOrFail($id);
        $users = User::role('user')->get();

        $selectedUsers = $rewardEdit->users->pluck('id')->toArray();

        return view('dashboard::reward.createOrUpdate', compact('rewardEdit', 'users', 'selectedUsers'));
    }

    public function update(Request $request, $id)
    {
        $reward = Reward::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_public' => 'required|boolean',
            'users' => 'nullable|array',
        ]);

        $reward->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_public' => $request->is_public,
        ]);

        $reward->users()->sync($request->users ?? []);

        return redirect()->route('admin.rewards.index')->with('success', 'Reward updated successfully.');
    }

    public function destroy($id)
    {
        $reward = Reward::findOrFail($id);

        $reward->users()->detach();
        $reward->delete();

        return back()->with('success', 'Reward deleted successfully.');
    }
}
