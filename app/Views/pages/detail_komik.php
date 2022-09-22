<?= $this->extend('static/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1><?= $title; ?></h1>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Update At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $komik['id']; ?></td>
                        <td><?= $komik['judul']; ?></td>
                        <td><?= $komik['slug']; ?></td>
                        <td><?= $komik['penulis']; ?></td>
                        <td><?= $komik['penerbit']; ?></td>
                        <td><img src="/gambar/<?= $komik['sampul'] ?>" class="sampul" alt=""></td>
                        <td><?= $komik['created_at']; ?></td>
                        <td><?= $komik['updated_at']; ?></td>
                        <td><a href="/edit_komik" class="btn btn-info">Edit</a> || <a href="/komik" class="btn btn-danger">Back</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>