<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SaldoCard extends Component
{
    public $id;
    public $jenis;
    public $nama;
    public $saldo;

    /**
     * Create a new component instance.
     */
    public function __construct($id, $jenis, $nama, $saldo)
    {
        $this->id = $id;
        $this->jenis = $jenis;
        $this->nama = $nama;
        $this->saldo = $saldo;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.saldo-card');
    }
}