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

        // jika komik tidak ada di table
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik ' . $slug . ' Tidak ditemukan'); //untuk menampilkan error 404
        }

        return view('pages/detail_komik', $data);
    }

    public function Create()
    {
        $data = [
            'title' => 'Form Create'
        ];

        return view('pages/create_komik', $data);
    }

    public function Save()
    {
        // $this->request->getVar('judul'); //untuk mengambil data 1
        // dd($this->request->getVar()); //mengambil request apapun get atau post

        //slug adalah judul yang sudah di olah jika ada spasi maka di ganti _
        $slug = url_title($this->request->getVar('judul'), '_', true); //"url_title()" untuk membuat semua huruf kecil dan spasinya hilang
        //untuk input data ke database
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil disimpan'); //menampilkan notif yang hanya selewat

        return redirect()->to('/komik'); //redirect ke komik awal
    }
}
