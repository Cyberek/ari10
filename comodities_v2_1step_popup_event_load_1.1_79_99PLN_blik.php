<?php
include 'inc/base_class.php';

$WIDGET_ID = 				'85499ff3-b140-481f-8cbf-6458ed9e50e7';
$WIDGET_SECRET = 			'3d441ee1a1254254829689845d6f9474';

$TRANSACTION_AMMOUNT = 		79.99;
$TRANSACTION_CURRENCY = 	'PLN';

$ari = new AriClass(widget_id: $WIDGET_ID, widget_secret: $WIDGET_SECRET);
$ari->setAmount($TRANSACTION_AMMOUNT);
$ari->setCurrency($TRANSACTION_CURRENCY); ?>
<!DOCTYPE html>
<html lang="pl">
<?php include 'inc/header_docs.php' ?>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Comodities event listener load no redirrect - Simple + Blik + no logo</title>
	<script>
		widget_simple_view_9501036516336 = 'true';
		widget_no_logo_8075047110440 = 'true';
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
	<script src="https://gateway-dev.ari10.com/widget/main-tst.min.js"></script>
	
</head>
<body>
</body>
</html>