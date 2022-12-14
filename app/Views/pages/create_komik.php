<?= $this->extend('static/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3"><?= $title; ?></h2>
            <?php //$validation->listErrors(); //mengambil semua list error 
            ?>
            <!-- enctype="multipart/form-data" = wajib ada jika upload file -->
            <form action="/komik/save" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); //agar hanya di input di form ini saja 
                ?>
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <!-- ifelse dalam satu baris mengecek ada atau tidaknya data -->
                    <!-- <?php //old('judul'); 
                            ?> = untuk membawa kembali nilai yang sudah diinput -->
                    <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" name="judul" value="<?= old('judul'); ?>" autofocus>
                    <div class="invalid-feedback">
                        <?= $validation->getError('judul'); //mengambil haserror dari judul di controller
                        ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" class="form-control" name="penulis">
                </div>
                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" class="form-control" name="penerbit">
                </div>
                <div class="mb-3">
                    <!-- <label class="form-label">Sampul</label>
                    <input type="file" class="form-control" name="sampul"> -->
                    <div class="custom-file">
                        <input type="file" class="custom-file-input <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" id="sampul" name="sampul">
                        <?= $validation->getError('sampul'); //mengambil haserror dari judul di controller
                        ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>