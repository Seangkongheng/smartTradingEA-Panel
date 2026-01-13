<?php

namespace App\Http\Controllers\HomeController;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use App\Models\Register;
use Exception;
use Illuminate\Http\Request;
use Modules\Dashboard\App\Models\AboutUs;
use Modules\Dashboard\App\Models\ClassCategory;
use Modules\Dashboard\App\Models\Classes;
use Modules\Dashboard\App\Models\ClassLevel;
use Modules\Dashboard\App\Models\Major;
use Modules\Dashboard\App\Models\News;
use Modules\Dashboard\App\Models\Professor;
use Modules\Dashboard\App\Models\Project;
use Modules\Dashboard\App\Models\Province;
use Modules\Dashboard\App\Models\School;
use Modules\Dashboard\App\Models\SchoolPartner;
use Modules\Dashboard\App\Models\SettingTitle;
use Modules\Dashboard\App\Models\Stream;
use Modules\Dashboard\App\Models\Student;
use Modules\Dashboard\App\Models\VideoStreamPartner;

class HomeController extends Controller
{
    public function index()
    {
        // Noted : Check condition when have streaming
        $conditionCheck = $this->prepareStreams();
        $conditionCheckStreamSchoolPartner = $this->prepareStreamsForSchoolPartner();

        

        // Noted : get province
        $provinces = Province::select('id', 'kh_name')->get();
        $genders = Gender::select('id', 'kh_name')->get();
        $projects = Project::select('id', 'name', 'description', 'logo')->get();
        $getClassLevels = ClassLevel::select('id', 'name')->get();

        $news = News::limit(8)->orderBy('id', 'desc')->get()->map(function ($item) {
            $images = json_decode($item->image, true);
            $item->first_image = $images[0] ?? null;
            return $item;
        });

        $livings = Stream::where('status_id', 1)->with(['stream_status', 'stream_class', 'stream_major', 'stream_teacher', 'stream_school', 'stream_class_category'])->limit(4)->orderBy('stream_date', 'desc')->get();
        $liveds = Stream::where('status_id', 3)->with(['stream_status', 'stream_class', 'stream_major', 'stream_teacher', 'stream_school', 'stream_class_category'])->limit(8)->orderBy('stream_date', 'desc')->get();

        $teacher_quotes = Professor::select('id', 'title', 'name', 'quote', 'profile', 'major_id')->limit(5)->orderBy('id', 'desc')->get();
        $classCategories = ClassCategory::select('id', 'name')->get();
        $aboutUs = AboutUs::select('id', 'name', 'description', 'slider', 'logo')->first();
        $schools = School::select('id', 'kh_name', 'logo', 'information')->orderBy('position')->get();

        $majors = Major::select('id', 'name')->get();
        $classes = Classes::select('id', 'name')->get();

        $newsTitileSectionOfProfessor = SettingTitle::select('title', 'description')->where('id', 3)->first();
        $libraryTitleSectionOfLibrary = SettingTitle::select('title', 'description')->where('id', 4)->first();
        $newsTitileSection = SettingTitle::where('id', 1)->pluck('title')->first();
        $livingTitleSection = SettingTitle::where('id', 9)->pluck('title')->first();
        $livedTitleSection = SettingTitle::where('id', 2)->pluck('title')->first();
        $professorTitleSection = SettingTitle::select('title', 'description')->where('id', 4)->first();

        $provinces = Province::all();
        $classLevels = ClassLevel::all();

        $books = Stream::with(['stream_school', 'stream_class', 'stream_major', 'stream_class_category'])
            ->whereNotNull('file')
            ->where('file', '!=', '[]')
            ->orderBy('stream_date', 'desc')
            ->limit(12)
            ->get();

        return view('frontEnd.index.index', compact('news', 'provinces', 'schools', 'classLevels', 'teacher_quotes', 'schools', 'majors', 'classes', 'classCategories', 'aboutUs', 'newsTitileSection', 'livingTitleSection', 'livedTitleSection', 'professorTitleSection', 'libraryTitleSectionOfLibrary', 'livings', 'liveds', 'books', 'genders', 'getClassLevels', 'projects', 'newsTitileSectionOfProfessor'));
    }

