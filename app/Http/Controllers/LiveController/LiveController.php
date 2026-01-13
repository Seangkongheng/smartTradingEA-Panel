<?php

namespace App\Http\Controllers\LiveController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Dashboard\App\Models\SettingLivePage;
use Modules\Dashboard\App\Models\SettingTitle;
use Modules\Dashboard\App\Models\SteamComment;
use Modules\Dashboard\App\Models\Stream;

class LiveController extends Controller
{
    public function index()  {
        $livedTitleSection =SettingTitle::where('id',3)->pluck('title')->first();
        $livingTitleSection = SettingTitle::select('title', 'description','header_background','logo')->where('id', 2)->first();
        $settingLivePageMainTitle = SettingLivePage::select('title','description','image')->where('id',1)->first();
        $settingLivePageSubtitle = SettingLivePage::where('id', 2)->value('title');
           $living = Stream::where('status_id', 1)->with(['stream_status', 'stream_class', 'stream_major', 'stream_teacher', 'stream_school', 'stream_class_category'])->get();
        return view('frontEnd.live.index',compact('livingTitleSection','livedTitleSection','settingLivePageMainTitle','settingLivePageSubtitle','living'));
    }
    public function detail($id){
        $livingTDetailitleSection = SettingTitle::select('title', 'description','header_background','logo')->where('id', 11)->first();
        $video = Stream::where('id', $id)->with(['stream_status', 'stream_class', 'stream_major', 'stream_teacher', 'stream_school', 'stream_class_category'])->firstOrFail();
        $video->increment('views');
        return view('frontEnd.liveDetail.index',compact('video','livingTDetailitleSection'));
    }
}
