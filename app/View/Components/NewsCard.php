<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Carbon\Carbon;

class NewsCard extends Component
{
    public $id;
    public $title;
    public $description;
    public $date;
    public $views;
    public $image;
    /**
     * Create a new component instance.
     * @param $news row data dari database
     */
    public function __construct($news)
    {
        $this->id          = $news->id;
        $this->title       = $news->title;
        $this->description = $news->description;
        $this->image       = $news->image;
        $this->date        = Carbon::parse($news->date)->translatedFormat('d F Y');
        $this->views       = $news->view > 999 ? number_format($news->view / 1000, 1) . 'K' : $news->view;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.news-card');
    }
}
