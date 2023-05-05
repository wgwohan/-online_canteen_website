<?php require_once('inc/connection.php');
$active = "profile"; 
if (!isset($_SESSION['user_id'])) {
	echo("<script> window.location = 'login.php'; </script>");
}
$id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Recharge</title>
		<?php include('inc/header-head.php') ?>
	</head>
	<body>
		<?php include('inc/header-body.php') ?>
		
		<div class="container border border-secondary rounded col-xl-6 col-lg-7 col-md-9 col-sm-11 col-xs">
			<div class="row">
			<div class="col-11 mx-auto my-5">
        <div class="alert alert-danger" role="alert">
          <b>Please keep a proof of your payment and send it to canteen. Otherwise your payment will be lost!</b>
        </div>
				<h5>You can recharge your account when you go to the Hardy Canteen. Otherwise you can recharge your account using your credit or debit card. there for click below button. makesure to keep the recipt untill update your racharge amount in your Hardy Canteen Account.</h5>
			</div>
		</div>
			<div id="smart-button-container">
      <div style="text-align: center;">
        <div style="margin-bottom: 1.25rem;">
          <p></p>
          <select class="form-control mt-3 w-75 mx-auto border border-secondary" id="item-options"><option value="Rs. 1000.00" price="5.12">Rs. 1000.00 - 5.12 USD</option><option value="Rs. 2000.00" price="10.24">Rs. 2000.00 - 10.24 USD</option><option value="Rs. 5000.00" price="25.64">Rs. 5000.00 - 25.64 USD</option></select>
          <select style="visibility: hidden" id="quantitySelect"></select>
        </div>
      <div id="paypal-button-container"></div>
      </div>
    </div>
    <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
    <script>
      function initPayPalButton() {
        var shipping = 0;
        var itemOptions = document.querySelector("#smart-button-container #item-options");
    var quantity = parseInt();
    var quantitySelect = document.querySelector("#smart-button-container #quantitySelect");
    if (!isNaN(quantity)) {
      quantitySelect.style.visibility = "visible";
    }
    var orderDescription = '';
    if(orderDescription === '') {
      orderDescription = 'Item';
    }
    paypal.Buttons({
      style: {
        shape: 'pill',
        color: 'gold',
        layout: 'vertical',
        label: 'paypal',
        
      },
      createOrder: function(data, actions) {
        var selectedItemDescription = itemOptions.options[itemOptions.selectedIndex].value;
        var selectedItemPrice = parseFloat(itemOptions.options[itemOptions.selectedIndex].getAttribute("price"));
        var tax = (0 === 0 || false) ? 0 : (selectedItemPrice * (parseFloat(0)/100));
        if(quantitySelect.options.length > 0) {
          quantity = parseInt(quantitySelect.options[quantitySelect.selectedIndex].value);
        } else {
          quantity = 1;
        }

        tax *= quantity;
        tax = Math.round(tax * 100) / 100;
        var priceTotal = quantity * selectedItemPrice + parseFloat(shipping) + tax;
        priceTotal = Math.round(priceTotal * 100) / 100;
        var itemTotalValue = Math.round((selectedItemPrice * quantity) * 100) / 100;

        return actions.order.create({
          purchase_units: [{
            description: orderDescription,
            amount: {
              currency_code: 'USD',
              value: priceTotal,
              breakdown: {
                item_total: {
                  currency_code: 'USD',
                  value: itemTotalValue,
                },
                shipping: {
                  currency_code: 'USD',
                  value: shipping,
                },
                tax_total: {
                  currency_code: 'USD',
                  value: tax,
                }
              }
            },
            items: [{
              name: selectedItemDescription,
              unit_amount: {
                currency_code: 'USD',
                value: selectedItemPrice,
              },
              quantity: quantity
            }]
          }]
        });
      },
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(orderData) {
          
          // Full available details
          console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

          // Show a success message within this page, e.g.
          const element = document.getElementById('paypal-button-container');
          element.innerHTML = '';
          element.innerHTML = '<h3>Thank you for your payment!</h3>';

          // Or go to another URL:  actions.redirect('thank_you.html');

        });
      },
      onError: function(err) {
        console.log(err);
      },
    }).render('#paypal-button-container');
  }
  initPayPalButton();
    </script>
		</div>
	</body>
</html>
<?php mysqli_close($connection); ?>