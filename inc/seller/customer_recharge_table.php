<tbody>
	<tr>
		<form action="" method="post">
		<td><?php echo $row['id'];?></td>
		<td><?php echo $row['first_name'].' '.$row['last_name'];?></td>
		<td class="text-center"><img class="w-25" src="../<?php echo $row['img_dir'];?>" alt="profile image"></td>
		<td><?php echo $row['email'];?></td>
		<td><?php echo $row['mobile_num'];?></td>
		<td><?php echo $row['acc_bal'];?></td>
		<td><input class="form-control" name="recharge" type="number" min="0" placeholder="Rs.">
			<input type="hidden" name="customer_id" value="<?php echo $row['id'];?>">
		</td>
		<td><button class="btn btn-success px-4" type="submit" name="save">Save</button></td>
		</form>
	</tr>