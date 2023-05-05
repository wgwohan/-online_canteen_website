<tbody>
	<tr>
		<td><?php echo $row['id'];?></td>
		<td><form action="customer_details.php" method="get">
			<button class="btn btn-light rounded-pill" type="submit" name="customer">
			<strong><?php echo $row['first_name'].' '.$row['last_name'];?></strong>
			</button>
			<input type="hidden" name="customer_id" value="<?php echo $row['id'];?>">
		</form>
	</td>
	<td><?php echo $row['gender'];?></td>
	<td><?php echo $row['role'];?></td>
	<td><?php echo $row['email'];?></td>
	<td><?php echo $row['mobile_num'];?></td>
	<td><?php echo $row['st_reg_num'];?></td>
	<td><?php echo $row['room_num'];?></td>
	<td><?php echo $row['acc_bal'];?></td>
</tr>