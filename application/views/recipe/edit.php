<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet"> 
    <!--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ef26de41ef.js" crossorigin="anonymous"></script>
    -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/bootstrap.min.css') ?>">
    <script src="<?php echo base_url('assets/bootstrap/jquery-3.5.1.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://kit.fontawesome.com/ef26de41ef.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light py-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo base_url() ?>">Reciepz</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    </ul>
                    <div class="d-flex">
                    <?php
                    if($this->session->userdata('status') == "login"){
                    ?>
                    <?php
                    if ($this->session->userdata('is_admin')) {
                    ?>
                    <div class="d-flex justify-content-center">
                        <a href="<?php echo base_url('admin') ?>" class="mx-1">
                            <button type="button" class="btn btn-primary btn-xs"><i class="fas fa-user-circle"></i> profil</button>
                        </a>

                        <a href="<?php echo base_url('register/logout') ?>" class="mx-1">
                            <button type="button" class="btn btn-danger btn-xs"><i class="fas fa-sign-out-alt "></i> logout</button>
                        </a>
                    </div>
                    <?php
                    } else {
                    ?>
                    <div class="d-flex justify-content-center">
                        <a href="<?php echo base_url('user') ?>" class="mx-1">
                            <button type="button" class="btn btn-primary btn-xs"><i class="fas fa-user-circle"></i> profil</button>
                        </a>

                        <a href="<?php echo base_url('register/logout') ?>" class="mx-1">
                            <button type="button" class="btn btn-danger btn-xs"><i class="fas fa-sign-out-alt "></i> logout</button>
                        </a>
                    </div>
                    <?php
                    }
                    ?>
                    <?php
                    } else {
                    ?>
                    <a href="<?php echo base_url('login') ?>">
                        <button type="button" class="btn btn-primary">Login</button>
                    </a>
                    <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid py-3" style="margin-top: 71px">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-danger btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#confirmationDelete">Hapus</button>
            <a href="<?php echo base_url('recipe/unpublish/'.$recipe['detail']['id']) ?>" class="mx-1">
                <button type="button" class="btn btn-primary btn-sm">Simpan ke draf</button>
            </a>
            <a href="<?php echo base_url('recipe/publish/'.$recipe['detail']['id']) ?>" class="mx-1">
                <button type="button" class="btn btn-primary btn-sm">Publish</button>
            </a>
        </div>
    </div>

    <div class="container mb-5 py-5">
        <form action="<?php echo base_url('recipe/store_detail/'.$recipe['detail']['id']) ?>" method="post" enctype="multipart/form-data" class="mb-5 p-2">
            <h3 class="mb-3 fw-bold">Detail</h3>
            <div class="row mb-1">
                <div class="col">
                    <img src="<?php echo (empty($recipe['detail']['img'])) ? "#" : base_url('assets/recipe/').$recipe['detail']['img'] ?>" class="img-fluid rounded mx-auto d-block" alt="">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col w-75">
                    <input type="file" name="imgdetail" class="form-control form-control-lg mb-3">
                </div>
                <div class="col w-25 d-flex justify-content-center">
                    <?php 
                    if (isset($recipe['detail']['img'])) {
                    ?>
                    <a href="<?php echo base_url('recipe/delete_image_recipe/'.$recipe['detail']['id']) ?>">
                        <button type="button" class="btn btn-danger btn-lg">hapus gambar</button>
                    </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" value="<?php echo $recipe['detail']['title'] ?>" class="form-control form-control-lg" placeholder="Judul resep">
            </div>
            <div class="mb-3">
                <label for="cerita" class="form-label">Cerita</label>
                <textarea name="cerita" id="" cols="30" rows="5" class="form-control"><?php echo $recipe['detail']['story'] ?></textarea>
            </div>
            <div class="mb-3 row">
                <div class="col">
                    <label for="porsi">Porsi</label>
                    <input type="number" name="porsi" value="<?php echo $recipe['detail']['serves']; ?>" class="form-control form-control-lg" placeholder="porsi per penyajian">
                </div>
                <div class="col">
                    <label for="waktu">Waktu <span class="fw-light">(menit)</span></label>
                    <input type="number" name="waktu" value="<?php echo $recipe['detail']['cook_time']; ?>" class="form-control form-control-lg" placeholder="waktu pembuatan">
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary btn-lg">Simpan detail</button>
            </div>
        </form>

        <form action="<?php echo base_url('recipe/store_ingredient/'.$recipe['detail']['id']) ?>" method="post" class="mb-5 bg-light p-2 rounded">
            <h3 class="mb-3 fw-bold">Bumbu</h3>
            <div class="mb-3">

                <?php
                foreach($recipe['ingredients'] as $key => $value){
                ?>
                <div class="row bg-white m-2 rounded mb-2">
                    <div class="col-2 d-flex justify-content-center align-items-center">
                        <h2><span class="badge rounded-pill" style="background-color: rgba(129, 140, 248)"><?php echo $key+1 ?></span></h2>
                    </div>
                    <div class="col-8 p-2">
                        <?php echo $value['name'] ?>
                    </div>
                    <div class="col-2 d-flex justify-content-center align-items-center">
                        <a href="<?php echo base_url('recipe/delete_ingredient/'.$recipe['detail']['id'].'/'.$value['id']) ?>">
                            <button type="button" class="btn btn-danger">hapus</button>
                        </a>
                    </div>
                </div>
                <?php
                }
                ?>

            </div>
            <div class="mb-3 p-2 rounded text-white" style="background-color: rgba(124, 58, 237);">
                <input type="number" name="recipe_id" value="<?php echo $recipe['detail']['id'] ?>" hidden>
                <label for="bumbu" class="form-label">Tambah bumbu</label>
                <input type="text" name="bumbu" class="form-control form-control-lg mb-3" placeholder="nama bahan..." required>
                <button type="submit" class="btn btn-light">tambah</button>
            </div>
        </form>

        <form action="<?php echo base_url('recipe/store_step/'.$recipe['detail']['id']) ?>" method="post" enctype="multipart/form-data" class="mb-5 bg-light p-2 rounded">
            <h3 class="mb-3 fw-bold">Langkah langkah</h3>
            <div class="mb-3">
                
                <?php 
                foreach($recipe['steps'] as $key => $value){
                ?>
                <div class="row bg-white m-2 rounded mb-2">
                    <div class="col-2 d-flex justify-content-center align-items-center">
                        <h2><span class="badge rounded-pill" style="background-color: rgba(52, 211, 153)"><?php echo $key+1 ?></span></h2>
                    </div>
                    <div class="col-8 p-2">
                        <p><?php echo $value['content'] ?></p>

                        <img src="<?php echo (empty($value['img'])) ? "#" : base_url('assets/recipe/').$value['img'] ?>" class="img-fluid rounded" alt="">
                    </div>
                    <div class="col-2 d-flex justify-content-center align-items-center">
                        <a href="<?php echo base_url('recipe/delete_step/'.$recipe['detail']['id'].'/'.$value['id']) ?>">
                            <button type="button" class="btn btn-danger">hapus</button>
                        </a>
                    </div>
                </div>
                <?php
                }
                ?>

            </div>
            <div class="mb-3 p-2 rounded text-white" style="background-color: rgba(5, 150, 105);">
                <input type="number" name="recipe_id" value="<?php echo $recipe['detail']['id'] ?>" hidden>
                <label for="bumbu" class="form-label">Tambah langkah</label>
                <input type="text" name="langkah" class="form-control form-control-lg mb-3" placeholder="langkah langkah...">
                <input type="file" name="imglangkah" class="form-control form-control-lg mb-3">
                <button type="submit" class="btn btn-light">tambah</button>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmationDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi tindakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus resep
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="<?php echo base_url('recipe/delete/'.$recipe['detail']['id']) ?>">
                    <button type="button" class="btn btn-danger">Hapus</button>
                </a>
            </div>
            </div>
        </div>
    </div>

    <script>
        
    </script>
</body>
</html>