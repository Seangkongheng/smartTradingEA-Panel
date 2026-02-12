<?php

namespace Modules\Dashboard\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Dashboard\App\Models\TradingAccount;

class TradingAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tradingAccounts = TradingAccount::all();

        return view('dashboard::tradingAccount.index', compact('tradingAccounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('dashboard::tradingAccount.createOrUpdate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'setting_title' => 'nullable|string|max:255',
                'sever_name' => 'nullable|string|max:255',
                'account_id' => 'nullable|string|max:255',
                'password' => 'nullable|string|max:255',
                'total_profit' => 'nullable|numeric',
                'is_public' => 'required|boolean',
            ]);

            TradingAccount::create([
                'title' => $request->title,
                'setting_title' => $request->setting_title,
                'server_name' => $request->server_name,
                'account_id' => $request->account_id,
                'password' => $request->password,
                'total_profit' => $request->total_profit,
                'is_public' => $request->is_public,
            ]);

            return redirect()->route('admin.trading-accounts.index')->with('success', 'Trading Account created successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: '.$e->getMessage());
        }

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tradingAccountEdit = TradingAccount::findOrFail($id);

        return view('dashboard::tradingAccount.createOrUpdate', compact('tradingAccountEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $tradingAccount = TradingAccount::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'setting_title' => 'nullable|string|max:255',
            'sever_name' => 'nullable|string|max:255',
            'account_id' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
            'total_profit' => 'nullable|numeric',
            'is_public' => 'required|boolean',
        ]);

        $tradingAccount->update([
            'title' => $request->title,
            'setting_title' => $request->setting_title,
            'server_name' => $request->server_name,
            'account_id' => $request->account_id,
            'password' => $request->password,
            'total_profit' => $request->total_profit,
            'is_public' => $request->is_public,
        ]);

        return redirect()->route('admin.trading-accounts.index')->with('success', 'Trading Account updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tradingAccount = TradingAccount::findOrFail($id);
        $tradingAccount->delete();

        return redirect()->route('admin.trading-accounts.index')->with('success', 'Trading Account deleted successfully.');
    }
}
