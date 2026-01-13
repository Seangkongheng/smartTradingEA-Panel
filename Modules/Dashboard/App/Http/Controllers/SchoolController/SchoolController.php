<?php

namespace Modules\Dashboard\App\Http\Controllers\SchoolController;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery\Expectation;
use Illuminate\Support\Facades\DB;
use Modules\Dashboard\App\Models\ClassCategory;
use Modules\Dashboard\App\Models\Classes;
use Modules\Dashboard\App\Models\School;
use Modules\Dashboard\App\Models\Stream;
use Modules\Dashboard\App\Models\Teacher;
use Illuminate\Support\Str;

class SchoolController extends Controller
{

    public function index()
    {
        $schools = School::orderBy('position')->paginate(12);
        return view('dashboard::school.school.index', compact('schools'));
    }


    public function moveUp(Request $request, $id)
    {
        $current = School::findOrFail($id);

        // Fix broken position if 0 or null
        if (!$current->position || $current->position == 0) {
            $lastPosition = School::max('position') ?? 0;
            $current->position = $lastPosition + 1;
            $current->save();
        }

        // Find the previous school to swap
        $previous = School::where('position', '<', $current->position)
            ->orderBy('position', 'desc')
            ->first();

        if ($previous) {
            [$current->position, $previous->position] = [$previous->position, $current->position];
            $current->save();
            $previous->save();
        }

        return redirect()->route('admin.school.index', ['page' => $request->page]);
    }

    public function moveDown(Request $request, $id)
    {
        $current = School::findOrFail($id);

        // Fix broken position if 0 or null
        if (!$current->position || $current->position == 0) {
            $lastPosition = School::max('position') ?? 0;
            $current->position = $lastPosition + 1;
            $current->save();
        }

        // Find the next school to swap
        $next = School::where('position', '>', $current->position)
            ->orderBy('position', 'asc')
            ->first();

        if ($next) {
            [$current->position, $next->position] = [$next->position, $current->position];
            $current->save();
            $next->save();
        }

        return redirect()->route('admin.school.index', ['page' => $request->page]);
    }

