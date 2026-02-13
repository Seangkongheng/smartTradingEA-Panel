<?php

namespace Modules\APIFrontEnd\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\VIPTool;

class VIPToolController extends Controller
{

    public function index()
    {
        $vipTools = VIPTool::select('id', 'title', 'description', 'link')->where('is_public',1)->get();
        return response()->json($vipTools);
    }


}
