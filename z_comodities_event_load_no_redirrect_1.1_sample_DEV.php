<?php
include 'inc/base_class.php';
$WIDGET_ID = 				'4a4a8721-3307-4efa-a69a-0c510e19c0ba';
$WIDGET_SECRET = 			'dbed85fdb09147b1b3e91e020f57cff5';

$TRANSACTION_AMMOUNT = 		99.99;
$TRANSACTION_CURRENCY = 	'PLN';

$ari = new AriClass(widget_id: $WIDGET_ID, widget_secret: $WIDGET_SECRET);
$ari->setAmount($TRANSACTION_AMMOUNT);
$ari->setCurrency($TRANSACTION_CURRENCY); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Comodities event listener load no redirrect</title>
	<script>
		widget_simple_view_9501036516336 = 'false';
		widget_no_logo_8075047110440 = 'false';
		widget_id_6851681344231 = "<?php echo $ari->getWidgetId() ?>"
		widget_language_1776290735652 = "pl"

		window.addEventListener('ari10-transaction-window-loaded-event', (event) => {
			window.dispatchEvent(
				new CustomEvent('ari10-widget-start-commodities-payment-request', {
					detail: { 
						transactionId: '<?php echo $ari->getTransactionId() ?>', //transaction ID
						mailAddress: '<?php echo $ari->getTestEmail() ?>', //optional
						phoneNumber: '<?php echo $ari->getTestPhoneNr() ?>' //optional (E.164 phone format)
					}
				})
			);
		});
	</script>
	<script src="https://gateway.ari10.com/widget/main-tst.min.js"></script>
	
</head>
<body>
</body>
</html>