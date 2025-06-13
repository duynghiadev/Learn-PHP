<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tour;
use App\Models\Gallery;
use App\Models\Schedule;

class IndexController extends Controller
{
    public function index()
    {
        $category_parent = Category::where('category_parent', 0)->get();
        $category_subs = array();
        $category_sub_cate = Category::where('category_parent', '!=', 0)->get();
        foreach ($category_sub_cate as $key => $value) {
            $category_subs[] = $value->id;
        }
        $tours = Tour::with('category')->orderBy('id', 'DESC')->get();
        // print_r($category_subs);
        return view('pages.home', compact('category_parent', 'tours'));
    }
    public function tour($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $tours = Tour::where('category_id', $category->id)->orderBy('id', 'DESC')->get();
        return view('pages.tour', compact('tours', 'category'));
    }
    public function detail_tour($slug)
    {
        $tour = Tour::with('category')->where('slug', $slug)->first();
        $schedule = Schedule::where('tour_id', $tour->id)->first();
        $related_tour = Tour::where('category_id', $tour->category_id)->whereNotIn('id', [$tour->id])->get();
        $galleries = Gallery::where('tour_id', $tour->id)->get();
        return view('pages.detail_tour', compact('tour', 'related_tour', 'galleries', 'schedule'));
    }
}
