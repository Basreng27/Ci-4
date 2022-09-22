<?= $this->extend('static/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3"><?= $title; ?></h2>
            <?php //$validation->listErrors(); //mengambil semua list error 
            ?>
            <?php if (session()->getFlashdata('pesan')) { //mengambil flash data
            ?>
                <div class="alert alert-success" role="alert">
                    <!-- <?php session()->getFlashdata('pesan') ?> -->
                    Data Berhasil Disimpan
                </div>
            <?php } ?>
            <form action="/komik/update/<?= $komik['id']; ?>" method="POST">
                <?= csrf_field(); //agar hanya di input di form ini saja 
                ?>
                <input type="hidden" name="slug" value="<?= $komik['slug']; ?>">
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <!-- ifelse dalam satu baris mengecek ada atau tidaknya data -->
                    <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" name="judul" value="<?= $komik['judul']; ?>" autofocus>
                    <div class="invalid-feedback">
                        <?= $validation->getError('judul'); //mengambil haserror dari judul di controller
                        ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" class="form-control" name="penulis" value="<?= $komik['penulis']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" class="form-control" name="penerbit" value="<?= $komik['penerbit']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Sampul</label>
                    <input type="text" class="form-control" name="sampul" value="<?= $komik['sampul']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>