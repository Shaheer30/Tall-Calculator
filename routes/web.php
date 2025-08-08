<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Calculator;

Route::get('/', Calculator::class)->name('calculator');
