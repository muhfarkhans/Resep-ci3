<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/responsive.css') ?>">
    <script src="https://kit.fontawesome.com/ef26de41ef.js" crossorigin="anonymous"></script>
</head>
<body class="bg-blue-400 text-gray-900 h-screen w-screen antialiased">
    <div class="h-full w-full flex flex-col justify-center items-center px-2">
        <div class="w-full md:w-1/2 lg:w-1/4 p-2 my-2 text-center">
            <h3 class="text-white text-2xl font-medium">ResepZ</h3>
        </div>

        <div class="w-full md:w-1/2 lg:w-1/4 rounded-md p-4 shadow-lg bg-white my-2">
            <h4 class="my-4 text-xl font-medium">Login</h4>

            <?php 
            echo "<div class=\"text-red-500\">";
            echo validation_errors(); 
            echo "</div>";
            ?>

            <?php if ($this->session->flashdata('login_error')) { ?>
            <?php 
            echo "<div class=\"text-red-500\">";
            echo $this->session->flashdata('login_error');
            echo "</div>";
            ?>
            <?php } ?>

            <form class="" action="<?php echo base_url('login/store') ?>" method="post">
                <div class="mt-4 mb-3 pt-0">
                    <label for="">email</label>
                    <input name="email" type="email" placeholder="Email" class="mt-1 px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full" required/>
                </div>

                <div class="mb-3 pt-0">
                    <label for="">password</label>
                    <input name="password" type="password" placeholder="Password" class="mt-1 px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full" required/>
                </div>

                <div class="text-center mt-8">
                    <button class="bg-red-500 text-white active:bg-red-700 font-medium capitalize px-6 py-3 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" type="submit" style="transition: all .15s ease">
                        Login
                    </button>
                </div>
            </form>
        </div>

        <div class="w-full md:w-1/2 lg:w-1/4 p-2 my-2 text-center">
            <a href="<?php echo base_url('register') ?>">
                <button class="bg-white text-red-500 active:bg-red-200 font-medium capitalize px-6 py-3 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease">
                    register
                </button>
            </a>
        </div>
    </div>
</body>
</html>