    // Noted : This function for check session of student that register
    public function checkStudent()
    {
        $studentId = session('registered_student');
        $expiresAt = session('registered_expires_at');
        $province_id = session('province_id');
        $project_id = session('project_id');
        $school_id = session('school_partner_id');

        if (!$studentId || !$expiresAt || now()->greaterThan($expiresAt)) {
            session()->forget(['registered_student', 'registered_expires_at']);
            return response()->json(['registered' => false]);
        }

        return response()->json([
            'registered' => true,
            'student_id' => $studentId,
            'province_id' => $province_id,
            'project_id' => $project_id,
            'school_id' => $school_id,
        ]);
    }

    // Noted : This function for get all school in province
    public function getSchoolOfProvince(Request $request)
    {
        $province_id = $request->province_id;
        $schoolPartners = SchoolPartner::where('province_id', $province_id)->get();
        return response()->json($schoolPartners);
    }

    // Noted : This function for student register
    public function studentRegister(Request $request)
    {
        try {
            $schoolPartnerId = $request->school_partner_id;
            $schoolName = $request->school_name;

            // Change inputschool → NULL
            if ($schoolPartnerId === "inputschool") {
                $schoolPartnerId = null;
            } else {
                $schoolName = null;
            }

            // validation
            $request->validate([
                'name' => 'required|string',
                'gender_id' => 'required',
                'class_level_id' => 'required',
                'province_id' => 'required',
                'school_partner_id' => 'required',
            ]);

            try {
                $student = Student::create([
                    'name' => $request->name,
                    'gender_id' => $request->gender_id,
                    'class_level_id' => $request->class_level_id,
                    'province_id' => $request->province_id,
                    'school_partner_id' => $schoolPartnerId,
                    'school_name' => $schoolName,
                ]);

                // set short session
                session([
                    'registered_student' => $student->id,
                    'province_id' => $student->province_id,
                    'project_id' => $request->project_id,
                    'school_partner_id' => $request->school_partner_id,
                    'registered_expires_at' => now()->addHours(2),
                    'student_id' => $student->id,
                ]);

                // Logic after save
                if ($schoolName) {
                    return redirect()->route('school-partner-live.video-stream-partner-all', [
                        'province_id' => $request->province_id,
                        'project_id' => $request->project_id,
                    ]);

                }

                if ($schoolPartnerId) {
                    return redirect()->route('school-partner-live.specific-school', [
                        'province_id' => $request->province_id,
                        'school_id' => $schoolPartnerId,
                        'project_id' => $request->project_id,
                    ]);

                }

            } catch (Exception $e) {
                return redirect()->back()->with('message', $e->getMessage());
            }

        } catch (Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }


    public function toGetVideoStream($province_id, $school_partner_id, $class_id)
    {
        $videoStreamPartner = VideoStreamPartner::where('$province_id', $province_id)->where('school_partner_id', $school_partner_id)->first();
        return $videoStreamPartner;

    }

    // Noted : This function for get school data
    public function getSchoolData($id)
    {
        $school = School::findOrFail($id);
        $schoolHasClass = $this->getClassOfSchool($school);
        $schoolHasMajor = $this->getMajorOfSchool($school);
        $getStreamingVideoOfSchool = $this->getStreamingVideoOfSchool($id);
        $getLivedVideoOfSchool = $this->getLivedVideoOfSchool($id);

        return response()->json([
            'kh_name' => $school->kh_name,
            'description' => $school->description,
            'logo' => $school->logo ? asset('school/images/' . $school->logo) : asset('images/default-logo.png'),
            'sliders' => collect(json_decode($school->slider))->map(function ($image) {
                return asset('school/slider/' . $image);
            }),
            'classes' => $schoolHasClass,
            'majors' => $schoolHasMajor,
            'streaming' => $getStreamingVideoOfSchool,
            'lived' => $getLivedVideoOfSchool,
        ]);
    }

    public function getVideosByClass(Request $request)
    {
        $schoolId = $request->query('school_id');
        $classId = $request->query('class_id');
        $class = Classes::find($classId);
        $classCategories = $class->category;

        $videos = Stream::where('school_id', $schoolId)
            ->where('class_id', $classId)
            ->where('status_id', 1)
            ->with([
                'stream_school',
                'stream_major',
                'stream_class',
                'stream_major',
                'stream_class_category',
                'stream_teacher'
            ])
            ->limit(value: 4)->orderBy('stream_date', 'desc')->get();
        $livedvideos = Stream::where('school_id', $schoolId)
            ->where('class_id', $classId)
            ->where('status_id', 3)
            ->with([
                'stream_school',
                'stream_major',
                'stream_class',
                'stream_major',
                'stream_class_category',
                'stream_teacher'
            ])
            ->orderBy('stream_date', 'desc')->get();

        return response()->json([
            'videos' => $videos,
            'livedvideos' => $livedvideos,
            'categories' => $classCategories
        ]);
    }


    public function getVideosByClassCategory(Request $request)
    {
        $schoolId = $request->query('school_id');
        $classCategoryId = $request->query('class_category_id');

        $videos = Stream::where('school_id', $schoolId)
            ->where('status_id', 1)
            ->where('class_category_id', $classCategoryId)
            ->with([
                'stream_school',
                'stream_major',
                'stream_class',
                'stream_major',
                'stream_class_category',
                'stream_teacher'
            ])
            ->limit(4)->orderBy('stream_date', 'desc')->get();

        $livedvideos = Stream::where('school_id', $schoolId)
            ->where('class_category_id', $classCategoryId)
            ->where('status_id', 3)
            ->with([
                'stream_school',
                'stream_major',
                'stream_class',
                'stream_major',
                'stream_class_category',
                'stream_teacher'
            ])
            ->orderBy('stream_date', 'desc')->get();

        return response()->json([
            'videos' => $videos,
            'livedvideos' => $livedvideos,
        ]);
    }


    public function getVideosByMajor(Request $request)
    {
        $schoolId = $request->query('school_id');
        $majorId = $request->query('major_id');

        $videos = Stream::where('school_id', $schoolId)
            ->where('status_id', 1)
            ->where('major_id', $majorId)
            ->with([
                'stream_school',
                'stream_major',
                'stream_class',
                'stream_major',
                'stream_class_category',
                'stream_teacher'
            ])
            ->limit(4)->orderBy('stream_date', 'desc')->get();

        $livedvideos = Stream::where('school_id', $schoolId)
            ->where('major_id', $majorId)
            ->where('status_id', 3)
            ->with([
                'stream_school',
                'stream_major',
                'stream_class',
                'stream_major',
                'stream_class_category',
                'stream_teacher'
            ])
            ->orderBy('stream_date', 'desc')->get();

        return response()->json([
            'videos' => $videos,
            'livedvideos' => $livedvideos,
        ]);
    }


    private function getStreamingVideoOfSchool($schoolId)
    {
        return $streamings = Stream::where('school_id', $schoolId)
            ->with([
                'stream_school',
                'stream_major',
                'stream_class',
                'stream_major',
                'stream_class_category',
                'stream_teacher'
            ])
            ->where('status_id', 1)->orderBy('stream_date', 'desc')->get();
    }

    private function getLivedVideoOfSchool($schoolId)
    {
        return $streamings = Stream::where('school_id', $schoolId)
            ->with([
                'stream_school',
                'stream_major',
                'stream_class',
                'stream_major',
                'stream_class_category',
                'stream_teacher'
            ])

            ->where('status_id', 3)->orderBy('stream_date', 'desc')->get();
    }

    public function prepareStreams()
    {
        $now = now()->setTimezone('Asia/Phnom_Penh');

        // Scheduled → Live
        $updatedToLive = Stream::where('status_id', 2)
            ->whereDate('stream_date', $now->toDateString())
            ->where('start_time', '<=', $now->toTimeString())
            ->where('end_time', '>=', $now->toTimeString())
            ->update(['status_id' => 1]);

        // Live → Live Completed
        $updatedToCompleted = Stream::where('status_id', 1)
            ->whereDate('stream_date', $now->toDateString())
            ->where('end_time', '<', $now->toTimeString())
            ->update(['status_id' => 3]);

        return response()->json(
            $updatedToLive
        );
    }



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


    private function getClassOfSchool($school)
    {
        return $schoolHasClass = $school->classes;
    }


    private function getMajorOfSchool($school)
    {
        return $schoolHasMajor = $school->majors;
    }


    public function registerSubmit(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'gender_id' => 'required',
            'province_id' => 'required',
            'school_partner_id' => 'required',
            'class_id' => 'required',
        ]);

        Register::create([
            'full_name' => $request->input('full_name'),
            'gender_Id' => $request->input('gender_id'),
            'province_id' => $request->input('province_id'),
            'school_partner_id' => $request->input('school_partner_id'),
            'class_id' => $request->input('class_id'),
        ]);

        return redirect()->back()->with('success', 'Registration successful!');
    }

}
