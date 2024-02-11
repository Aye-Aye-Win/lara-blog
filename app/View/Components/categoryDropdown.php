<?php
namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;
class categoryDropdown extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.category-dropdown',[
        'categories' => Category::all(),
        'currentCategory' => Category::whereSlug(request('category'))->first()
        ]);
    }
}
