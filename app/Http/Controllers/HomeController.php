<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $nama = auth()->user()->name ?? null;

        return view('home', [
            'nama' => $nama
        ]);
    }
}
