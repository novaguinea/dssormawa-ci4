<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php if ($role_id == 2) : ?>
    <?= $this->include('layout/sidebar_admin'); ?>
<?php else : ?>
    <?= $this->include('layout/sidebar_ormawa'); ?>
<?php endif; ?>

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