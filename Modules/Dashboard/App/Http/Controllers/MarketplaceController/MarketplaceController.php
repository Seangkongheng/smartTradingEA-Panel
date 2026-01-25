<?php

namespace Modules\Dashboard\App\Http\Controllers\MarketplaceController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Dashboard\App\Models\Maketplace;
use Modules\Dashboard\App\Models\MarketplacePlan;
use Modules\Dashboard\App\Models\Plan;

class MarketplaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marketplaces = Maketplace::orderBy('id', 'desc')->get();

        return view('dashboard::marketplace.index', compact('marketplaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plans = Plan::all();
        return view('dashboard::marketplace.createOrUpdate', compact('plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'feature' => 'required',
                'note' => 'nullable',
                'is_public' => 'required'
            ]);

            DB::transaction(function () use ($request) {

                $marketplace = Maketplace::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'feature' => $request->feature,
                    'note' => $request->note,
                    'is_public' => $request->is_public,
                ]);

                foreach ($request->plans as $plan) {
                    if (!isset($plan['plan_id']))
                        continue;

                    MarketplacePlan::create([
                        'marketplace_id' => $marketplace->id,
                        'plan_id' => $plan['plan_id'],
                        'price' => $plan['price'] ?? 0,
                    ]);
                }

            });

            return redirect()->route('admin.marketplace.index')->with('success', 'Marketplace Created');
        } catch (Exception $e) {
            return redirect()->route('admin.marketplace.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $marketplace = Maketplace::find($id);
        return view('dashboard::marketplace.show', compact('marketplace'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $marketplaceEdit = Maketplace::find($id);
        $plans = Plan::all();
        return view('dashboard::marketplace.createOrUpdate', compact('marketplaceEdit', 'plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'feature' => 'required',
                'note' => 'nullable',
                'is_public' => 'required'
            ]);

            DB::transaction(function () use ($request, $id) {

                // Find the marketplace
                $marketplace = Maketplace::findOrFail($id);

                // Update marketplace details
                $marketplace->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'feature' => $request->feature,
                    'note' => $request->note,
                    'is_public' => $request->is_public,
                ]);

                // Delete old plans (or you could sync)
                $marketplace->subscriptionPlans()->delete();

                // Attach new plans
                if ($request->has('plans')) {
                    foreach ($request->plans as $plan) {
                        if (!isset($plan['plan_id']))
                            continue;

                        MarketplacePlan::create([
                            'marketplace_id' => $marketplace->id,
                            'plan_id' => $plan['plan_id'],
                            'price' => $plan['price'] ?? 0,
                        ]);
                    }
                }
            });

            return redirect()->route('admin.marketplace.index')->with('success', 'Marketplace Updated Successfully');

        } catch (Exception $e) {
            return redirect()->route('admin.marketplace.index')->with('error', $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {

                $marketplace = Maketplace::findOrFail($id);
                $marketplace->subscriptionPlans()->delete();
                $marketplace->delete();
            });

            return redirect()->route('admin.marketplace.index')
                ->with('success', 'Marketplace deleted successfully');
        } catch (Exception $e) {
            return redirect()->route('admin.marketplace.index')
                ->with('error', $e->getMessage());
        }
    }

}
