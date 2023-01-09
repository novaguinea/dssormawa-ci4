<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php

switch ($role_id) {
    case 1:
        echo $this->include('layout/sidebar_ormawa');
        break;
    case 2:
        echo $this->include('layout/sidebar_admin');
        break;
    case 3:
        echo $this->include('layout/sidebar_juri');
        break;
    default:
        echo $this->include('layout/sidebar_pembina');
}

?>

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