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
        session(); //penambahan validation //bisa juga di simpan di basecontroller
        $data = [
            'title' => 'Form Create',
            'validation' => \Config\Services::validation()
        ];

        return view('pages/create_komik', $data);
    }

    public function Save()
    {
        //Validasi input
        if (!$this->validate([
            //aturan validasi
            'judul' => [ //bisa lebih dari 1 rule/aturan //required = harus di isi //is_unique = tidak boleh ada data sama //selengkapnya bisa di cek di module ci4 validation paling bawah
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [ //error tiao rule
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'sampul' => [
                'rules' => 'uploaded[sampul]|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]', //bisa di lihat di dokumentasi codeignitor
                'errors' => [
                    'uploaded' => 'Sampul harus di upload',
                    'max_size' => 'Gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar',
                ]
            ]
            // 'penulis' => 'required|'
        ])) {
            //mengambil pesan salah
            // $validation = \Config\Services::validation();
            // return redirect()->to('/komik/create')->withInput()->with('validation', $validation); //withInput() = mengirim semua data yang sebelumnya di input //with('validation', $validation) = mengirim data menggunakan redirect, validation = namanya, $validation = isinya
            return redirect()->to('/komik/create')->withInput(); //withInput() = mengirim semua data yang sebelumnya di input //with('validation', $validation) = mengirim data menggunakan redirect, validation = namanya, $validation = isinya
            //lalu masukan ke create
        }
        // $this->request->getVar('judul'); //untuk mengambil data 1
        // dd($this->request->getVar()); //mengambil request apapun get atau post

        //ambil gambar
        $fileSampul = $this->request->getFile('sampul'); //mengambil sampul
        //generate random nama sampul
        $namaSampul = $fileSampul->getRandomName();
        //pindahkan ke folder
        // $fileSampul->move('gambar'); //memindahkan sampul ke folder gambar yang ada di public //nama tidak random
        $fileSampul->move('gambar', $namaSampul); //memindahkan sampul ke folder gambar yang ada di public //nama random
        // //ambil nama file untuk dimasukan kedatabase
        // $namaSampul = $fileSampul->getName();

        //slug adalah judul yang sudah di olah jika ada spasi maka di ganti _
        $slug = url_title($this->request->getVar('judul'), '_', true); //"url_title()" untuk membuat semua huruf kecil dan spasinya hilang
        //untuk input data ke database
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil disimpan'); //menampilkan notif yang hanya selewat

        return redirect()->to('/komik'); //redirect ke komik awal
    }

    public function Delete($id)
    {
        //cari gambar berdasarkan id
        $komik = $this->komikModel->find($id);

        //hapus gambar dalam folder
        unlink('gambar/' . $komik['sampul']);

        $this->komikModel->delete($id); //menghapus data didatabase
        session()->setFlashdata('delete', 'Data Berhasil dihapus');
        return redirect()->to('/komik');
    }

    public function Edit($slug)
    {
        session(); //penambahan validation //bisa juga di simpan di basecontroller
        $data = [
            'title' => 'Form Edit',
            'validation' => \Config\Services::validation(),
            'komik' => $this->komikModel->GetKomik($slug)
        ];

        return view('pages/edit_komik', $data);
    }

    public function Update($id)
    {
        // $u = $komikLama['judul'];
        // dd($komikLama);
        $komikLama = $this->komikModel->GetKomik($this->request->getVar('slug'));
        //cek judul
        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[komik.judul]';
        }

        if (!$this->validate([
            //aturan validasi
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [ //error tiao rule
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'sampul' => [
                'rules' => 'uploaded[sampul]|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]', //bisa di lihat di dokumentasi codeignitor
                'errors' => [
                    'uploaded' => 'Sampul harus di upload',
                    'max_size' => 'Gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar',
                ]
            ]
        ])) {
            //mengambil pesan salah
            // $validation = \Config\Services::validation();
            // return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');
        //cek gambar berubah atau tidak
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            //generate file random
            $namaSampul = $fileSampul->getRandomName();
            // pindahkan gambar
            $fileSampul->move('gambar', $namaSampul);
            //hapus file lama
            unlink('gambar/' . $this->request->getVar('sampulLama'));
        }

        $slug = url_title($this->request->getVar('judul'), '_', true); //"url_title()" untuk membuat semua huruf kecil dan spasinya hilang
        //untuk input/update data ke database
        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil disimpan');

        return redirect()->to('/komik');
    }
}
