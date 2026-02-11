<?php

namespace Modules\APIFrontEnd\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\Community;

class CommunityController extends Controller
{

    public function index()
    {
        $communities = Community::select('id', 'title', 'description', 'file')->where('is_public', 1)->orderBy('id', 'desc')->get();
        return response()->json($communities);
    }


}
