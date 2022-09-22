<?php

namespace App\Controllers;

class Coba extends BaseController
{
    public function index()
    {
        echo "Ini Controller Coba Method Index";
    }

    public function Coba() //untuk memanggil harus di buat dulu routernya
    {
        echo "Ini Controller Coba";
    }

    public function GetNama()
    {
        echo "Hallo Nama Saya $this->nama"; //mengambil isi nama dari File BaseController //harus menggunakan "
    }

    public function GetDataURL($nama = '')
    {
        echo "Hallo Nama Di Url $nama";
    }
}
