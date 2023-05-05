<?php require_once('inc/connection.php'); 
$active = "aboutus"; ?>
<!DOCTYPE html>
<html>
	<head>
		<title>About us</title>
		<?php include('inc/header-head.php') ?>
	</head>
	<body>
		<?php include('inc/header-body.php') ?>
		<div style="margin-bottom: 100px;" class="container border border-secondary rounded col-xl-6 col-lg-7 col-md-9 col-sm-11 col-xs">
			<div class="row">
				<div class="col-12 text-center my-3">
					<h2>Welcome to Hardy Canteen</h2>
					<hr>
				</div>
				<div class="col-12 mt-3">
					<h5>Here are the Contact details:</h5>
					<br>
				</div>
				<div class="col-12">
					<div class="row">
						<div class="col-3">Canteen</div><div class="col-8">: Hardy Canteen</div>
					</div>
					<div class="row">
						<div class="col-3">Name</div><div class="col-8">: Mrs. Nayana Samanmali</div>
					</div>
					<div class="row">
						<div class="col-3">TP No</div><div class="col-8">: 071 592 1688</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-3">Canteen</div><div class="col-8">: Girls Hostel Canteen</div>
					</div>
					<div class="row">
						<div class="col-3">Name</div><div class="col-8">: Mr. Amila Prashade</div>
					</div>
					<div class="row">
						<div class="col-3">TP No</div><div class="col-8">: 078 185 1311</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 text-center my-3">
					<hr>
					<h4>About us </h4>
				</div>
			</div>
			<div class="row">
				<div class="col-12 text-center">
					<h6 class="sen">"Hardy Canteen" website created by the 4th group of 2019th HNDIT batch. here are the group members, </h6>
				</div>
			</div>
			
			<div class="row mt-3">
				<div class="col-12">
					<div class="table table-responsive-lg">
						<table class="table table-striped table-hover">
							<thead class="thead-dark">
								<th>No</th>
								<th>Index no</th>
								<th>Name</th>
							</thead>
							<tbody>
								<tr>
									<td>01.</td>
									<td>AMP/IT/2019/F/0015</td>
									<td>W.D.T.P. Weeththasinhe</td>
								</tr>
								<tr>
									<td>02.</td>
									<td>AMP/IT/2019/F/0016</td>
									<td>W.G.W. Chamara</td>
								</tr>
								<tr>
									<td>03.</td>
									<td>AMP/IT/2019/F/0038</td>
									<td>K.L.G. Dhananjaya</td>
								</tr>
								<tr>
									<td>04.</td>
									<td>AMP/IT/2019/F/0039</td>
									<td>A.H.U.L. Weerasinghe</td>
								</tr>
								<tr>
									<td>05.</td>
									<td>AMP/IT/2019/F/0049</td>
									<td>S.W.V.U.G.K. Ariyawansha</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php mysqli_close($connection); ?>