<?php

use App\Http\Livewire\Category;
use App\Http\Livewire\CategoryDropdown;
use Illuminate\Support\Facades\Route;

Route::get('/', CategoryDropdown::class);
Route::get('/category', Category::class);
