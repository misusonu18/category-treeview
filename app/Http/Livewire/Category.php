<?php

namespace App\Http\Livewire;

use App\Models\Category as ModelsCategory;
use Livewire\Component;

class Category extends Component
{
    public $categories;
    public $editCategory = false;
    public $createCategory = false;
    public $title;
    public $categoryId;

    protected $rules = [
        'title' => 'required|unique:categories',
    ];

    protected $listeners = [
        'editCategory',
        'deleteCategory',
        'addCategory',
        'addChildCategory',
        'Refresh' => '$refresh',
    ];

    public function editCategory($id)
    {
        $getDetails = ModelsCategory::whereId($id)->first();
        $this->categoryId = $id;
        $this->title = $getDetails->title;
        $this->createCategory = false;
        $this->editCategory = true;
    }

    public function updateCategory()
    {
        ModelsCategory::whereId($this->categoryId)->first()->update([
            'title' => $this->title,
        ]);
        $this->categoryId = '';
        $this->title = '';
        $this->editCategory = false;
        $this->emit('Refresh');
    }

    public function deleteCategory($id)
    {
        ModelsCategory::whereId($id)->delete();
        $this->mount();
    }

    public function addCategory()
    {
        $this->editCategory = false;
        $this->createCategory = true;
        $this->validate();
        ModelsCategory::create([
            'title' => $this->title,
            'parent_id' => 0
        ]);
        $this->title = '';
        $this->createCategory = false;
        $this->mount();
    }

    public function addChildCategory($id)
    {
        $this->editCategory = false;
        $this->createCategory = true;
        $this->categoryId = $id;
        $this->validate();
        ModelsCategory::create([
            'title' => $this->title,
            'parent_id' => $this->categoryId
        ]);
        $this->categoryId = '';
        $this->title = '';
        $this->createCategory = false;
        $this->emit('Refresh');
    }

    public function mount()
    {
        $this->categories = ModelsCategory::where('parent_id', '=', 0)->get();
    }

    public function render()
    {
        return view('livewire.category');
    }
}
