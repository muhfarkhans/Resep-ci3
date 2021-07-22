<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet"> 

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
                <a class="navbar-brand" href="<?php echo base_url() ?>">RecepieZ</a>
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

    <div class="container mt-5 py-5">
        <h3 class="my-5">Cari "<?php echo $key ?>"</h3>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php 
            foreach ($recipe as $key => $value) {
            ?>
            <div class="col">
                <div class="card shadow">
                    <img src="<?php echo base_url('assets/recipe/'.$value->img) ?>" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $value->title ?></h5>
                        <p class="card-text"><?php echo $value->story ?></p>
                        <a href="<?php echo base_url('recipe/detail/'.$value->id) ?>">
                            <button type="button" class="btn btn-info rounded btn-xs">Lihat</button>
                        </a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted d-block">porsi <span class="fw-bold"><?php echo $value->serves ?><span></small>
                        <small class="text-muted d-block">waktu <span class="fw-bold"><?php echo $value->cook_time ?> menit<span></small>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="my-3">
        <?php 
	        echo $this->pagination->create_links();
	    ?>
        </div>
    </div>

    <script>

    </script>
</body>
</html>