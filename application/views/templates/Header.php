<?php
defined('BASEPATH') or exit ('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="viewport" content="width=device-width">
	<meta charset="utf-8">
	<title><?php echo $title;?></title>

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
		integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
		integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
		integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
		crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
		integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/favicon.ico') ?>">

	<script defer src="<?php echo base_url()?>assets/JS/ActiveNav.js"></script>
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/CSS/Main.css"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/CSS/Home.css">

</head>

<body>

	<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top mb-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url('index.php/Home'); ?>">
                PricePal
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse d-md-flex justify-content-between" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="<?php echo base_url("index.php/NewArrivals") ?>"><i class="fas fa-plus-circle pe-2"></i> New Arrivals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="<?php echo base_url("index.php/Hotdeals") ?>"><i class="fa-solid fa-fire"></i> Hot Deals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="<?php echo base_url("index.php/Favourites") ?>"><i class="fas fa-heart pe-2"></i> Favourites</a>
                    </li>
                    <li class="nav-item">
						<a class="nav-link mx-2" href="<?php echo base_url("index.php/Brands") ?>"><i class="fa-solid fa-tag"></i> Brands</a>
                    </li>
                </ul>
                <div class="w-25 d-inline d-md-flex align-items-center justify-content-center">
				<form class="form-inline my-2 my-lg-0" method="post" action="<?php echo base_url("index.php/Main/search") ?>">
                    <div class="input-group mx-5 mx-md-0 px-5 px-md-0">
                        <input type="search" class="form-control" placeholder="Search products..." aria-label="Search" name="searchtext" id="searchbarinner">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                </div>
				<div class="text-center">
				<button type='button' id="signinbtn" class='btn btn-primary text-white my-2 my-sm-0 <?= isset($_SESSION['email']) ? "d-none" : "d-block" ?>' data-toggle='modal' data-target='#exampleModalCenter3'>
						<a href="<?= base_url('index.php/login') ?>" style="color:inherit; text-decoration:none;">Sign in</a>
					</button>
					<!-- added -->
					<?php if(isset($_SESSION['email'])): ?>
					<div class="btn-group">
						<button type="button" class="btn dropdown-toggle text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<?php if(!empty($_SESSION['profile_picture'])): ?>
								<img src="<?php echo htmlspecialchars($_SESSION['profile_picture']); ?>" alt="Profile Image" width="40" height="40" class="profileimg" style="border-radius: 50%;">
							<?php endif; ?>
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="<?= base_url('index.php/Main/logout') ?>">Logout</a>
						</div>
						</div>
					<?php endif; ?>
				</div>
            </div>
        </div>
    </nav>
<!-- Navbar -->

<br><br><br><br><br><br>