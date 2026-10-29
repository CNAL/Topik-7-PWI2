<?php

namespace App\Http\Controllers;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = [
            'Chrysels Nicha Aime Laoh',
            'Celena Naraya Dinanti',
            'Keisha Aurelia Putri Williams',
        ];

        return view('pages.mahasiswa', [
            'mahasiswa' => $mahasiswa,
        ]);
    }
}
