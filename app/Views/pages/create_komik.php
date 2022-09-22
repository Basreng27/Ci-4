<?= $this->extend('static/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3"><?= $title; ?></h2>

            <form action="/komik/save" method="POST">
                <?= csrf_field(); //agar hanya di input di form ini saja 
                ?>
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control" name="judul" required autofocus>
                </div>
                <!-- <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control" name="slug" required>
                </div> -->
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" class="form-control" name="penulis" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" class="form-control" name="penerbit" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sampul</label>
                    <input type="text" class="form-control" name="sampul" required>
                </div>
                <!-- <div class="mb-3">
                    <label class="form-label">Created</label>
                    <input type="text" class="form-control" name="created_at" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Update</label>
                    <input type="text" class="form-control" name="updated_at" required>
                </div> -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>