<?php
include 'inc/base_class.php';

$WIDGET_ID = 				'a58781f2-9de3-4809-888a-89749178248e';
$WIDGET_SECRET = 			'ef9cb8cf0b3f45c996a0094557115094';

$TRANSACTION_AMMOUNT = 		79.99;
$TRANSACTION_CURRENCY = 	'PLN';

$ari = new AriClass(widget_id: $WIDGET_ID, widget_secret: $WIDGET_SECRET);
$ari->setAmount($TRANSACTION_AMMOUNT);
$ari->setCurrency($TRANSACTION_CURRENCY); ?>
<!DOCTYPE html>
<html lang="pl">
<?php include 'inc/header_docs.php'; ?>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>New Layout for Comodities - test method</title>
	<script>
		widget_subtype_3358856118598 = 'GATEFLOW';
		widget_id_6851681344231 = "<?php echo $ari->getWidgetId(); ?>"
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