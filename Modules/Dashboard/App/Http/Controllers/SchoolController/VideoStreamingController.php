<?php

namespace Modules\Dashboard\App\Http\Controllers\SchoolController;

use App\Exports\DataExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Dashboard\App\Models\ClassLevel;
use Modules\Dashboard\App\Models\Province;
use Illuminate\Support\Facades\Cache;
use Modules\Dashboard\App\Models\School;
use Modules\Dashboard\App\Models\SchoolPartner;
use Modules\Dashboard\App\Models\StreamStatus;
use Modules\Dashboard\App\Models\StreamVideoPartnerHasSchool;
use Modules\Dashboard\App\Models\VideoStreamPartner;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Dashboard\App\Models\MajorPartner;
use Modules\Dashboard\App\Models\Project;
use Modules\Dashboard\App\Models\Student;
use Modules\Dashboard\App\Models\TeacherPartner;
use Modules\Dashboard\App\Models\VideoStreamPartnerComment;
use Modules\Dashboard\App\Models\VideoStreamPartnerReplyComment;

class VideoStreamingController extends Controller
{


    public function index()
    {
        $streamsPartners = VideoStreamPartner::with(['schoolPartner', 'province', 'classLevel', 'major', 'stream_status'])->orderBy('id', 'desc')->paginate(28);
        return view('dashboard::school.videoStreaming.index', compact('streamsPartners'));
    }

