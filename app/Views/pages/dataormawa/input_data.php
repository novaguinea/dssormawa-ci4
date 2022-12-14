<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?= $this->include('layout/navbar'); ?>

<!--put your content here-->

<div class="container">
    <div class="row">
        <div class="col-8">
        </div>

        <form action="/ormawa/category/criterion/saveData" method="post" enctype="multipart/form-data">

            <?= csrf_field(); //only can be input here, prohibited input data outside of this form 
            // dd($category);
            // dd($data_nilai);
            // dd($files);
            ?>

            <div class="mt-3">
                <div class="mb-4 row">
                    <h4 style="color:dimgray"><b style="color:#0E0E0E">Penilaian kriteria:</b> <?= $criterion["criterion_name"]; ?></h4>
                </div>

                <div class="mt-3">
                    <div class="mb-3 row">
                        <label for="inputDataTitle" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputDataTitle" name="inputDataTitle" placeholder="Cth: Gemastik XV">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputDataDescription" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="inputDataDescription" name="inputDataDescription" rows="3"></textarea>
                        </div>

                    </div>
                    <div class="mb-3 row">
                        <label for="inputDataScoring" class="col-sm-2 col-form-label">Tingkatan</label>
                        <div class="form-check col-sm-10">
                            <select name="inputDataScoring" id="inputDataScoring">
                                <option value="" selected="selected">---</option>
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
                        <div class="input-group mb-3 col-sm-10">
                            <label for="inputDataSupportingFile" class="col-sm-2 col-form-label">File Pendukung </label>
                            <input type="file" class="form-control" id="inputDataSupportingFile" name="inputDataSupportingFile">
                            <!-- <label class="input-group-text btn btn-primary" for="inputDataSupportingFile">Upload</label> -->
                        </div>
                    </div>
                    <input type="hidden" id="hiddenCategoryId" name="hiddenCriterionId" value="<?= $criterion['id']; ?>">
                    <div class="mt-2 mb-3 row">
                        <div class="col-sm-3">
                            <button type="submit" class="form-control btn btn-success" id="submitNewCriterion">
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
                        <th scope="col">Tingkat</th>
                        <th scope="col">Berkas</th>
                        <th scope="col"></th>
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
                                <td><?= $u['score'] ?></td>
                                <td><?= $u['file'] ?></td>
                                <td>
                                    <a class="btn btn-success" href="/rules/detail/<?= $u['id']; ?>">Detail</a>
                                    <!-- <a class="btn btn-danger" href="rules/deleteCategory/<?= $u['id']; ?>">Delete</a> -->
                                </td>
                            </tr>
                        <?php $x++;
                        endif;
                        ?>

                    <?php endforeach; ?>
                </tbody>
            </table>

            <iframe src="writable\uploads1669141597_e8cdc48d0742cbec1b07.pdf\AyoPulih - remissie. - APPETIZER HACKATHON.pdf'" width="100%" height="300" style="border:1px solid black;">
            </iframe>

        </div>

    </div>
</div>

<script>
    // fetch('https://api.cloudinary.com/v1_1/dbspwrvtg/image/upload')
    //     .then((response) => response.json())
    //     .then((data) => console.log(data));

        let data = {
            "file": document.getElementById("inputDataSupportingFile").value
        }

        fetch("https://api.cloudinary.com/v1_1/dbspwrvtg/image/upload", {
            method: "POST",
            // headers: headers,
            body: JSON.stringify(data)
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            console.log(data)
        });
    
        // document.getElementsByName("").value = 

</script>

<!--content end here-->
<?= $this->endSection(); ?>