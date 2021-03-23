<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PetugasController extends Controller
{
    public function index()
    {
        return Inertia::render('Petugas/Index');
    }
}

