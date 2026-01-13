<?php

namespace App\Http\Controllers\SearchController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Dashboard\App\Models\Stream;

class SearchController extends Controller
{
    public function index()
    {
        return view('frontEnd.search.search');
    }

    public function search(Request $request)
    {
        $search_string = $request->search_string;
        $status = $request->status;

        $streamingQuery = Stream::where(function ($query) use ($search_string) {
            $query->where('title', 'like', '%' . $search_string . '%')
                ->orWhere('description', 'like', '%' . $search_string . '%');
        });


        $streams = $streamingQuery->orderBy('id', 'desc')->paginate(10);
        if ($streams->count() >= 1) {
            return view('frontEnd.search.partials.result', compact('streams'))->render();
        } else {
            return response()->json([
                'status' => "Nothing found",
            ]);
        }
    }

}
