<?php

namespace App\Controllers;

use App\Models\Komik_Model; //ini meload model

class Komik extends BaseController
{
    protected $komikModel; //agar bisa di pakai semua class turunan

    public function __construct()
    {
        $this->komikModel = new Komik_Model(); //meload komik model //jangan lupa di panggil dulu diatas
    }

    public function index()
    {
        //mengambil semua data komik
        // $komik = $this->komikModel->findAll();
        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->GetKomik() //mengambil data semua
        ];

        return view('pages/komik', $data);
    }

    public function Detail($slug)
    {
        $data = [
            'title' => 'Detail Komik',
            'komik' => $this->komikModel->GetKomik($slug) //mengambil data dari database berdasarkan slug //"first()" data pertama
        ];

        return view('pages/detail_komik', $data);
    }
}
