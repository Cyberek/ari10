<?php
include 'inc/base_class.php';

$WIDGET_ID = 				'651f5a65-83ed-40e9-863f-808de6a6a9ef';
$WIDGET_SECRET = 			'0942312162bf42d5b9423e22ae29b7fc';

$TRANSACTION_AMMOUNT = 		3123.65;
$TRANSACTION_CURRENCY = 	'PLN';

$ari = new AriClass(widget_id: $WIDGET_ID, widget_secret: $WIDGET_SECRET);
$ari->setAmount($TRANSACTION_AMMOUNT);
$ari->setCurrency($TRANSACTION_CURRENCY); ?>
<!DOCTYPE html>
<html lang="pl">
<?php include 'inc/header_docs.php' ?>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Comodities event timeout load no redirrect (old method) - Simple + CC + no logo + KYC (high ammount)</title>
	<script>
		widget_simple_view_9501036516336 = 'true';
		widget_no_logo_8075047110440 = 'true';
		widget_id_6851681344231 = "<?php echo $ari->getWidgetId() ?>"
		widget_language_1776290735652 = "pl"
	</script>
	<script src="https://gateway.ari10.com/widget/main-tst.min.js"></script>
	<script>
		function showWidget() {
			window.dispatchEvent(
				new CustomEvent('ari10-widget-start-commodities-payment-request', {
					detail: {
						transactionId: '<?php echo $ari->getTransactionId() ?>', //transaction ID
						mailAddress: '<?php echo $ari->getTestEmail() ?>', //optional
						phoneNumber: '<?php echo $ari->getTestPhoneNr() ?>' //optional (E.164 phone format)
					}
				})
			);

			const elem = document.getElementsByClassName('App');
			if (elem.length == 0) {
				setTimeout(showWidget, 200);
			}
		}

		window.onload=setTimeout(showWidget, 2000)

		window.addEventListener('ari10-widget-transaction-canceled-event', (event) => {
			console.log('Received transaction canceled event: ', JSON.stringify(event.detail));
			window.location.href = '<?php echo $ari->getReturnUrl(); ?>';
		});
	</script>
</head>
<body>
</body>
</html>