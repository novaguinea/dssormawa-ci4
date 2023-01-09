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

<div class="container">
    <div class="row">

        <form action="/ormawa/category/criterion/saveData" method="post" enctype="multipart/form-data">

            <?= csrf_field(); //only can be input here, prohibited input data outside of this form 
            // dd($category);
            // dd($data_nilai);
            // dd($files);
            ?>

            <div class="mt-5">
                <div class="mb-4 row">
                    <h4 style="color:dimgray"><b style="color:#0E0E0E">Penilaian kriteria:</b> <?= $criterion["criterion_name"]; ?></h4>
                </div>

                <div class="mt-3">
                    <div class="mb-3 row">
                        <label for="inputDataTitle" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputDataTitle" name="inputDataTitle" placeholder="Cth: Gemastik XV">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputDataDescription" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="inputDataDescription" name="inputDataDescription" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputDataScoring" class="col-sm-2 col-form-label">Tingkatan</label>
                        <div class="form-check col-sm-8">
                            <select class="btn btn-outline-primary" style="font-size: 14px;" maxlength="10" name="inputDataScoring" id="inputDataScoring">
                                <option value="" selected="selected">-- Pilih Tingkatan --</option>
                                <?php
                                $i = 0;
                                foreach ($scoring as $u) :
                                    // dd($scoring['id']); 
                                ?>
                                    <option value="<?= $u['score']; ?>"><?= $scoring[$i]['description']; ?></option>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="input-group mb-3">
                            <label class="col-sm-2 col-form-label" id="" for="">File Pendukung</label>
                            <input type="file" class="col-sm-6 form-control" id="inputDataSupportingFile">
                            <button type="button" class="form-control btn btn-primary col-2" id="uploadFile" name="uploadFile">Upload</button>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="input-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">
                                Catatan indikator
                            </label>
                            <p class="col-sm-10">

                                <?= $criterion["description"]; ?>
                            </p>
                        </div>
                    </div>

                    <input type="hidden" id="hiddenCategoryId" name="hiddenCriterionId" value="<?= $criterion['id']; ?>">
                    <input type="hidden" id="fileURL" name="fileURL" value="">
                    <div class="mt-5 mb-3 row">
                        <div class="col-sm-3">
                            <button type="submit" class="form-control btn btn-success" id="submitNewData">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <hr>

        <div class="mt-3 mb-3">
            <h4><b>Data <?= $criterion["criterion_name"]; ?></b></h4>
        </div>

        <div>

            <table class="table table-hover mb-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Status</th>
                        <th scope="col">Skor</th>
                        <th scope="col">Berkas</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $x = 1;

                    foreach ($data_nilai as $u) :
                        if ($u['ormawa_id'] == $ormawa_id) : ?>
                            <tr>
                                <th scope="row"><?= $x; ?></th>
                                <td><?= $u['title']; ?></td>
                                <td><?= $u['description'] ?></td>
                                <?php foreach ($status as $s) :
                                    if ($u['id_is_verified'] == $s['id']) : ?>
                                        <td value="<?= $s['id']; ?>">
                                            <?= $s['name']; ?>
                                        </td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <td><?= $u['score']; ?></td>
                                <td>
                                    <?php
                                    if ($u['file'] != null) :
                                    ?>
                                        <a class="btn" style="background-color: #FF8976; color:beige" target="_blank" href="<?= $u['file'] ?>">PDF</a>
                                    <?php endif; ?>
                                </td>
                                <td><a class="btn btn-danger" href="/ormawa/deleteData/<?= $u['criterion_id'] ?>/<?= $u['id']  ?>">Delete</a></td>
                            </tr>
                        <?php $x++;
                        endif;
                        ?>

                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- <iframe src="writable\uploads1669141597_e8cdc48d0742cbec1b07.pdf\AyoPulih - remissie. - APPETIZER HACKATHON.pdf'" width="100%" height="300" style="border:1px solid black;"> -->
            </iframe>

        </div>

    </div>
</div>

<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
<script>
    // tengkyu acil!!!!!!!!!!!!!!!!!!!!!!!!!! -> ini karena makasih aja si
    // SEMANGAT NISNOP🐖🐖🐖🐖❤️❤️❤️!!!!!!!!!!!!!!!!!!!!!!! --> ini di mushola

    const firebaseConfig = {
        apiKey: "AIzaSyD89hwK6Tvp5MUaTOfORoWaiqn2rdmdq7A",
        authDomain: "dss-ormawa-upnvj.firebaseapp.com",
        projectId: "dss-ormawa-upnvj",
        storageBucket: "dss-ormawa-upnvj.appspot.com",
        messagingSenderId: "481706310378",
        appId: "1:481706310378:web:6734c49cdc3958c21e7593"
    };

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    console.log("halo");


    var files = [];

    document.getElementById("inputDataSupportingFile").addEventListener("change", (e) => {
        console.log(e.target);
        files = e.target.files;
        console.log(files);
    });

    document.getElementById("uploadFile").addEventListener("click", () => {
        var storage = firebase.storage();
        var storageRef = storage.ref(files[0].name);
        var upload = storageRef.put(files[0]).then(() => {
            // get the URL of the uploaded file
            storageRef.getDownloadURL().then(url => {
                console.log(url);
                document.getElementById("fileURL").value = url;

            });
        });

    });
</script>

<!--content end here-->
<?= $this->endSection(); ?>