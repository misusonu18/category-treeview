<?php

use App\Http\Livewire\Category;
use App\Http\Livewire\CategoryDropdown;
use App\Http\Livewire\NestedComponent;
use Illuminate\Support\Facades\Route;

Route::get('/category', CategoryDropdown::class);
Route::get('/view', Category::class);
