<?php

use App\Http\Livewire\Category;
use App\Http\Livewire\CategoryDropdown;
use Illuminate\Support\Facades\Route;

Route::get('/category', Category::class);
Route::get('/', CategoryDropdown::class);
