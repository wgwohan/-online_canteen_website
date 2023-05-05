<?php
									
									// prepare database query for get the customer name
									$query = "SELECT first_name, last_name, acc_bal FROM customers WHERE id = {$row['customer_id']} LIMIT 1";
									$result_set = mysqli_query($connection, $query);
									if (mysqli_num_rows($result_set) == 1) {
									// valid customer found
									$order = mysqli_fetch_assoc($result_set);
									$first_name = $order['first_name'];
									$last_name = $order['last_name'];
									if ($order['acc_bal'] <= 0) {
										$cus_acc = "negative";
									} else {
										$cus_acc = "positive";
									}
									}
									// prepare database query for get the product name
									$query = "SELECT name FROM products WHERE id = {$row['product_id']} LIMIT 1";
									$result_set = mysqli_query($connection, $query);
																if (mysqli_num_rows($result_set) == 1) {
											// valid seller found
											$product = mysqli_fetch_assoc($result_set);
											$product_name = $product['name'];
										}
											
									if ($row['payment_method'] == 'acc') {
									$acc = 'Account Balance';
									} elseif ($row['payment_method'] == 'coh') {
									$acc = 'Cash On Hand';
									}
									
									
							?>
							<tbody>
								<tr>
									<td><?php echo $row['id'];?></td>
									<td><?php echo $row['date_time'];?></td>
									<td><form action="order_details.php" method="get">
										<button class="btn btn-light rounded-pill" type="submit" name="order"><strong>
										<?php echo $first_name.' '.$last_name;?></strong>
										</button>
										<input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
										<input type="hidden" name="customer_id" value="<?php echo $row['customer_id']; ?>">
										</form>
									</td>
									<td><?php echo $product_name;?></td>
									<td><?php echo $row['quantity'];?></td>
									<td><?php echo $row['price'];?></td>
									<td><?php echo $row['order_time'];?></td>
									<td><?php echo $acc;?><br>
										<?php if ($cus_acc == "positive") {
											echo '<div class="text-success text-center">
													<strong>Positive!</strong>					
													</div>';
										} elseif ($cus_acc == "negative") {
											echo '<div class="text-danger text-center">
													<strong>Negative!</strong>					
													</div>';
										}

										?>
									</td>
									<td><form action="" method="post">
										<button class="btn-success btn-lg w-100 m-1 rounded" name="completed" value="completed">Delivered</button>
										<input type="hidden" name="order_id" value="<?php echo $row['id'];?>">
										<br>
										<input type="hidden" name="customer_id" value="<?php echo $row['customer_id'];?>">
										<input type="hidden" name="price" value="<?php echo $row['price'];?>">
										<input type="hidden" name="payment_method" value="<?php echo $row['payment_method'];?>">
										<button class="btn-danger btn-lg w-100 m-1 rounded" name="rejected" value="rejected">Rejected</button></form>
									</td>
								</tr>