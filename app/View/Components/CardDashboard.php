<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardDashboard extends Component
{
    public string $title;
    public string $value;
    public string $icon;
    public string $buttonLabel;
    public string $buttonUrl;

    public function __construct($title, $value, $icon, $buttonLabel, $buttonUrl)
    {
        $this->title = $title;
        $this->value = $value;
        $this->icon = $icon;
        $this->buttonLabel = $buttonLabel;
        $this->buttonUrl = $buttonUrl;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-dashboard');
    }
}
