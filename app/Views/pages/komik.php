<?= $this->extend('static/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/komik/create" class="btn btn-primary mt-3">Tambah Komik</a>
            <h1><?= $title; ?></h1>
            <?php if (session()->getFlashdata('pesan')) : //mengambil flash data
            ?>
                <div class="alert alert-success" role="alert">
                    <!-- <?php session()->getFlashdata('pesan') ?> -->
                    Data Berhasil Disimpan
                </div>
            <?php endif; ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($komik as $data) : ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><img src="/gambar/<?= $data['sampul'] ?>" class="sampul" alt=""></td>
                            <td><?= $data['judul']; ?></td>
                            <td><a href="/komik/<?= $data['slug']; ?>" class="btn btn-success">Detail</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>