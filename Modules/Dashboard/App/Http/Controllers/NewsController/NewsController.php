<?php

namespace Modules\Dashboard\App\Http\Controllers\NewsController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Dashboard\App\Models\News;

class NewsController extends Controller
{

    public function index()
    {
        // get all new and filter first image for display
        $news = News::Orderby('id','desc')->paginate(12)->through(function ($item) {
            $images = json_decode($item->image, true);
            $item->first_image = $images[0] ?? null;
            return $item;
        });
        return view('dashboard::news.index', compact('news'));
    }


    public function create()
    {
        return view('dashboard::news.addOrEdit');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'title' => 'required|string',
                'content' => 'required|string',
            ]);

            $post_by = Auth()->user()->id;
            // slider image
            $newsImage = [];
            $newsImageName = null;
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $newsImageName = time() . '-' . $file->getClientOriginalName();
                    $file->move(public_path('newsImages/'), $newsImageName);
                    $newsImage[] = $newsImageName;
                }
            }

            $post_is_public = $request->input('is_public', 1);
            // create school
            News::create([
                'title' => $request->title,
                'content' => $request->content,
                'post_by' => $post_by,
                'is_public' => $post_is_public,
                'image' => json_encode($newsImage),
                'url' => $request->url,
            ]);

            DB::commit();
            return redirect()->route('admin.news.index')->with('message', 'News Created Successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    public function show($id)
    {
        $new = News::findOrFail($id);
        return view('dashboard::news.show', compact('new'));
    }

    public function edit($id)
    {
        $newsEdit = News::findOrFail($id);
        return view('dashboard::news.addOrEdit', compact('newsEdit'));
    }


    public function update(Request $request, $id)
    {
        try {
            $news = News::findOrFail($id);
            // Handle news images
            $newImages = [];
            if ($request->hasFile('image')) {
                // Delete old slider images
                if (!empty($news->images)) {
                    $oldImages = json_decode($news->image, true) ?? [];
                    foreach ($oldImages as $oldImage) {
                        $oldImagePath = public_path('newsImages/' . $oldImage);
                        if (file_exists($oldImagePath)) {
                            @unlink($oldImagePath);
                        }
                    }
                }
                // Save new slider images
                foreach ($request->file('image') as $file) {
                    $sliderName = time() . '-' . $file->getClientOriginalName();
                    $file->move(public_path('newsImages/'), $sliderName);
                    $newImages[] = $sliderName;
                }
            } else {
                if (!empty($news->image)) {
                    $newImages = json_decode($news->image, true) ?? [];
                }
            }
            $post_by = Auth()->user()->id;
            $post_is_public = $request->input('is_public', 1);
            $news->update([
                'title' => $request->title,
                'content' => $request->content,
                'post_by' => $post_by,
                'is_public' => $post_is_public,
                'image' => json_encode($newImages),
                'url' => $request->url,
            ]);

            return redirect()->route('admin.news.index')->with("message", 'News update successfully');
        } catch (Exception $e) {
            return redirect()->route('admin.news.index')->with("message", $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $news = News::findOrFail($id);
            if ($news->image && file_exists(public_path('newsImages' . $news->image))) {
                @unlink(public_path('newsImages/' . $news->image));
            }
            $news->delete();
            return redirect()->route('admin.news.index')->with("message", 'News Deleted Successfully');
        } catch (Exception $e) {
            return redirect()->route('admin.news.index')->with("error", $e->getMessage());
        }
    }
    public function newsSearch(Request $request)
    {
        $search_string = $request->search_string;
        $status = $request->status;

        $newsQuery = News::where(function ($query) use ($search_string) {
            $query->where('title', 'like', '%' . $search_string . '%')
                ->orWhere('content', 'like', '%' . $search_string . '%');
        });

        // Filter by status if selected
        if ($status !== null && $status !== '') {
            $newsQuery->where('is_public', $status);
        }





        $news = $newsQuery->orderBy('id', 'desc')->paginate(10);

        // Decode images and get first image for each item in the current page
        $news->getCollection()->transform(function ($item) {
            $images = json_decode($item->image, true);
            $item->first_image = $images[0] ?? null;
            return $item;
        });


        if ($news->count() >= 1) {
            return view('dashboard::news.partials.tableInformation.newsTable', compact('news'))->render();
        } else {
            return response()->json([
                'status' => "Nothing found",
            ]);
        }
    }


}
