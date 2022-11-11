<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?= $this->include('layout/navbar'); ?>

<!--put your content here-->

<div class="container">
    <div class="row">
        <div class="col-8">
            <h2>
                Detail Users
            </h2>
        </div>
    </div>
</div>

<!--content end here-->
<?= $this->endSection(); ?>