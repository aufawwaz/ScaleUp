<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FilterButton extends Component
{
    public string $label;
    public string $icon;
    public string $value;
    public string $active;

    public function __construct($label = '', $icon = '', $value = '', $active = '')
    {
        $this->label = $label;
        $this->icon = $icon;
        $this->value = $value;
        $this->active = $active ?? '';
    }

    public function render()
    {
        return view('components.filter-button');
    }
}
