<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'> 

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
                <a class="navbar-brand" href="<?php echo base_url() ?>">RecepieZ</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                    <div class="d-flex">
                    <?php
                    if($this->session->userdata('is_admin')){
                    ?>
                    <div class="d-flex justify-content-center">
                        <a href="<?php echo base_url('register/logout') ?>" class="mx-1">
                            <button type="button" class="btn btn-danger btn-xs"><i class="fas fa-sign-out-alt "></i> logout</button>
                        </a>
                    </div>
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
        <div class="d-flex flex-column justify-content-center">
            <h3 class="mb-3">Hai! <span class="fw-bold"> <?php echo $this->session->userdata('username') ?></span></h3>
        </div>
    </div>

    <div class="container mb-5 py-5">
        <?php echo validation_errors(); ?>
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Pengaturan Akun
                </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <form action="<?php echo base_url('admin/update') ?>" method="post">
                        <h4>pengaturan akun</h4>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Username</label>
                            <input type="text" name="username" value="<?php echo $this->session->userdata('username') ?>" class="form-control form-control-lg">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="password">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-info btn-lg">update</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Pengaturan slider 1
                </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="p-1">
                        <img src="<?php echo (isset($slider[0]->img)) ? base_url('assets/slider/').$slider[0]->img : "#" ?>" class="img-fluid" alt="">
                        <form action="<?php echo base_url('admin/store_slider/1') ?>" method="post" enctype="multipart/form-data">
                            <h4>Edit slider 1</h4>
                            <div class="mb-3">
                                <input type="file" name="photo" class="form-control form-control-lg mb-3">
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">Tambahkan text</label>
                                <input type="text" name="text" value="<?php echo (isset($slider[0]->text)) ? $slider[0]->text : "" ?>" class="form-control form-control-lg" placeholder="Text ..." required>
                            </div>
                            <div class="mb-3">
                                <label for="link" class="form-label">Tambahkan keyword makanan</label>
                                <input type="text" name="link" value="<?php echo (isset($slider[0]->link)) ? $slider[0]->link : "" ?>" class="form-control form-control-lg" placeholder="Link ..." required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-info btn-lg">update</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Pengaturan slider 2
                </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="p-1">
                        <img src="<?php echo (isset($slider[1]->img)) ? base_url('assets/slider/').$slider[1]->img : "#" ?>" class="img-fluid" alt="">
                        <form action="<?php echo base_url('admin/store_slider/2') ?>" method="post" enctype="multipart/form-data">
                            <h4>Edit slider 2</h4>
                            <div class="mb-3">
                                <input type="file" name="photo" class="form-control form-control-lg mb-3">
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">Tambahkan text</label>
                                <input type="text" name="text" value="<?php echo (isset($slider[1]->text)) ? $slider[1]->text : "" ?>" class="form-control form-control-lg" placeholder="Text ..." required>
                            </div>
                            <div class="mb-3">
                                <label for="link" class="form-label">Tambahkan keyword makanan</label>
                                <input type="text" name="link" value="<?php echo (isset($slider[1]->link)) ? $slider[1]->link : "" ?>" class="form-control form-control-lg" placeholder="Link ..." required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-info btn-lg">update</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                    Pengaturan slider 3
                </button>
                </h2>
                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="p-1">
                        <img src="<?php echo (isset($slider[2]->img)) ? base_url('assets/slider/').$slider[2]->img : "#" ?>" class="img-fluid" alt="">
                        <form action="<?php echo base_url('admin/store_slider/3') ?>" method="post" enctype="multipart/form-data">
                            <h4>Edit slider 3</h4>
                            <div class="mb-3">
                                <input type="file" name="photo" class="form-control form-control-lg mb-3">
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">Tambahkan text</label>
                                <input type="text" name="text" value="<?php echo (isset($slider[2]->text)) ? $slider[2]->text : "" ?>" class="form-control form-control-lg" placeholder="Text ..." required>
                            </div>
                            <div class="mb-3">
                                <label for="link" class="form-label">Tambahkan keyword makanan</label>
                                <input type="text" name="link" value="<?php echo (isset($slider[2]->link)) ? $slider[2]->link : "" ?>" class="form-control form-control-lg" placeholder="Link ..." required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-info btn-lg">update</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>

    <script>

    </script>
</body>
</html>