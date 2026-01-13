<?php

namespace App\Http\Controllers\LiveController;

use App\Http\Controllers\Controller;
use Modules\Dashboard\App\Models\Province;
use Modules\Dashboard\App\Models\SchoolPartner;
use Modules\Dashboard\App\Models\SettingLivePage;
use Modules\Dashboard\App\Models\SettingTitle;
use Modules\Dashboard\App\Models\Student;
use Modules\Dashboard\App\Models\StudentHasViewVideoStreamPartner;
use Modules\Dashboard\App\Models\VideoStreamPartner;

class LivePartnerController extends Controller
{
    public function index()
    {
        // Noted : Check session for expire redirect to home page
        if (
            !session()->has('registered_expires_at') ||
            now()->greaterThan(session('registered_expires_at'))
        ) {

            session()->forget(['registered_student', 'registered_expires_at']);
            return redirect()->route('index.index');
        }

        $this->prepareStreamsForSchoolPartner();

        $livePartners = VideoStreamPartner::where('status_id', 1)->get();
        return view('frontEnd.schoolPartner.liveDetail.index', compact('livePartners'));
    }


    // Noted : This function for get video live specific school
    public function indexOfSpecificSchool($province_id, $school_id, $project_id)
    {

        $this->prepareStreamsForSchoolPartner();
        $livingTitleSectionSpecailLive = SettingTitle::select('title', 'description', 'header_background', 'logo')->where('id', 8)->first();

        $livingTitleSection = SettingTitle::select('title', 'description', 'header_background', 'logo')->where('id', 2)->first();
        $settingLivePageMainTitle = SettingLivePage::select('title', 'description', 'image')->where('id', 1)->first();
        $settingLivePageSubtitle = SettingLivePage::where('id', 2)->value('title');
        $getProvinceName = Province::where('id', $province_id)->value('kh_name');
        $getSchoolName = SchoolPartner::where('id', $school_id)->value('kh_name');

        // Noted : get stream partner with relationship school partner
        $livePartners = VideoStreamPartner::where('status_id', 1) //get status living and waiting
            ->where('province_id', $province_id)
            ->where('project_id', $project_id)
            ->orderBy('id', 'desc')
            ->whereHas('schoolPartner', function ($query) use ($school_id) {
                $query->where('school_partner_id', $school_id);
            })
            ->paginate(12);

        // Noted : get video stream lived partner
        $livedPartners = VideoStreamPartner::where('status_id', 3)
            ->where('province_id', $province_id)
            ->where('project_id', $project_id)
            ->orderBy('id', 'desc')
            ->whereHas('schoolPartner', function ($query) use ($school_id) {
                $query->where('school_partner_id', $school_id);
            })
            ->paginate(12);
        return view('frontEnd.schoolPartner.liveDetail.indexSpecificSchool', compact('livePartners', 'livingTitleSection', 'settingLivePageMainTitle', 'settingLivePageSubtitle', 'getSchoolName', 'getProvinceName', 'livingTitleSectionSpecailLive', 'livedPartners'));
    }

    // Noted : This function for get video live specific province so it have alot of school
    public function indexOfSpecificProvince($province_id, $project_id)
    {
        $livingTitleSectionSpecailLive = SettingTitle::select('title', 'description', 'header_background', 'logo')->where('id', 8)->first();

        $this->prepareStreamsForSchoolPartner();
        $livedTitleSection = SettingTitle::where('id', 3)->pluck('title')->first();
        $livingTitleSection = SettingTitle::select('title', 'description', 'header_background', 'logo')->where('id', 2)->first();
        $settingLivePageMainTitle = SettingLivePage::select('title', 'description', 'image')->where('id', 1)->first();
        $settingLivePageSubtitle = SettingLivePage::where('id', 2)->value('title');
        $getProvinceName = Province::where('id', $province_id)->value('kh_name');

        $livePartners = VideoStreamPartner::where('status_id', 1)
            ->where('province_id', $province_id)
            ->where('project_id', $project_id)
            ->orderBy('id', 'desc')
            ->paginate(12);


        $livedPartners = VideoStreamPartner::where('status_id', 3)
            ->where('project_id', $project_id)
            ->orderBy('id', 'desc')
            ->paginate(12);


        return view('frontEnd.schoolPartner.liveDetail.indexSpecificProvince', compact('livePartners', 'livedTitleSection', 'livingTitleSection', 'settingLivePageMainTitle', 'settingLivePageSubtitle', 'getProvinceName', 'livingTitleSectionSpecailLive', 'livedPartners'));
    }


