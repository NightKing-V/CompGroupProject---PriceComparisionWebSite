<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="viewport" content="width=device-width">
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

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

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">

	<script defer src="<?php echo base_url() ?>assets/JS/ActiveNav.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/CSS/Main.css">

</head>

<body>
	<div id="HeadCon">
		<div class="container d-flex justify-content-center ">
			<h2 class="Heading">PricePal</h2>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">PricePal</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
			aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav align-items-center mx-auto">
				<li id="main-nav" class="nav-item">
					<a class="nav-link" href="#">Home</a>
				</li>
				<li id="main-nav" class="nav-item">
					<a class="nav-link" href="#">Brands</a>
				</li>
				<li id="main-nav" class="nav-item">
					<a class="nav-link" href="#">Hot deals</a>
				</li>
				<li id="main-nav" class="nav-item">
					<a class="nav-link" href="#">Favourites</a>
				</li>
			</ul>
			<button type='button' id="signinbtn" class='btn btn-outline-info my-2 my-sm-0' data-toggle='modal'
				data-target='#exampleModalCenter3'>Sign in</button>
		</div>
	</nav>
	<div id="searchdiv" class="container d-flex justify-content-center ">
		<form id="searchbar" class="form-inline align-items-center my-lg-0 justify-content-center">
			<div class="container justify-content-center ">
				<input id="searchbar" class="form-control mr-sm-2 " type="search" placeholder="Search..."
					aria-label="Search">
			</div>
			<div class="container d-flex justify-content-center mainbtn">
				<div class="row container">
					<div class="container d-flex justify-content-center col">
						<button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
					</div>
					<div  class="container d-flex justify-content-center col">
						<div class="dropdown">
							<button class="btn btn-outline-info dropdown-toggle my-2 my-sm-0" type="button" id="dropdownMenu2"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Category
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
							<button class="dropdown-item" type="button">All</button>
								<button class="dropdown-item" type="button">Mobile Phones & Devices</button>
								<button class="dropdown-item" type="button">Telivisions</button>
								<button class="dropdown-item" type="button">Refrigerators</button>
								<button class="dropdown-item" type="button">Washing Machines</button>
								<button class="dropdown-item" type="button">Kitchen Appliances</button>
								<button class="dropdown-item" type="button">Laptops</button>
								<button class="dropdown-item" type="button">Air Conditioners</button>
								<button class="dropdown-item" type="button">Fitness Equiment</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>