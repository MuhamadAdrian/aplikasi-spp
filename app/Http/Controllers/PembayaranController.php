<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

class PembayaranController extends Controller
{
    public function index()
    {
        return Inertia::render('Pembayaran/Index');
    }
}

