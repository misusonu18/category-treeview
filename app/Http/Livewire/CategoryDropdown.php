<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryDropdown extends Component
{
    public $categories;
    public $parentCategory;

    protected $listeners = [
        'fetchChildCategories',
    ];

    public function fetchChildCategories($categoryId)
    {
        $categories = Category::where('parent_id', $categoryId)->get();
        $this->dispatchBrowserEvent('create-child-category', ['newChild' => $categories]);
    }

    public function mount()
    {
        $this->categories = Category::where('parent_id', '=', 0)->get();
    }

    public function render()
    {
        return view('livewire.category-dropdown');
    }
}
