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


    public function show($uuid)
    {
        $marketplace = Maketplace::with('subscriptionPlans.plan')->where('uuid', $uuid)->first();
        return response()->json([
            'marketplace' => $marketplace
        ]);
    }


    public function edit($id)
    {
        return view('apifrontend::edit');
    }


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
