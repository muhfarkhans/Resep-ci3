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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
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
                <a class="navbar-brand" href="<?php echo base_url() ?>">
                <img src="<?php echo base_url('assets/logo.png') ?>" width="30" height="30" class="" alt="">
                    RecepieZ
                </a>
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

    <div class="container my-5 py-5">
        

        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <?php
                foreach ($slider as $key => $value) {
                ?>
                <div class="carousel-item <?php echo ($key == 0) ? "active" : "" ?>">
                    <img style="height: 400px; object-fit: cover" src="<?php echo base_url('assets/slider/').$value['img'] ?>" class="d-block w-100 rounded" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="fw-bold"><?php echo $value['text'] ?></h5>
                        <a href="<?php echo base_url('recipe/api_search/').$value['link'] ?>">
                            <button class="btn btn-info btn-sm text-white">
                                cari
                            </button>
                        </a>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>

        <div class="row rounded p-2 mt-5" style="background-color: rgba(191, 219, 254)">
            <div class="col">
                <form id="formsearch" action="<?php echo base_url('recipe/search'); ?>" method="post">
                    <input id="_search" name="search" class="form-control form-control-lg" type="text" placeholder="Cari resep" aria-label=".form-control-lg example">
                </form>
            </div>
            <div class="col d-flex align-items-center justify-content-around">
                <button type="submit" form="formsearch" class="btn btn-primary mx-1">
                    <i class="fas fa-search"></i>
                    Cari
                </button>
                <a href="<?php echo base_url('recipe/create') ?>">
                    <button type="button" class="btn btn-light mx-1">
                        <i class="fas fa-plus"></i>
                        Buat resep
                    </button>
                </a>
            </div>
        </div>
    </div>

    <div class="container my-5 py-5">
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