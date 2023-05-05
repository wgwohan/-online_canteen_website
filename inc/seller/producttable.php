<tbody>
	<tr>
		<td class="text-center"><?php echo $row['id'];?></td>
		
		<td class="text-center w-50">
			<img class="rounded w-25" src="../<?php echo $row['img_dir'];?>" alt="">
			<br>
			<?php echo $row['name'];?>
		</td>

		<td class="text-center"><?php echo $row['category'];?></td>

		<td class="text-center"><?php echo $row['price'];?></td>

		<td class="text-center">
			<?php if ($seller_id==1) {
				$statuts= $row['availability_1'];
			} elseif ($seller_id==2){
				$statuts= $row['availability_2'];
			} ?>
			<div style="background-color: <?php if ($statuts == 1) {echo "lime";} elseif($statuts == 0) {echo "red";} ?>;" class="mx-auto alert w-75 mb-1"></div>

			<form action="products.php" method="post">
				<select name="switch" id="switch" class="form-control w-75 mx-auto">
					<option value="1" class="text-success" <?php if ($statuts == 1) {echo "selected";} ?> >Available</option>
					<option value="0" class="text-danger" <?php if ($statuts == 0) {echo "selected";} ?>>Not vailable</option>					
				</select>
				<button type="submit" name="sw" class="btn btn-dark px-5 mt-2">Save</button>
				<input type="hidden" name="product_id" value="<?php echo $row['id'];?>">
			</form>
		</td>
	</tr>

