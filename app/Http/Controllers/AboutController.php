<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Mengirim data diri ke view
        $data = [
            'nama'  => 'Ariel Dian Fajarrizqi',
            'nim'   => '20230140168',
            'prodi' => 'Teknologi Informasi',
            'hobi'  => 'Makan'
        ];
        
        return view('about', compact('data'));
    }
}