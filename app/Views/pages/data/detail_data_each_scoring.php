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

<style>
    /* .dropdown-verification {
        width: 300px !important;
        height: 200px !important;
    } */
    tr {
        height: 50px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="row mt-5 mb-5">
                <h2 class="col-sm-5 col-md-6"><?= $criterion['criterion_name']; ?></h2>
            </div>
            <table cellspacing="2">
                <tr>
                    <th class="col-4">Judul</th>
                    <td class="col-2">:</td>
                    <td><?= $data['title']; ?></td>
                </tr>
                <tr>
                    <th class="col-4">Deskripsi</th>
                    <td class="col-2">:</td>
                    <td><?= $data['description']; ?></td>
                </tr>
                <!-- <tr class="spaceUnder">
                    <th class="col-4">Tingkat</th>
                    <td class="col-2">:</td>
                    <td><?= $data['scope']; ?></td>
                </tr> -->
                <tr>
                    <th class="col-4">Link drive</th>
                    <td class="col-2">:</td>
                    <td></td>
                </tr>
                <tr class="spaceUnder">
                    <th class="col-4">File</th>
                    <td class="col-2">:</td>
                    <td>
                        <?php if ($data['file'] != null) : ?>
                            <a class="btn" style="background-color: #4688F4; color:beige" target="_blank" href="<?= $data['file'] ?>">Link</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th class="col-4">Status</th>
                    <td class="col-2">:</td>
                    <td>
                        <div class="dropdown dropdown-verification" style="height: 50%;">
                            <form action="/data/updateStatusData" id="updateStatus" method="post" onchange="">
                                <input name="idForDataOrmawaStatus" type="hidden" value="<?= $data['id']; ?>">
                                <?php if ($data['id_is_verified'] == 1 && $role_id == 4) : ?>
                                    <p style="color: green;"><b>Diterima Juri</b></p>
                                <?php else : ?>
                                    <select class="btn btn-primary" name="dataOrmawaStatus" id="" onchange="this.form.submit()">
                                        <?php foreach ($status as $s) :
                                            if ($data['id_is_verified'] == $s['id']) : ?>
                                                <option value="<?= $s['id']; ?>" selected="<?= "selected"; ?>">
                                                    <?= $s['name']; ?>
                                                </option>
                                            <?php else : ?>
                                                <option value="<?= $s['id']; ?>">
                                                    <?= $s['name']; ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </select>
                            </form>
                        </div>
                    </td>
                </tr>
            </table>
            <!-- showing PDF -->
            <iframe src="<?= $data['file']; ?>" frameborder="0"></iframe>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>