    public function dataExport(Request $request)
    {
        $provinceId = $request->province_id;
        $schoolId = $request->school_id;
        $startDate = \Carbon\Carbon::parse($request->startDate)->format('Y-m-d 00:00:00');
        $endDate = \Carbon\Carbon::parse($request->endDate)->format('Y-m-d 23:59:59');

        // Filter schools
        if ($provinceId && $schoolId) {
            $schools = SchoolPartner::where('province_id', $provinceId)
                ->where('id', $schoolId)
                ->get();
        } elseif ($provinceId) {
            $schools = SchoolPartner::where('province_id', $provinceId)->get();
        } else {
            $schools = SchoolPartner::all();
        }

        foreach ($schools as $school) {

            $dailyViews = VideoStreamPartner::whereHas('schoolPartner', function ($query) use ($school) {
                $query->where('school_partner_id', $school->id);
            })
                ->whereBetween('created_at', [$startDate, $endDate])
                ->selectRaw('DATE(created_at) as day, SUM(views) as views')
                ->groupByRaw('DATE(created_at)')
                ->orderBy('day', 'asc')
                ->get()
                ->keyBy('day');


            // 2️⃣ Get student counts per day
            $dailyStudents = Student::selectRaw('
        DATE(students.created_at) as day,
        COUNT(*) as students,
        SUM(CASE WHEN genders.kh_name = "ប្រុស" THEN 1 ELSE 0 END) as male,
        SUM(CASE WHEN genders.kh_name = "ស្រី" THEN 1 ELSE 0 END) as female
    ')
                ->join('genders', 'students.gender_id', '=', 'genders.id')
                ->where('school_partner_id', $school->id)
                ->whereBetween('students.created_at', [$startDate, $endDate])
                ->groupByRaw('DATE(students.created_at)')
                ->get()
                ->keyBy('day'); // Key by day for easy mapping

            // 3️⃣ Build full date range
            $dates = [];
            $current = \Carbon\Carbon::parse($startDate);
            $end = \Carbon\Carbon::parse($endDate);

            while ($current->lte($end)) {
                $dayKey = $current->format('Y-m-d');

                $dates[$dayKey] = [
                    'views' => $dailyViews[$dayKey]->views ?? 0,
                    'students' => $dailyStudents[$dayKey]->students ?? 0,
                    'male' => $dailyStudents[$dayKey]->male ?? 0,
                    'female' => $dailyStudents[$dayKey]->female ?? 0,
                ];

                $current->addDay();
            }

            // 4️⃣ Attach to school for Excel export
            $school->daily = collect([]);
            foreach ($dates as $day => $data) {
                $school->daily->push((object) [
                    'day' => $day,
                    'views' => $data['views'],
                    'students' => $data['students'],
                    'male' => $data['male'],
                    'female' => $data['female'],
                ]);
            }

            // 5️⃣ Total counts
            $school->totalViews = $school->daily->sum('views');
            $school->totalStudents = $school->daily->sum('students');
            $school->totalMale = $school->daily->sum('male');
            $school->totalFemale = $school->daily->sum('female');
        }


        return Excel::download(
            new DataExport($schools, $request->startDate, $request->endDate),
            'schools.xlsx'
        );
    }

    public function dataFilter(Request $request)
    {
        $provinceId = $request->province_id;
        $schoolId = $request->school_id;
        $startDate = $request->startDate;
        $endDate = $request->endDate;

        // Default counts
        $countSchool = 0;
        $totalStudents = 0;
        $totalMale = 0;
        $totalFemale = 0;
        $totalViewsProvince = 0;
        $totalViewsSchool = 0;

        // Count schools
        if ($provinceId && $schoolId) {
            $countSchool = SchoolPartner::where('province_id', $provinceId)
                ->where('id', $schoolId)
                ->count();
        } elseif ($provinceId) {
            $countSchool = SchoolPartner::where('province_id', $provinceId)->count();
        } else {
            $countSchool = SchoolPartner::count();
        }

        // Filter schools
        if ($provinceId && $schoolId) {
            $schools = SchoolPartner::where('province_id', $provinceId)
                ->where('id', $schoolId)
                ->get();
        } elseif ($provinceId) {
            $schools = SchoolPartner::where('province_id', $provinceId)->get();
        } else {
            $schools = SchoolPartner::all();
        }

        foreach ($schools as $school) {

            // Daily views per school
            $dailyViews = VideoStreamPartner::whereHas('schoolPartner', function ($query) use ($school) {
                $query->where('school_partner_id', $school->id);
            })
                ->whereBetween('created_at', [$startDate, $endDate])
                ->selectRaw('DATE(created_at) as day, SUM(views) as views')
                ->groupByRaw('DATE(created_at)')
                ->get()
                ->keyBy('day');

            // Daily student counts
            $dailyStudents = Student::selectRaw('
            DATE(students.created_at) as day,
            COUNT(*) as students,
            SUM(CASE WHEN genders.kh_name = "ប្រុស" THEN 1 ELSE 0 END) as male,
            SUM(CASE WHEN genders.kh_name = "ស្រី" THEN 1 ELSE 0 END) as female
        ')
                ->join('genders', 'students.gender_id', '=', 'genders.id')
                ->where('school_partner_id', $school->id)
                ->whereBetween('students.created_at', [$startDate, $endDate])
                ->groupByRaw('DATE(students.created_at)')
                ->get()
                ->keyBy('day');

            // Build full date range
            $dates = [];
            $current = \Carbon\Carbon::parse($startDate);
            $end = \Carbon\Carbon::parse($endDate);

            while ($current->lte($end)) {
                $dayKey = $current->format('Y-m-d');

                $dates[$dayKey] = [
                    'views' => $dailyViews[$dayKey]->views ?? 0,
                    'students' => $dailyStudents[$dayKey]->students ?? 0,
                    'male' => $dailyStudents[$dayKey]->male ?? 0,
                    'female' => $dailyStudents[$dayKey]->female ?? 0,
                ];

                $current->addDay();
            }

            // Store daily stats
            $school->daily = collect([]);
            foreach ($dates as $day => $data) {
                $school->daily->push((object) [
                    'day' => $day,
                    'views' => $data['views'],
                    'students' => $data['students'],
                    'male' => $data['male'],
                    'female' => $data['female'],
                ]);
            }

            // Total counts per school
            $school->totalViews = $school->daily->sum('views');
            $school->totalStudents = $school->daily->sum('students');
            $school->totalMale = $school->daily->sum('male');
            $school->totalFemale = $school->daily->sum('female');

            // Aggregate totals across all schools
            $totalStudents += $school->totalStudents;
            $totalMale += $school->totalMale;
            $totalFemale += $school->totalFemale;
            $totalViewsSchool += $school->totalViews;
        }

        // Total views by province
        $totalViewsProvince = VideoStreamPartner::whereHas('schoolPartner', function ($q) use ($provinceId) {
            if ($provinceId)
                $q->where('province_id', $provinceId);
        })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('views');

        return response()->json([
            'countSchool' => $countSchool,
            'countStudent' => $totalStudents,
            'countMale' => $totalMale,
            'countFemale' => $totalFemale,
            'totalViewsProvince' => $totalViewsProvince,
            'totalViewsSchool' => $totalViewsSchool,
        ]);
    }


    public function togetDataOfProvince($province_id)
    {
        return SchoolPartner::where('province_id', $province_id)
            ->pluck('id')
            ->toArray();
    }


    public function startExport()
    {

    }

    public function exportProgress()
    {
        $progress = Cache::get('export_progress', 0);
        return response()->json(['progress' => $progress]);
    }


    // Noted : This function for get school of province
    public function getSchoolOfProvince($province_id)
    {
        $schoolPartners = SchoolPartner::where('province_id', $province_id)->get();
        return response()->json($schoolPartners);
    }

    // Noted : This function for get teacher of project id
    public function getTeacherOfProject($project_id)
    {
        $teacherPartner = TeacherPartner::where('project_id', $project_id)->get();
        return response()->json($teacherPartner);
    }

    // Noted : This function for get major of project
    public function getMajorOfProject($project_id)
    {
        $majorsPartner = MajorPartner::where('project_id', $project_id)->get();
        return response()->json($majorsPartner);
    }


    // Noted : This function create
    public function create()
    {
        $provinces = Province::select('id', 'kh_name')->get();
        $classLevels = ClassLevel::select('id', 'name')->get();
        $majors = MajorPartner::select('id', 'name')->get();
        $teachers = TeacherPartner::select('id', 'name')->get();
        $projects = Project::select('id', 'name')->get();

        $objSchool = new School();
        $objStatus = new StreamStatus();

        $schools = $objSchool::all();
        $statuses = $objStatus::all();

        return view(
            'dashboard::school.videoStreaming.addOrEdit',
            [
                "schools" => $schools,
                "statuses" => $statuses,
                'provinces' => $provinces,
                'classLevels' => $classLevels,
                'projects' => $projects,
                'majors' => $majors,
                'teachers' => $teachers,
            ]
        );
    }

    public function data()
    {
        $provinces = Province::select('id', 'kh_name')->get();
        return view('dashboard::school.videoStreaming.data', compact('provinces'));
    }

    public function analytice($id)
    {
        $video = VideoStreamPartner::findOrFail($id);
        $students = $video->students()->orderby('id', 'DESC')->paginate(28);
        $totalStudents = $video->students()->count();
        // Count male students
        $maleCount = $video->students()->whereHas('gender', function ($q) {
            $q->where('en_name', 'Male');
        })->count();

        // Count female students
        $femaleCount = $video->students()->whereHas('gender', function ($q) {
            $q->where('en_name', 'Female');
        })->count();

        // Count by province dynamically
        $provinceCounts = $video->students()
            ->with('province')
            ->get()
            ->groupBy(fn($student) => $student->province->kh_name ?? 'មិនបានកំណត់')
            ->map(fn($group) => $group->count());

        $videoId = $id;

        return view('dashboard::school.videoStreaming.analytics', compact('students', 'totalStudents', 'maleCount', 'femaleCount', 'provinceCounts', 'videoId'));
    }

    // Noted : This function for validate request
    private function validateRequest(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'school_partner_id.*' => 'nullable',
            'project_id' => 'nullable',
            'province_id' => 'nullable',
            'teacher_partner_id' => 'nullable',
            'major_id' => 'nullable',
            'class_level_id' => 'nullable',
            'stream_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'status_id' => 'required|integer',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'file.*' => 'nullable|mimes:pdf|max:5120',
        ]);
    }

