<?php
//biasanya model dibuat 1 dengan tabel yang ada di database jika tabel di database komik maka nama model komik jika buku maka modelnya buku
namespace App\Models;

use CodeIgniter\Model;

class Komik_Model extends Model
{
    protected $table = 'komik'; //nama table di database
    protected $primaryKey = 'id'; //default nya id tapi jika di databasenya beda maka isikan seperti yang ada di database
    protected $useTimestamps = true; //untuk create_at dan update_at
    protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul']; //data yang hanya bisa di isi oleh user / inputan

    public function GetKomik($slug = false)
    {
        if ($slug == false) { //jika $slug kosong
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function GetKomikId($id = false)
    {
        if ($id == false) { //jika $id kosong
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}