    // Noted : This function for get video of stream all to show on specail streaming
    public function indexOfVideoStreamAll($province_id, $project_id)
    {
        $livingTitleSectionSpecailLive = SettingTitle::select('title', 'description', 'header_background', 'logo')->where('id', 8)->first();

        $this->prepareStreamsForSchoolPartner();
        $livedTitleSection = SettingTitle::where('id', 3)->pluck('title')->first();
        $livingTitleSection = SettingTitle::select('title', 'description', 'header_background', 'logo')->where('id', 2)->first();
        $settingLivePageMainTitle = SettingLivePage::select('title', 'description', 'image')->where('id', 1)->first();
        $settingLivePageSubtitle = SettingLivePage::where('id', 2)->value('title');
        $getProvinceName = Province::where('id', $province_id)->value('kh_name');

        // Noted : get video streaming when those video stream dont't have partner school
        $livePartners = VideoStreamPartner::where('status_id', 1)
            ->where('project_id', $project_id)
            ->whereDoesntHave('schoolPartner')
            ->orderBy('id', 'desc')
            ->paginate(12);

         // Noted : Get video streaming already when those video stream dont't have partner school
        $livedPartners = VideoStreamPartner::where('status_id', 3)
            ->where('project_id', $project_id)
            ->whereDoesntHave('schoolPartner')
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('frontEnd.schoolPartner.liveDetail.inextShowAllSchoolVideo', compact('livePartners', 'livedTitleSection', 'livingTitleSection', 'settingLivePageMainTitle', 'settingLivePageSubtitle', 'getProvinceName', 'livingTitleSectionSpecailLive', 'livedPartners'));
    }


    // Noted : This function for setting and update status when streaming or waiting
    public function prepareStreamsForSchoolPartner()
    {
        $now = now()->setTimezone('Asia/Phnom_Penh');

        // Scheduled → Live
        $updatedToLive = VideoStreamPartner::where('status_id', 2)
            ->whereDate('stream_date', $now->toDateString())
            ->where('start_time', '<=', $now->toTimeString())
            ->where('end_time', '>=', $now->toTimeString())
            ->update(['status_id' => 1]);


        // Live → Live Completed
        $updatedToCompleted = VideoStreamPartner::where('status_id', 1)
            ->whereDate('stream_date', $now->toDateString())
            ->where('end_time', '<', $now->toTimeString())
            ->update(['status_id' => 3]);

        return response()->json(
            $updatedToLive
        );
    }


    // Noted : This function for detail
    public function detail($id)
    {
        $video = VideoStreamPartner::findOrFail($id);
        $video->increment('views');

        // Noted : Check session for expire redirect to home page
        if (
            !session()->has('registered_expires_at') ||
            now()->greaterThan(session('registered_expires_at'))
        ) {

            session()->forget(['registered_student', 'registered_expires_at']);
            return redirect()->route('index.index');
        }

        $student_id = session('student_id');
        // Insert into junction table (PREVENT DUPLICATE VIEW RECORDS)
        StudentHasViewVideoStreamPartner::firstOrCreate([
            'stream_video_partner_id' => $id,
            'student_id' => $student_id,
        ]);


        $livingTitleSectionSpecailLive = SettingTitle::select('title', 'description', 'header_background', 'logo')->where('id', 8)->first();

        return view('frontEnd.schoolPartner.liveDetail.detail', compact('video', 'livingTitleSectionSpecailLive'));
    }


}
