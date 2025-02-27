<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $options = [
            0 => 'Tidak',
            1 => 'Ya',
        ];

        $user = auth()->user();
        $is_wanita = $user->gender == 'P';

        return view('laporan.create', [
            'options' => $options,
            'is_wanita' => $is_wanita
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
