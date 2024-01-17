<?php
include 'inc/base_class.php';
$WIDGET_ID = 				'dd6b6f7f-1f85-476c-80db-bc1e4e35b9cf';
$WIDGET_SECRET = 			'3fd5fa5913514424a3346b133264676a';

$TRANSACTION_AMMOUNT = 		129.7;
$TRANSACTION_CURRENCY = 	'PLN';

$ari = new AriClass(widget_id: $WIDGET_ID, widget_secret: $WIDGET_SECRET, is_prod: true);
$ari->setAmount($TRANSACTION_AMMOUNT);
$ari->setCurrency($TRANSACTION_CURRENCY); ?>
<!DOCTYPE html>
<html lang="pl">
<?php include 'inc/header_docs.php' ?>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Comodities event listener load no redirrect</title>
	<script>
		widget_simple_view_9501036516336 = 'true';
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