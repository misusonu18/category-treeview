<?php

namespace App\Http\Livewire;

use App\Models\Category as ModelsCategory;
use Livewire\Component;

class Category extends Component
{
    public $categories;
    public $categorySelect;
    public $editCategory = false;
    public $createCategory = false;
    public $title;
    public $categoryId;
    public $categorySelection;

    protected $rules = [
        'title' => 'required|unique:categories',
    ];

    protected $listeners = [
        'editCategory',
        'deleteCategory',
        'addCategory',
        'addChildCategory',
        'getChildCategory',
        'getChildId' => 'getChildId',
        'CategorySelection' => 'CategorySelection',
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
        $this->validate();
        ModelsCategory::whereId($this->categoryId)->first()->update([
            'title' => $this->title,
        ]);
        $this->categoryId = '';
        $this->title = '';
        $this->editCategory = false;
        $this->refreshComponent();
    }

    public function deleteCategory($id)
    {
        $hasParentCategory = ModelsCategory::where('parent_id', $id)->exists();
        $categoryName = ModelsCategory::whereId($id)->first();
        if (!$hasParentCategory) {
            ModelsCategory::whereId($id)->delete();
            $this->refreshComponent();
        } else {
            session()->flash('message', 'There are child category for this '. $categoryName->title .' category. Cannot be deleted.');
        }
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
        $this->refreshComponent();
    }

    public function getChildCategory($id)
    {
        $this->editCategory = false;
        $this->createCategory = true;
        $this->categoryId = $id;
        $this->refreshComponent();
    }

    public function addChildCategory($id)
    {
        $this->validate();
        ModelsCategory::create([
            'title' => $this->title,
            'parent_id' => $id
        ]);
        $this->categoryId = '';
        $this->title = '';
        $this->createCategory = false;
        $this->refreshComponent();
    }

    public function refreshComponent()
    {
        $this->mount();
        $this->emit('Refresh');
        $this->emit('RefreshChild');
    }

    public function CategorySelection($id)
    {
        $categories = ModelsCategory::where('parent_id', $id)->get();
        $this->dispatchBrowserEvent('child-category', ['newChild' => $categories]);
    }

    public function getChildId($id, $parentId)
    {
        ModelsCategory::whereId($id)->first()->update(['parent_id' => $parentId]);
    }

    public function mount()
    {
        $this->categories = ModelsCategory::where('parent_id', '=', 0)->get();
        $this->categorySelect = ModelsCategory::get(['id as value', 'title as label']);
    }

    public function render()
    {
        return view('livewire.category');
    }
}
