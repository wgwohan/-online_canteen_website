<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mt-3">
	<form method="post" action="index.php?action=add&id=<?php echo $row["id"];?>">
		<div class="card">
			<div class="bg-white p-2">
				<img data-src="<?php echo $row["img_dir"];?>" class="card-img-top rounded" alt="food image">
			</div>
			<div class="card-body">
				<h5 class="card-title text-center food-name"><?php echo $row["name"];?></h5>
				<h6 class="text-warning"><?php echo $row["description"];?></h6>
				<h5 class="text-danger"><?php echo 'Rs. '. $row["price"].'.00';?></h5>
				<select class="custom-select mb-2" name="order_time">
				  <option value="breakfast" selected="">Breakfast</option>
				  <option value="lunch">Lunch</option>
				  <option value="dinner">Dinner</option>
				</select>
				<input type="number" name="quantity" class="form-control" min="1" value="1">
				<input type="hidden" name="hidden_name" value="<?php echo $row["name"];?>">
				<input type="hidden" name="hidden_price" value="<?php echo $row["price"];?>">
			</div>
			<div class="card-footer">
				<button type="submit" name="add" style="margin-top: 5px;" class="btn btn-success btn-lg" value="Add to cart">Add to cart <i class="fas fa-shopping-cart"></i></button>
			</div>
		</div>
	</form>
</div>