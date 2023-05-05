<?php require_once('inc/connection.php'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Customer</title>

		<link rel="stylesheet" type="text/css" href="css\main.css">
		<link rel="stylesheet" type="text/css" href="css\main1.css">

	</head>

	<body>

		<div class="form"> 

		<form>

		<h2 class="headertext"></h2><!--headertext-->
		
		<div class="search">
			<input class="searchText" type="text"name="search" placeholder="Find customer name OR coustomer ID"><!--searchText-->

			<button type="submit" id="button" name="submit" value="search"> <img class="iconI" src="image/search.jpg" alt="search"> </button><!--iconI-->
		</div>

	
			<p>
			<label class="num">Number of customers : 150</label><!--num-->

			<select class="cate" name="list" size="1"> 
					<option>Student</option>
					<option>Academic staff</option>
					<option>Non academic staff</option>
				</select><!--cate-->
			</p>
	</form> 
		

		<table> 
			<tr>
				<td>CustomerID</td><td> - </td><td>Room ID</td><td> - </td><td>Customer Name</td> 
			</tr>

		</table>

	</div>

	</body>

</html>
<?php mysqli_close($connection); ?>