<!-- memberi tahu bahwa file ini akan menggunakan template.php dari views/pages -->
<!-- memanggil templatenya -->
<?= $this->extend('static/template'); ?>

<!-- menandai bawa yang berada dalam block section adalah isinya -->
<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>About dari Home</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quam quasi laborum ipsa fugiat quis labore assumenda tempora reprehenderit, odit nihil illum maiores ea consequatur veritatis perspiciatis eaque non eos.</p>
            <!-- <h1><?= $nama; ?></h1>
            <h1><?= $ig; ?></h1>
            <?php
            var_dump($test);
            d($test); //pengganti var_dump
            dd($test); //pengganti var_dump tapi code selanjutnya tidak di baca -->
            ?> -->
        </div>
    </div>
</div>
<?= $this->endSection() ?>