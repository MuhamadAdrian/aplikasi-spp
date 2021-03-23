<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

class HistoriController extends Controller
{
    public function index()
    {
        return Inertia::render('Histori/Index');
    }
}