    public function create()
    {
        return view('dashboard::school.school.createOrUpdate');
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'kh_name' => 'required|string',
                'en_name' => 'required|string',
                'description' => 'nullable',
                'information' => 'nullable',
                'logo' => 'nullable|file|mimes:png,jpg,jpeg|max:5120',
            ]);

            // Check if school exists
            if ($this->schoolExists($request->kh_name)) {
                return redirect()->back()->withInput()->with('error', 'A school already exit');
            }

            // logo image
            $imageName = null;
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $imageName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('school/images'), $imageName);
            }

            // slider image
            $slider = [];
            $sliderName = null;
            if ($request->hasFile('slider')) {
                foreach ($request->file('slider') as $file) {
                    $sliderName = time() . '-' . $file->getClientOriginalName();
                    $file->move(public_path('school/slider'), $sliderName);
                    $slider[] = $sliderName;
                }
            }
            ;

            // Set position
            $lastPosition = School::max('position') ?? 0;
            $newPosition = $lastPosition + 1;

            // create school
            School::create([
                'kh_name' => $request->kh_name,
                'en_name' => $request->en_name,
                'logo' => $imageName,
                'description' => $request->description,
                'information' => $request->information,
                'slider' => json_encode($slider),
                'position' => $newPosition,

            ]);


            DB::commit();
            return redirect()->route('admin.school.index')->with('message', 'សាលារៀនបង្កើតបានជោគជ័យ');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function schoolExists($kh_name)
    {
        return School::where('kh_name', $kh_name)->exists();
    }

    public function show($id)
    {
        $school = School::findOrFail($id);
        return view('dashboard::school.school.show', compact('school'));
    }


    public function edit($id)
    {
        $schoolEdit = School::findOrFail($id);
        return view('dashboard::school.school.createOrUpdate', compact('schoolEdit'));
    }

    public function update(Request $request, $id)
    {
        try {
            $school = School::findOrFail($id);
            $imageName = $school->logo;

            // upload new logo if exists
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $imageName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('school/images'), $imageName);

                if ($school->logo && file_exists(public_path('school/images/' . $school->logo))) {
                    unlink(public_path('school/images/' . $school->logo));
                }
            }

            // Handle slider images
            $slider = [];
            if ($request->hasFile('slider')) {
                // Delete old slider images
                if (!empty($school->slider)) {
                    $oldSlider = json_decode($school->slider, true) ?? [];
                    foreach ($oldSlider as $oldImage) {
                        $oldImagePath = public_path('school/slider/' . $oldImage);
                        if (file_exists($oldImagePath)) {
                            @unlink($oldImagePath);
                        }
                    }
                }

                // Save new slider images
                foreach ($request->file('slider') as $file) {
                    $sliderName = time() . '-' . $file->getClientOriginalName();
                    $file->move(public_path('school/slider'), $sliderName);
                    $slider[] = $sliderName;
                }
            } else {

                // Keep old slider images if no new ones uploaded
                if (!empty($school->slider)) {
                    $slider = json_decode($school->slider, true) ?? [];
                }
            }

            $school->update([
                'kh_name' => $request->kh_name,
                'en_name' => $request->en_name,
                'logo' => $imageName,
                'description' => $request->description,
                'information' => $request->information,
                'slider' => json_encode($slider)
            ]);

            return redirect()->route('admin.school.index')->with('message', 'សាលារៀនកែប្រែបានជោគជ័យ');
        } catch (Exception $e) {
            return redirect()->route('admin.school.index')->with('error', $e->getMessage());
        }

    }

    public function destroy($id)
    {
        try {
            $school = School::findOrFail($id);
            if ($school->logo && file_exists(public_path('school/images/' . $school->logo))) {
                @unlink(public_path('school/images/' . $school->logo));
            }
            $school->delete();
            return redirect()->route('admin.school.index')->with('message', 'សាលារៀនលុបបានជោគជ័យ');
        } catch (Exception $e) {
            return redirect()->route('admin.school.index')->with('error', $e->getMessage());
        }

    }

    public function schoolSearch(Request $request)
    {
        $search_string = $request->search_string;
        $status = $request->status;

        $schoolQuery = School::where(function ($query) use ($search_string) {
            $query->where('kh_name', 'like', '%' . $search_string . '%')
                ->orWhere('en_name', 'like', '%' . $search_string . '%');
        });

        $schools = $schoolQuery->orderBy('id', 'desc')->paginate(10);
        if ($schools->count() >= 1) {
            return view('dashboard::school.school.partials.tableInformation.schoolTable', compact('schools'))->render();
        } else {
            return response()->json([
                'status' => "Nothing found",
            ]);
        }
    }

    public function analytices($id, Request $request)
    {
        $school_id = $id;
        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::today();

        $aboutSchool = School::select('id', 'kh_name', 'en_name', 'logo', 'description')->where('id', $id)->first();
        $classCategories = ClassCategory::select('id', 'name')->get();
        $totalTeachers = Teacher::where('school_id', $id)->count();
        $videoStream = Stream::where('school_id', $id)->count();
        $totalViews = Stream::where('school_id', $id)->sum('views');
        $totalBooks = Stream::where('school_id', $id)->whereNotNull('file')->count();

        $schoolHasClass = $this->getClassOfSchool($id);
        $schoolHasMajors = $this->getMajorOfSchool($id);

        // get last 1 week views
        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::today();
        $viewsPerDay = Stream::where('school_id', $id)
            ->selectRaw('DATE(created_at) as date, SUM(views) as total_views')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total_views', 'date');

        $dailyViewLabels = [];
        $dailyViewData = [];
        $period = CarbonPeriod::create($startDate, $endDate);
        foreach ($period as $date) {
            $formatted = $date->format('Y-m-d');
            $dailyViewLabels[] = $date->format('M d');
            $dailyViewData[] = $viewsPerDay[$formatted] ?? 0;
        }

        // Top 5 most viewed streams
        $topStreamView = Stream::where('school_id', $id)->with('stream_major')
            ->orderBy('views', 'desc')
            ->limit(5)
            ->get();

        $topCoursesLabels = $topStreamView->map(fn($item) => optional($item->stream_major)->name ?? $item->title);
        $topCoursesViews = $topStreamView->pluck('views');


        // Get top 5 subjects by total views
        $topSubjects = Stream::where('school_id', $id)
            ->select('major_id', DB::raw('SUM(views) as total_views'))
            ->groupBy('major_id')
            ->with('stream_major') // assuming Stream has a `subject` relationship
            ->orderByDesc('total_views')
            ->limit(5)
            ->get();

        // Prepare labels and data for Chart.js
        $topSubjectsLabels = $topSubjects->map(fn($item) => $item->stream_major->name ?? 'Unknown');
        $topSubjectsViews = $topSubjects->pluck('total_views');


        return view('dashboard::school.school.analytices', compact('totalTeachers', 'totalViews', 'totalBooks', 'videoStream', 'aboutSchool', 'topCoursesLabels', 'topCoursesViews', 'topSubjectsLabels', 'topSubjectsViews', 'classCategories', 'schoolHasClass', 'schoolHasMajors', 'school_id', 'dailyViewData', 'dailyViewLabels'));
    }


    public function analyticsFilter(Request $request, $schoolId)
    {
        // Start as a query builder
        $query = Stream::where('school_id', $schoolId);

        // Apply filters
        if ($request->class_id) {
            $query->where('class_id', $request->class_id);
        }

        if ($request->major_id) {
            $query->where('major_id', $request->major_id);
        }

        if ($request->category_id) {
            $query->whereHas('stream_class_category', function ($q) use ($request) {
                $q->where('class_category_id', $request->category_id);
            });
        }


        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        } elseif ($request->filter == 'day') {
            $query->whereDate('created_at', now()->toDateString());
        } elseif ($request->filter == 'week') {
            $query->whereBetween('created_at', [now()->subDays(7), now()]);
        } elseif ($request->filter == 'month') {
            $query->whereBetween('created_at', [now()->subDays(30), now()]);
        }

        //Daily views
        $dailyViews = (clone $query)
            ->selectRaw('DATE(created_at) as day, SUM(views) as total_views')
            ->groupByRaw('DATE(created_at)')
            ->orderByRaw('DATE(created_at)')
            ->get();

        // Top 5 courses
        $topCourses = (clone $query)
            ->with('stream_major')
            ->orderBy('views', 'desc')
            ->limit(5)
            ->get();

        // Top 5 subjects
        $topSubjects = (clone $query)
            ->select('major_id', DB::raw('SUM(views) as total_views'))
            ->groupBy('major_id')
            ->with('stream_major')
            ->orderByDesc('total_views')
            ->limit(5)
            ->get();

        return response()->json([
            'dailyViews' => [
                'labels' => $dailyViews->pluck('day'),
                'data' => $dailyViews->pluck('total_views')
            ],
            'topCourses' => [
                'labels' => $topCourses->map(fn($item) => optional($item->stream_major)->name ?? $item->title),
                'data' => $topCourses->pluck('views')
            ],
            'topSubjects' => [
                'labels' => $topSubjects->map(fn($item) => optional($item->stream_major)->name ?? 'Unknown'),
                'data' => $topSubjects->pluck('total_views')
            ]
        ]);
    }

    public function getClassCategories($classId)
    {
        $class = Classes::with('categories')->findOrFail($classId);
        return response()->json($class->categories);
    }

    private function getClassOfSchool($schoolId)
    {
        $school = School::findOrFail($schoolId);
        return $school->classes;
    }

    private function getMajorOfSchool($schoolId)
    {
        $school = School::findOrFail($schoolId);
        return $school->majors;
    }

    private function getClassOfSchoolAjax($school)
    {
        return $schoolHasClass = $school->classes;
    }

    private function getMajorOfSchoolAjax($school)
    {
        return $schoolHasMajor = $school->majors;
    }

    private function getCategoryOfClassSchoolAjax($school)
    {
        return $classHasClassCategory = $school->category;
    }

    public function getSchoolInfo($id, Request $request)
    {
        $school = School::with(['classes', 'majors'])
            ->select('id', 'kh_name', 'en_name', 'logo', 'description')
            ->where('id', $id)
            ->first();

        if (!$school) {
            return response()->json(['error' => 'School not found'], 404);
        }

        // Additional stats
        $totalTeachers = Teacher::where('school_id', $id)->count();
        $videoStream = Stream::where('school_id', $id)->count();
        $totalViews = Stream::where('school_id', $id)->sum('views');
        $totalBooks = Stream::where('school_id', $id)->whereNotNull('file')->count();

        // get last 1 week views
        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::today();
        $viewsPerDay = Stream::where('school_id', $id)
            ->selectRaw('DATE(created_at) as date, SUM(views) as total_views')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total_views', 'date');

        $dailyViewLabels = [];
        $dailyViewData = [];
        $period = CarbonPeriod::create($startDate, $endDate);
        foreach ($period as $date) {
            $formatted = $date->format('Y-m-d');
            $dailyViewLabels[] = $date->format('M d');
            $dailyViewData[] = $viewsPerDay[$formatted] ?? 0;
        }

        // Get top 5 subjects by total views
        $topSubjects = Stream::where('school_id', $id)
            ->select('major_id', DB::raw('SUM(views) as total_views'))
            ->groupBy('major_id')
            ->with('stream_major')
            ->orderByDesc('total_views')
            ->limit(5)
            ->get();

        $topSubjectsLabelsOfSchool = $topSubjects->map(fn($item) => $item->stream_major->name ?? 'Unknown');
        $topSubjectsViewsOfSchhool = $topSubjects->pluck('total_views');

        // Top 5 most viewed streams
        $topStreamView = Stream::where('school_id', $id)->with('stream_major')
            ->orderBy('views', 'desc')
            ->limit(5)
            ->get();
        $topCoursesLabelsOfSchool = $topStreamView->map(fn($item) => Str::limit($item->title, 5));
        $topCoursesViewsOfSchool = $topStreamView->pluck('views');

        $schoolHasClass = $this->getClassOfSchoolAjax($school);
        $schoolHasMajor = $this->getMajorOfSchoolAjax($school);

        // Return all data
        return response()->json([
            'kh_name' => $school->kh_name,
            'en_name' => $school->en_name,
            'logo' => $school->logo,
            'description' => $school->description,
            'teachers_count' => $totalTeachers,
            'videos_count' => $videoStream,
            'views_count' => $totalViews,
            'books_count' => $totalBooks,
            'dailyViewLabels' => $dailyViewLabels,
            'dailyViewData' => $dailyViewData,
            'top_subjects_labels' => $topSubjectsLabelsOfSchool ?? [],
            'top_subjects_views' => $topSubjectsViewsOfSchhool ?? [],
            'top_course_labels' => $topCoursesLabelsOfSchool ?? [],
            'top_course_views' => $topCoursesViewsOfSchool ?? [],
            'schoolHasClass' => $schoolHasClass,
            'schoolHasMajor' => $schoolHasMajor,
        ]);
    }

    public function getClassInfo($schoolId, $classId)
    {

        $school = School::with(['classes', 'majors'])->findOrFail($schoolId);
        // Stats for this class
        $views = Stream::where('school_id', $schoolId)
            ->where('class_id', $classId)
            ->sum('views');

        $videos = Stream::where('school_id', $schoolId)
            ->where('class_id', $classId)
            ->count();

        $books = Stream::where('school_id', $schoolId)
            ->where('class_id', $classId)
            ->whereNotNull('file')
            ->count();

        // get last 1 week views
        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::today();
        $viewsPerDay = Stream::where('school_id', $schoolId)
            ->where('class_id', $classId)
            ->selectRaw('DATE(created_at) as date, SUM(views) as total_views')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total_views', 'date');

        $dailyViewLabels = [];
        $dailyViewData = [];
        $period = CarbonPeriod::create($startDate, $endDate);
        foreach ($period as $date) {
            $formatted = $date->format('Y-m-d');
            $dailyViewLabels[] = $date->format('M d');
            $dailyViewData[] = $viewsPerDay[$formatted] ?? 0;
        }

        // Top subjects in this class
        $topSubjects = Stream::where('school_id', $schoolId)
            ->where('class_id', $classId)
            ->select('major_id', DB::raw('SUM(views) as total_views'))
            ->groupBy('major_id')
            ->with('stream_major')
            ->orderByDesc('total_views')
            ->limit(5)
            ->get();

        $topSubjectsLabels = $topSubjects->map(fn($item) => $item->stream_major->name ?? 'Unknown');
        $topSubjectsViews = $topSubjects->pluck('total_views');

        // Top streams in this class
        $topStreams = Stream::where('school_id', $schoolId)
            ->where('class_id', $classId)
            ->orderByDesc('views')
            ->limit(5)
            ->get();

        $topStreamsLabels = $topStreams->map(fn($item) => Str::limit($item->title, 5));
        $topStreamsViews = $topStreams->pluck('views');

        $class = Classes::find($classId);
        $classCategories = $class->category;

        return response()->json([
            'views_count' => $views,
            'videos_count' => $videos,
            'books_count' => $books,
            'dailyViewLabels' => $dailyViewLabels,
            'dailyViewData' => $dailyViewData,
            'top_subjects_labels' => $topSubjectsLabels,
            'top_subjects_views' => $topSubjectsViews,
            'top_course_labels' => $topStreamsLabels,
            'top_course_views' => $topStreamsViews,
            'classCategories' => $classCategories
        ]);
    }

    public function getMajorInfo($schoolId, $majorId)
    {

        $views = Stream::where('school_id', $schoolId)
            ->where('major_id', $majorId)
            ->sum('views');

        $videos = Stream::where('school_id', $schoolId)
            ->where('major_id', $majorId)
            ->count();

        $books = Stream::where('school_id', $schoolId)
            ->where('major_id', $majorId)
            ->whereNotNull('file')
            ->count();

        // get last 1 week views
        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::today();
        $viewsPerDay = Stream::where('school_id', $schoolId)
            ->where('major_id', $majorId)
            ->selectRaw('DATE(created_at) as date, SUM(views) as total_views')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total_views', 'date');

        $dailyViewLabels = [];
        $dailyViewData = [];
        $period = CarbonPeriod::create($startDate, $endDate);
        foreach ($period as $date) {
            $formatted = $date->format('Y-m-d');
            $dailyViewLabels[] = $date->format('M d');
            $dailyViewData[] = $viewsPerDay[$formatted] ?? 0;
        }

        // Top subjects in this class
        $topSubjects = Stream::where('school_id', $schoolId)
            ->where('major_id', $majorId)
            ->select('major_id', DB::raw('SUM(views) as total_views'))
            ->groupBy('major_id')
            ->with('stream_major')
            ->orderByDesc('total_views')
            ->limit(5)
            ->get();

        $topSubjectsLabels = $topSubjects->map(fn($item) => $item->stream_major->name ?? 'Unknown');
        $topSubjectsViews = $topSubjects->pluck('total_views');

        // Top streams in this class
        $topStreams = Stream::where('school_id', $schoolId)
            ->where('major_id', $majorId)
            ->orderByDesc('views')
            ->limit(5)
            ->get();

        $topStreamsLabels = $topStreams->map(fn($item) => Str::limit($item->title, 5));
        $topStreamsViews = $topStreams->pluck('views');

        return response()->json([
            'views_count' => $views,
            'videos_count' => $videos,
            'books_count' => $books,
            'dailyViewLabels' => $dailyViewLabels,
            'dailyViewData' => $dailyViewData,
            'top_subjects_labels' => $topSubjectsLabels,
            'top_subjects_views' => $topSubjectsViews,
            'top_course_labels' => $topStreamsLabels,
            'top_course_views' => $topStreamsViews,
        ]);
    }

    public function getCategoryOfClassInfo($school, $class, $category)
    {
        $views = Stream::where('school_id', $school)
            ->where('class_id', $class)
            ->where('class_category_id', $category)
            ->sum('views');

        $videos = Stream::where('school_id', $school)
            ->where('class_id', $class)
            ->where('class_category_id', $category)
            ->count();

        $books = Stream::where('school_id', $school)
            ->where('class_id', $class)
            ->where('class_category_id', $category)
            ->whereNotNull('file')
            ->count();

        // get last 1 week views
        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::today();
        $viewsPerDay = Stream::where('school_id', $school)
            ->where('class_id', $class)
            ->where('class_category_id', $category)
            ->selectRaw('DATE(created_at) as date, SUM(views) as total_views')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total_views', 'date');

        $dailyViewLabels = [];
        $dailyViewsChartData = [];
        $period = CarbonPeriod::create($startDate, $endDate);
        foreach ($period as $date) {
            $formatted = $date->format('Y-m-d');
            $dailyViewLabels[] = $date->format('M d');
            $dailyViewsChartData[] = $viewsPerDay[$formatted] ?? 0;
        }

        $topSubjects = Stream::where('school_id', $school)
            ->where('class_id', $class)
            ->where('class_category_id', $category)
            ->select('major_id', DB::raw('SUM(views) as total_views'))
            ->groupBy('major_id')
            ->with('stream_major')
            ->orderByDesc('total_views')
            ->limit(5)
            ->get();

        $topSubjectsLabels = $topSubjects->map(fn($item) => $item->stream_major->name ?? 'Unknown');
        $topSubjectsViews = $topSubjects->pluck('total_views');

        $topStreams = Stream::where('school_id', $school)
            ->where('class_id', $class)
            ->where('class_category_id', $category)
            ->orderByDesc('views')
            ->limit(5)
            ->get();

        $topStreamsLabels = $topStreams->map(fn($item) => Str::limit($item->title, 5));
        $topStreamsViews = $topStreams->pluck('views');

        return response()->json([
            'views_count' => $views,
            'videos_count' => $videos,
            'books_count' => $books,
            'dailyViewLabels' => $dailyViewLabels,
            'dailyViewsChartData' => $dailyViewsChartData,
            'top_subjects_labels' => $topSubjectsLabels,
            'top_subjects_views' => $topSubjectsViews,
            'top_course_labels' => $topStreamsLabels,
            'top_course_views' => $topStreamsViews,
        ]);
    }

    public function getCustomeDayInfo(Request $request, $id)
    {
        $data = $this->buildSchoolStats(
            $id,
            $request->query('filter', 'week'),
            $request->query('startDate'),
            $request->query('endDate')
        );
        return response()->json($data);
    }

    public function getCustomeDayInfoForDefault(Request $request)
    {

        $data = $this->buildSchoolStats(
            null,
            $request->query('filter', 'week'),
            $request->query('startDate'),
            $request->query('endDate')
        );

        return response()->json($data);
    }

    private function buildSchoolStats($id = null, $filter = 'week', $customStart = null, $customEnd = null)
    {
        // Date range
        switch ($filter) {
            case 'day':
                $startDate = Carbon::today();
                $endDate = Carbon::today();
                break;
            case 'week':
                $startDate = Carbon::now()->subDays(7);
                $endDate = Carbon::today();
                break;
            case 'month':
                $startDate = Carbon::now()->subDays(30);
                $endDate = Carbon::today();
                break;
            case 'custom':
                $startDate = $customStart ? Carbon::parse($customStart) : Carbon::today()->subDays(7);
                $endDate = $customEnd ? Carbon::parse($customEnd) : Carbon::today();
                break;
            default:
                $startDate = Carbon::now()->subDays(7);
                $endDate = Carbon::today();
        }

        // Base query
        $baseQuery = Stream::whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()]);

        if ($id) {
            $baseQuery->where('school_id', $id);
        }

        // Stats
        $views = (clone $baseQuery)->sum('views');
        $videos = (clone $baseQuery)->count();
        $books = (clone $baseQuery)->whereNotNull('file')->count();

        // Top subjects
        $topSubjects = (clone $baseQuery)
            ->select('major_id', DB::raw('SUM(views) as total_views'))
            ->groupBy('major_id')
            ->with('stream_major')
            ->orderByDesc('total_views')
            ->limit(5)
            ->get();

        $topSubjectsLabels = $topSubjects->map(fn($item) => $item->stream_major->name ?? 'Unknown');
        $topSubjectsViews = $topSubjects->pluck('total_views');

        // Top streams/videos
        $topStreams = (clone $baseQuery)
            ->orderByDesc('views')
            ->limit(5)
            ->get();

        $topStreamsLabels = $topStreams->map(fn($item) => Str::limit($item->title, 5));
        $topStreamsViews = $topStreams->pluck('views');

        // Daily views
        $viewsPerDay = (clone $baseQuery)
            ->selectRaw('DATE(created_at) as date, SUM(views) as total_views')
            ->groupBy('date')
            ->pluck('total_views', 'date');

        $dailyViewLabels = [];
        $dailyViewData = [];
        $period = CarbonPeriod::create($startDate, $endDate);

        foreach ($period as $date) {
            $formatted = $date->format('Y-m-d');
            $dailyViewLabels[] = $date->format('M d');
            $dailyViewData[] = $viewsPerDay[$formatted] ?? 0;
        }

        return [
            'views_count' => $views,
            'videos_count' => $videos,
            'books_count' => $books,
            'teachers_count' => 0, // placeholder
            'top_subjects_labels' => $topSubjectsLabels,
            'top_subjects_views' => $topSubjectsViews,
            'top_course_labels' => $topStreamsLabels,
            'top_course_views' => $topStreamsViews,
            'dailyViewLabels' => $dailyViewLabels,
            'dailyViewData' => $dailyViewData,
        ];
    }
}
