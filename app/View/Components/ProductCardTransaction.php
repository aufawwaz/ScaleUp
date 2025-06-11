<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;

class ProductCardTransaction extends Component
{
    public $product;
    public $backlink;

    /**
     * Create a new component instance.
     */
    public function __construct(Product $product, $backlink = 'product.show')
    {
        $this->product = $product;
        $this->backlink = $backlink;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-card-transaction');
    }
}
