<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class LaporanController extends Controller
{
    public function index()
    {
        return Inertia::render('Laporan/Index');
    }
}
