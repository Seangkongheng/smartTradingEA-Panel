<?php

namespace Modules\APIFrontEnd\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\EASetting;

class EASettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eaSettings = EASetting::orderBy('id', 'desc')
            ->get();
        return response()->json([
            'eaSettings' => $eaSettings
        ]);
    }


}
