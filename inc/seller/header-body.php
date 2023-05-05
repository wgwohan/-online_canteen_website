		<nav class="navbar navbar-expand-md navbar-light fixed-top bg-warning main-nav">
			<a class="navbar-brand" href="home.php"><i class="fas fa-home fa-2x"></i></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav mr-auto">					
					<li class="nav-item <?php if(isset($active) && ($active=="customers")){ echo "active"; }?>">
						<a class="btn border-dark nav-link font-weight-bold" href="customers.php"><strong><i class="fas fa-users"></i> Customers</strong></a>
					</li>
					<li class="nav-item <?php if(isset($active) && ($active=="orders")){ echo "active"; }?>">
						<a class="btn border-dark nav-link font-weight-bold ml-2" href="orders.php"><strong><i class="fas fa-concierge-bell"></i> All orders</strong></a>
					</li>
					<li class="nav-item <?php if(isset($active) && ($active=="products")){ echo "active"; }?>">
						<a class="btn border-dark nav-link font-weight-bold ml-2" href="products.php"><strong><i class="fas fa-toggle-on"></i> Food switch</strong></a>
					</li>					
					<li class="nav-item <?php if(isset($active) && ($active=="recharge")){ echo "active"; }?>">
						<a class="btn border-dark nav-link font-weight-bold ml-2" href="customer_recharge.php"><strong><i class="fas fa-hand-holding-usd"></i> Recharge</strong></a>
					</li>
					<li class="nav-item <?php if(isset($active) && ($active=="foodadd")){ echo "active"; }?>">
						<a class="btn border-dark nav-link font-weight-bold ml-2" href="foodAdd.php"><strong><i class="fas fa-cart-plus"></i> Add new food</strong></a>
					</li>
					<li class="nav-item">
						<a class="btn border-dark nav-link font-weight-bold ml-2" href="../index.php"><strong><i class="fas fa-house-user"></i> Main page</strong></a>
					</li>
					<li class="nav-item">
						<form action="" method="post">
							<button class="btn border-dark nav-link font-weight-bold ml-2" type="submit" id="logout" name="logout" value="logout"><strong><i class="fas fa-sign-out-alt"></i> Log out</strong></button>
						</form>
					</li>
				</ul>
			</div>
		</nav>
		<div class="container">
			<div class="row header my-3">
				<div class="col-3 my-auto">
					<a href="index.php"><img class="w-100 my-auto" src="../image/logo.png" alt=""></a>
				</div>
				<div class="col-9 my-auto text-center">
					<h1 style="font-size: 3em;">Hardy Online Canteen</h1>
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
						<a class="nav-link mob-nav-link" href="home.php"><i class="fas fa-home fa-2x"></i> <span class="sr-only">(current)</span></a>
					</li>
					<li class="<?php if(isset($active) && ($active=="products")){ echo "active"; }?> w-25 mob-nav-li">
						<a class="nav-link mob-nav-link" href="products.php"><i class="fas fa-info-circle fa-2x"></i></a>
					</li>					
					<li class="<?php if(isset($active) && ($active=="orders")){ echo "active"; }?> w-25 mob-nav-li">
						<a class="nav-link mob-nav-link" href="orders.php"><i class="fas fa-shopping-cart fa-2x"></i></a>
					</li>
					<li class="<?php if(isset($active) && ($active=="customers")){ echo "active"; }?> w-25 mob-nav-li">
						<a class="nav-link mob-nav-link" href="customers.php"><i class="fas fa-user-alt fa-2x"></i></a>
					</li>										
				</ul>
			</div>
		</nav>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery.slim.min.js"><\/script>')</script>
			<!-- <script src="js/bootstrap.bundle.min.js"></script> -->
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>