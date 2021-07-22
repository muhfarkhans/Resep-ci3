<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet"> 

    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/dataTables.bootstrap5.min.css') ?>">

    <script src="<?php echo base_url('assets/bootstrap/jquery-3.5.1.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/dataTables.bootstrap5.min.js') ?>"></script>

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
        <div class="d-flex flex-column justify-content-center">
            <h3 class="mb-3">Hai! <span class="fw-bold"> <?php echo $this->session->userdata('display_name') ?></span></h3>
            <img style="width: 120px; height: 120px; object-fit: cover; background-color: rgba(156, 163, 175)" src="<?php echo ($this->session->userdata('photo') == "" || $this->session->userdata('photo') == "default.png") ? "#" : base_url('assets/user/').$this->session->userdata('photo') ?>" class="border border-4 rounded-circle">
            <div class="mt-3">
                <p>Total resep : <?php echo count($recipe) ?></p>
                <a href="<?php echo base_url('user/review') ?>">
                    <button class="btn btn-primary btn-sm">lihat aktivitas review</button>
                </a>
            </div>
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
                    <form action="<?php echo base_url('user/update') ?>" method="post" enctype="multipart/form-data">
                        <h4>pengaturan akun</h4>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="name" value="<?php echo $this->session->userdata('display_name') ?>" class="form-control form-control-lg" placeholder="Judul resep">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Nama</label>
                            <input type="email" name="email" value="<?php echo $this->session->userdata('email') ?>" class="form-control form-control-lg" placeholder="Judul resep">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="password">
                        </div>
                        <div class="mb-3">
                            <input type="file" name="photo" class="form-control form-control-lg mb-3">
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
                    Resep anda
                </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="p-1">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach ($recipe as $key => $value) {
                                ?>
                                <tr>
                                    <td><?php echo $value['title'] ?></td>
                                    <td><?php echo $value['is_published'] ? "di publikasikan" : "di draf" ?></td>
                                    <td><?php echo $value['created_at'] ?></td>
                                    <td>
                                        <a href="<?php echo base_url('recipe/edit/'.$value['id']) ?>">
                                            <button class="btn btn-info btn-sm">Detail</button>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
</body>
</html>