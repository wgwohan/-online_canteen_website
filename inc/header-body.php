		<nav class="navbar navbar-expand-md navbar-light fixed-top bg-warning main-nav">
			<a class="navbar-brand" href="index.php"><i class="fas fa-home fa-2x"></i></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav mr-auto">					
					<li class="nav-item">
						<a class="nav-link font-weight-bold <?php if(isset($active) && ($active=="aboutus")){ echo "active"; }?>" href="aboutUs.php"><i class="fas fa-user-tie"></i> About Us</a>
					</li>
					<li class="nav-item">
						<a class="nav-link font-weight-bold <?php if(isset($active) && ($active=="cart")){ echo "active"; }?>" href="cart.php" tabindex="-1"><i class="fas fa-shopping-cart"></i> Shopping Cart</a>
					</li>
				</ul>
			</div>
		</nav>
		<div class="container">
			<div class="row header my-3">
				<div class="col-3 my-auto">
					<a href="index.php"><img class="w-100 my-auto" src="image/logo.png" alt=""></a>
				</div>
				<div class="col-7 my-auto text-center">
					<h1 style="font-size: 3em;">Hardy Online Canteen</h1>
				</div>
				<div class="col-2 my-auto logo">
					<a href="login.php"><button class="btn-logo" type="submit" name="profile" style="background-image: url(<?php echo($img_dir) ?>);"></button></a>
				</div>
			</div>
			<div class="row header-mob">
				<div class="col-12 text-center mt-0 mb-3">
					<a href="index.php"><img class="w-75 my-auto" src="image/logo.png" alt=""></a>
				</div>
			</div>
		</div>
		<nav class="navbar fixed-bottom navbar-expand navbar-light bg-warning mob-nav">			
			<div >
				<ul class="navbar-nav mr-auto">
					<li class="<?php if(isset($active) && ($active=="home")){ echo "active"; }?> w-25 mob-nav-li">
						<a class="nav-link mob-nav-link" href="index.php"><i class="fas fa-home fa-2x"></i> <span class="sr-only">(current)</span></a>
					</li>
					<li class="<?php if(isset($active) && ($active=="aboutus")){ echo "active"; }?> w-25 mob-nav-li">
						<a class="nav-link mob-nav-link" href="aboutUs.php"><i class="fas fa-info-circle fa-2x"></i></a>
					</li>					
					<li class="<?php if(isset($active) && ($active=="cart")){ echo "active"; }?> w-25 mob-nav-li">
						<a class="nav-link mob-nav-link" href="cart.php"><i class="fas fa-shopping-cart fa-2x"></i></a>
					</li>
					<li class="<?php if(isset($active) && ($active=="profile")){ echo "active"; }?> w-25 mob-nav-li">
						<a class="nav-link mob-nav-link" href="Cprofile.php"><i class="fas fa-user-alt fa-2x"></i></a>
					</li>										
				</ul>
			</div>
		</nav>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery.slim.min.js"><\/script>')</script>
			<!-- <script src="js/bootstrap.bundle.min.js"></script> -->
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>