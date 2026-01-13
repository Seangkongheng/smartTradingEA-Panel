<?php

namespace App\Http\Controllers\NewsController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\Dashboard\App\Models\News;
use Modules\Dashboard\App\Models\SettingTitle;

class NewsController extends Controller
{

    public function index()
    {
        $newsTitileSectionForNews = SettingTitle::select('title', 'description','header_background','logo')->where('id', 6)->first();

        $news = News::where('is_public', 1)
            ->orderBy('id', 'desc')
            ->paginate(8)
            ->through(function ($item) {
                $images = json_decode($item->image, true);
                $item->first_image = $images[0] ?? null;
                return $item;
        });

        return view('frontEnd.new.index', compact('news','newsTitileSectionForNews'));

    }
    public function show($id)
    {
        $newsDetail = News::findOrFail($id);
        $newsDetail->increment('impressions_count');

        $relateNews = $this->getNewsRelate($newsDetail);
        $popularNews =$this->getNewsPopular();
        return view('frontEnd.newDetail.index', compact('newsDetail', 'relateNews','popularNews'));
    }

    public function getNewsPopular(){
        $popularNews = News::where('is_public',1)->orderBy('impressions_count', 'desc')->take(3)->get();
        return $popularNews;
    }

    public function getNewsRelate($newsDetail)
    {
        $keywords = explode(' ', $newsDetail->title);
        $relatedNews = News::where('id', '!=', $newsDetail->id)
            ->where(function ($query) use ($keywords) {
                foreach ($keywords as $word) {
                    $query->orWhere('title', 'LIKE', '%' . $word . '%');
                    $query->orWhere('content', 'LIKE', '%' . $word . '%');
                }
            })->where('is_public', 1)
            ->take(5)
            ->get();
        return $relatedNews;
    }
}
