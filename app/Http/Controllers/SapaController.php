<?php

namespace App\Http\Controllers;

class SapaController extends Controller
{
    public function index()
    {
        $nama = 'Sendy Prayogo';

        return view('pages.sapa', [
            'nama' => $nama,
        ]);
    }
}
