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
    public $source;
    public $image;
    /**
     * Create a new component instance.
     */
    public function __construct($news)
    {
        $this->id          = $news['article_id'] ?? '';
        $this->title       = $news['title'] ?? '';
        $this->description = $news['description'] ?? 'Tidak Ada Kosong';
        $this->image       = $news['image_url'] ?? $news['image'] ?? asset('asset/news_dummy_image.png');

        $dateRaw           = $news['pubDate'] ?? $news['date'] ?? now()->toDateString();
        try {
            $this->date = Carbon::parse($dateRaw)->translatedFormat('d F Y');
        } catch (\Exception $e) {
            $this->date = now()->translatedFormat('d F Y');
        }
        
        $this->source      = $news['source_id'] ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.news-card');
    }

}
