<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryDropdown extends Component
{
    public $categories;

    protected $listeners = [
        'CategorySelection' => 'CategorySelection',
    ];

    public function CategorySelection($id)
    {
        $categories = Category::where('parent_id', $id)->get();
        $this->dispatchBrowserEvent('child-category', ['newChild' => $categories]);
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
