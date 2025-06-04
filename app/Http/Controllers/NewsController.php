<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = News::orderBy('date', 'desc')->get();

        $mostPopularNews = $data->sortByDesc(function ($news) {
            // nilai kepopularitas = view / hari sejak news di create
            $jumlahHari = Carbon::parse($news->date)->diffInDays(now());
            $jumlahHari = $jumlahHari === 0 ? 1 : $jumlahHari; // biar gak bagi 0
            
            return $news->view / $jumlahHari;
        })->first(); // nilai kepopularitas tertinggi diambil

        return view('news', compact('data', 'mostPopularNews'));
    }
    /**
     * Get
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        //
    }
}
