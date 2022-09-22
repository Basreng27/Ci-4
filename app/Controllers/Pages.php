<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function Home()
    {
        //kalau return hanya bisa di gunakan 1x di 1 function jadi menggunakan echo
        // return view('static\header'); //untuk meload header
        echo view('static\header'); //untuk meload header
        echo view('pages\home'); //untuk memanggil file di dalam view
        echo view('static\footer'); //untuk meload footer
    }

    public function About()
    {
        $data = [
            'nama' => 'Rayandra Wandi Marselana',
            'ig' => "raywndi_",
            'test' => ["satu", "dua", "tiga"]
        ];
        // echo view('static\header');
        return view('pages/about', $data); //untuk menggabungkan header dan footer menggunakan section
        // echo view('static\footer');
    }
}
