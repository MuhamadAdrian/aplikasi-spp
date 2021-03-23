<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SppController extends Controller
{
    public function index()
    {
        return Inertia::render('Spp/Index');
    }
}
