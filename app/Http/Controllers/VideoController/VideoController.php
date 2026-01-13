<?php

namespace App\Http\Controllers\VideoController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Dashboard\App\Models\SettingTitle;
use Modules\Dashboard\App\Models\Stream;

class VideoController extends Controller
{
    public function index(){
         $livingTitleSectionForVideoTeaching = SettingTitle::select('title', 'description','header_background','logo')->where('id', 7)->first();
        $livedTitleSection =SettingTitle::where('id',3)->pluck('title')->first();
        $livingTitleSection = SettingTitle::select('title', 'description','header_background','logo')->where('id', 2)->first();
        $living = Stream::where('status_id', 1)->with(['stream_status', 'stream_class', 'stream_major', 'stream_teacher', 'stream_school', 'stream_class_category'])->get();
        $liveds = Stream::where('status_id', 3)->with(['stream_status', 'stream_class', 'stream_major', 'stream_teacher', 'stream_school', 'stream_class_category'])->orderBy('id','desc')->paginate(16);
        return view('frontEnd.liveCourse.index',compact('livingTitleSection','livedTitleSection','liveds','living','livingTitleSectionForVideoTeaching'));
    }

    public function detail($id){
        $titleVideoDetailSectionSetting = SettingTitle::select('title', 'description','header_background','logo')->where('id', 10)->first();
        $video = Stream::where('id', $id)->with(['stream_status', 'stream_class', 'stream_major', 'stream_teacher', 'stream_school', 'stream_class_category'])->firstOrFail();
        $video->increment('views');
         return view('frontEnd.detail.detail',compact('video','titleVideoDetailSectionSetting'));
    }


}