    // Noted : This function for store video stream partner
    public function store(Request $request)
    {
        try {

            $this->validateRequest($request);
            $videoStreamPartner = new VideoStreamPartner();
            $this->saveOrUpdate($videoStreamPartner, $request);
            return redirect()->route('admin.video-streaming.index')->with('message', 'វីដេអូបានបង្ហោះជោគជ័យ.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    // Noted : This function for save or update video stream partner
    private function saveOrUpdate(VideoStreamPartner $videoStreamPartner, Request $request)
    {
        // Save basic fields
        $videoStreamPartner->title = $request->title;
        $videoStreamPartner->description = $request->description;
        $videoStreamPartner->url = $request->url;
        $videoStreamPartner->project_id = $request->project_id;
        $videoStreamPartner->teacher_partner_id = $request->teacher_partner_id;
        $videoStreamPartner->views = $request->views;
        $videoStreamPartner->province_id = $request->province_id;
        $videoStreamPartner->class_level_id = $request->class_level_id;
        $videoStreamPartner->major_id = $request->major_id;
        $videoStreamPartner->stream_date = $request->stream_date;
        $videoStreamPartner->start_time = $request->start_time;
        $videoStreamPartner->end_time = $request->end_time;
        $videoStreamPartner->status_id = $request->status_id;

        $videoStreamPartner->save();


        // Convert null → [] so foreach never breaks
        $schoolPartnerIds = (array) ($request->school_partner_id ?? []);

        // Delete old records for this video stream partner
        StreamVideoPartnerHasSchool::where('stream_video_partner_id', $videoStreamPartner->id)
            ->delete();

        // Insert new relations
        foreach ($schoolPartnerIds as $school_partner_id) {
            StreamVideoPartnerHasSchool::create([
                'stream_video_partner_id' => $videoStreamPartner->id,
                'school_partner_id' => $school_partner_id
            ]);
        }


        if ($request->hasFile('thumbnail')) {

            // delete old thumbnail file
            if ($videoStreamPartner->thumbnail && Storage::disk('public')->exists($videoStreamPartner->thumbnail)) {
                Storage::disk('public')->delete($videoStreamPartner->thumbnail);
            }

            // upload new thumbnail
            $videoStreamPartner->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
            $videoStreamPartner->save();
        }


        if ($request->hasFile('file')) {

            // delete old files
            if ($videoStreamPartner->file) {
                $oldFiles = json_decode($videoStreamPartner->file, true);
                foreach ($oldFiles as $file) {
                    if (Storage::disk('public')->exists($file['path'])) {
                        Storage::disk('public')->delete($file['path']);
                    }
                }
            }

            $uploadedFiles = $request->file('file');
            $allFiles = [];

            foreach ($uploadedFiles as $uploadedFile) {
                $originalName = $uploadedFile->getClientOriginalName();
                $filePath = $uploadedFile->store('documents', 'public');

                $allFiles[] = [
                    'name' => $originalName,
                    'path' => $filePath,
                ];
            }

            $videoStreamPartner->file = json_encode($allFiles);
            $videoStreamPartner->file_name = json_encode($allFiles);
            $videoStreamPartner->save();
        }
    }

    // Noted : This funciton for show
    public function show($id)
    {

        $comments = VideoStreamPartnerComment::with('replies')->where('stream_video_partner_id', $id)->get();
        $videoStreamPartner = VideoStreamPartner::with(['schoolPartner', 'province', 'classLevel', 'major', 'stream_status'])->findOrFail($id);
        return view('dashboard::school.videoStreaming.show', compact('videoStreamPartner', 'comments'));
    }


    // Noted : This funcitn for Edit
    public function edit($id)
    {
        $provinces = Province::select('id', 'kh_name')->get();
        $classLevels = ClassLevel::select('id', 'name')->get();
        $statuses = StreamStatus::all();
        $schoolPartners = SchoolPartner::all();
        $projects = Project::select('id', 'name')->get();
        $teachers = TeacherPartner::select('id', 'name')->get();
        $majors = MajorPartner::select('id', 'name')->get();

        $videoStreamPartnerEdit = VideoStreamPartner::findOrFail($id);
        $selectedSchoolPartnerIds = StreamVideoPartnerHasSchool::where('stream_video_partner_id', $videoStreamPartnerEdit->id)
            ->pluck('school_partner_id')
            ->toArray();

        return view('dashboard::school.videoStreaming.addOrEdit', compact('videoStreamPartnerEdit', 'provinces', 'classLevels', 'statuses', 'schoolPartners', 'selectedSchoolPartnerIds', 'projects', 'teachers', 'majors'));
    }


    // Noted : This funciton for update
    public function update(Request $request, $id)
    {
        $this->validateRequest($request);

        $videoStreamPartner = VideoStreamPartner::findOrFail($id);
        $this->saveOrUpdate($videoStreamPartner, $request);

        return redirect()->route('admin.video-streaming.index')->with('message', 'វីដេអូបានកែប្រែជោគជ័យ.');
    }


    // Noted : This funciton for Destroy
    public function destroy($id)
    {
        $videoStreamPartner = VideoStreamPartner::findOrFail($id);
        // Delete the thumbnail if it exists
        if ($videoStreamPartner->thumbnail && Storage::disk('public')->exists($videoStreamPartner->thumbnail)) {
            Storage::disk('public')->delete($videoStreamPartner->thumbnail);
        }

        // Delete the file if it exists
        if ($videoStreamPartner->file && Storage::disk('public')->exists($videoStreamPartner->file)) {
            Storage::disk('public')->delete($videoStreamPartner->file);
        }

        $videoStreamPartner->delete();

        return redirect()->route('admin.video-streaming.index')->with('message', 'វីដេអូបានលុបជោគជ័យ.');
    }

    // Noted : This function for search
    public function search(Request $request)
    {
        $search = trim($request->search_string);
        $status = $request->status;

        $streamingQuery = VideoStreamPartner::with([
            'schoolPartner',
            'province',
            'classLevel',
            'major',
            'stream_status'
        ]);

        // Search by title or description
        if ($search !== '') {
            $streamingQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Status filter ONLY if user selected 1, 2, or 3
        if (!empty($status) && in_array($status, [1, 2, 3])) {
            $streamingQuery->where('status_id', $status);
        }
        // If status = 0 or empty → show all status (no filter)

        $streamsPartners = $streamingQuery
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($streamsPartners->count() > 0) {
            return view(
                'dashboard::school.videoStreaming.partials.tableInformation.classTable',
                compact('streamsPartners')
            )->render();
        }

        return response()->json([
            'status' => "Nothing found",
        ]);
    }

    public function destroyComment($id)
    {
        $comment = VideoStreamPartnerComment::with('replies')->findOrFail($id);
        if ($comment->replies->count() > 0) {
            return redirect()->back()->with('error', 'មិនអាចលុបមតិយោបល់នេះបានទេ។ សូមលុបការឆ្លើយមតិទាំងអស់ជាមុនសិន។');
        }
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }


    private function deleteReplies($replies)
    {
        foreach ($replies as $reply) {
            if ($reply->replies->count()) {
                $this->deleteReplies($reply->replies);
            }
            $reply->delete();
        }
    }

    public function destroyReply($id)
    {
        $reply = VideoStreamPartnerReplyComment::with('replies')->findOrFail($id);
        // Recursively delete nested replies
        $this->deleteReplies($reply->replies);

        $reply->delete();

        return redirect()->back()->with('success', 'Reply deleted successfully!');
    }

    public function studentSearch(Request $request, $videoId)
    {
        $search_string = $request->search_string;

        $video = VideoStreamPartner::findOrFail($videoId);


        $projectQuery = $video->students()->where(function ($query) use ($search_string) {
            $query->where('name', 'like', '%' . $search_string . '%');
        });

        $students = $projectQuery->orderBy('id', 'desc')->paginate(10);

        $totalStudents = $projectQuery->count();

        $maleCount = $projectQuery->whereHas('gender', function ($q) {
            $q->where('en_name', 'Male');
        })->count();

        $femaleCount = $projectQuery->whereHas('gender', function ($q) {
            $q->where('en_name', 'Female');
        })->count();

        $provinceCounts = $projectQuery->with('province')
            ->get()
            ->groupBy(fn($student) => $student->province->kh_name ?? 'មិនបានកំណត់')
            ->map(fn($group) => $group->count());

        // Return the same view or partial with updated stats
        return view('dashboard::school.videoStreaming.partials.tableInformation.analyticeTable', compact(
            'students',
            'totalStudents',
            'maleCount',
            'femaleCount',
            'provinceCounts'
        ))->render();
    }


}
