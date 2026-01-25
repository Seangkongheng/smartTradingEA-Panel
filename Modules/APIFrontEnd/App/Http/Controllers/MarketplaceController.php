<?php

namespace Modules\APIFrontEnd\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\Maketplace;

class MarketplaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marketplaces = Maketplace::with([
            'subscriptionPlans.plan'
        ])
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'marketplaces' => $marketplaces
        ]);
    }


    public function show($id)
    {
        $marketplace = Maketplace::with('subscriptionPlans.plan')->findOrFail($id);
        return response()->json([
            'marketplace'=>$marketplace
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('apifrontend::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
