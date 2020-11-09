<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CategoryChild extends Component
{
    protected $listeners = ['RefreshChild' => '$refresh'];
    public $children;

    public function render()
    {
        return view('livewire.category-child');
    }
}
