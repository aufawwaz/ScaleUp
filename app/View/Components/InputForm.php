<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputForm extends Component
{
    public string $type;
    public string $name;
    public string $icon;
    public string $placeholder;
    public string $textSize;
    public string $autoComplete;
    /**
     * Create a new component instance.
     */
    public function __construct(string $type, string $name, string $icon, string $placeholder, string $textSize = 'sm', string $autoComplete = 'on')
    {
        $this->type = $type;
        $this->name = $name;
        $this->icon = $icon;
        $this->placeholder = $placeholder;
        $this->textSize = $textSize;
        $this->autoComplete = $autoComplete;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input_form');
    }
}
