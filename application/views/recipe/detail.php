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

    <div class="container mb-5 py-5" style="margin-top: 51px">
        <div class="mb-5 p-2">
            <h3 class="mb-3 fw-bold">Detail</h3>
            <div class="row mb-1">
                <div class="col">
                    <img src="<?php echo (empty($recipe['detail']['img'])) ? "#" : base_url('assets/recipe/').$recipe['detail']['img'] ?>" class="img-fluid rounded mx-auto d-block" alt="">
                </div>
            </div>

            <div class="mb-3">
                <h2 class="fw-bold"><?php echo $recipe['detail']['title'] ?></h2>
            </div>
            <div class="mb-3">
                <p><?php echo $recipe['detail']['story'] ?></p>
            </div>
            <div class="mb-3 row">
                <div class="col">
                    <h4>Porsi : <span class="fw-bold"><?php echo $recipe['detail']['serves']; ?></span></h4>
                </div>
                <div class="col">
                    <h4>Waktu : <span class="fw-bold"><?php echo $recipe['detail']['cook_time']; ?></span></h4>
                </div>
            </div>
        </div>

        <div class="mb-5 p-2">
            <h3 class="mb-3 fw-bold">Bumbu</h3>
            <div class="mb-3">
                <?php
                foreach($recipe['ingredients'] as $key => $value){
                ?>
                <div class="row bg-white m-2 rounded mb-2">
                    <div class="col-2 d-flex justify-content-center align-items-center">
                        <h2><span class="badge rounded-pill" style="background-color: rgba(129, 140, 248)"><?php echo $key+1 ?></span></h2>
                    </div>
                    <div class="col-10 p-2">
                        <?php echo $value['name'] ?>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="p-2">
            <h3 class="mb-3 fw-bold">Langkah langkah</h3>
            <div class="mb-3">
                <?php 
                foreach($recipe['steps'] as $key => $value){
                ?>
                <div class="row bg-white m-2 rounded mb-2">
                    <div class="col-2 d-flex justify-content-center align-items-center">
                        <h2><span class="badge rounded-pill" style="background-color: rgba(52, 211, 153)"><?php echo $key+1 ?></span></h2>
                    </div>
                    <div class="col-10 p-2">
                        <p><?php echo $value['content'] ?></p>
                        <img src="<?php echo (empty($value['img'])) ? "#" : base_url('assets/recipe/').$value['img'] ?>" class="img-fluid rounded" alt="">
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="container mb-5 py-1">
        <form action="<?php echo base_url('recipe/store_review/'.$recipe['detail']['id']) ?>" method="post" class="mb-5 p-2">
            <h3 class="mb-3 fw-bold">Review</h3>
            
            <?php
            foreach ($recipe['reviews'] as $key => $value) {
            ?>
            <div class="mb-3 p-2 rounded bg-light border border-info">
                <p><?php echo $value['created_at'] ?></p>
                <h5><?php echo $value['display_name'] ?></h5>
                <p><?php echo $value['comment'] ?></p>
                <p><i class="fas fa-star" style="color: rgba(253, 230, 138, 1)"></i> <?php echo $value['stars'] ?> bintang</p>
            </div>
            <?php
            }
            ?>

            <div class="mb-3 p-2">
                <input type="number" name="recipe_id" value="<?php echo $recipe['detail']['id'] ?>" hidden>
                <label for="comment" class="form-label">komentar</label>
                <textarea name="comment" id="" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <div class="mb-3 p-2">
                <input type="number" name="recipe_id" value="<?php echo $recipe['detail']['id'] ?>" hidden>
                <label for="stars" class="form-label">Rating</label>
                <select name="stars" class="form-select form-select-lg" aria-label=".form-select-lg example">
                    <option selected>Open this select menu</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="mb-3 p-2">
                <?php
                if($this->session->userdata('status') == "login"){
                ?>
                <button type="submit" class="btn btn-primary">Kirim</button>
                <?php
                } else {
                ?>
                <a href="<?php echo base_url('login') ?>">
                    <button type="button" class="btn btn-primary">Login terlebih dahulu</button>
                </a>
                <?php
                }
                ?>
            </div>
        </form>
    </div>

    <script>
        
    </script>
</body>
</html>