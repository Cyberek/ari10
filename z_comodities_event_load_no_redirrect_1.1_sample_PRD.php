<?php
include 'inc/base_class.php';
$WIDGET_ID = 				'';
$WIDGET_SECRET = 			'';
$RETURN_URL =				'';

$TRANSACTION_AMMOUNT = 		99.99;
$TRANSACTION_CURRENCY = 	'PLN';

$ari = new AriClass(widget_id: $WIDGET_ID, widget_secret: $WIDGET_SECRET, return_url: $RETURN_URL, is_prod: true);
$ari->setAmount($TRANSACTION_AMMOUNT);
$ari->setCurrency($TRANSACTION_CURRENCY); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Comodities event listener load no redirrect</title>
	<script>
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
	<script src="https://gateway.ari10.com/widget/main.min.js"></script>
	
</head>
<body>
</body>
</html>