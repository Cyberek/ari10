<?php
include 'inc/base_class.php';

$WIDGET_ID = 				'925571cb-9c7c-47ec-a0c9-72cf72617b68';
$WIDGET_SECRET = 			'3d441ee1a1254254829689845d6f9474';
$RETURN_URL =				'http://127.0.0.1';

$TRANSACTION_AMMOUNT = 		23.65;
$TRANSACTION_CURRENCY = 	'PLN';

$ari = new AriClass(widget_id: $WIDGET_ID, widget_secret: $WIDGET_SECRET, return_url: $RETURN_URL);
$ari->setAmount($TRANSACTION_AMMOUNT);
$ari->setCurrency($TRANSACTION_CURRENCY); ?>
<!DOCTYPE html>
<html lang="pl">
<?php include 'inc/header_docs.php' ?>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Comodities event timeout load no redirrect (old method)</title>
	<script>
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
			window.location.href = '<?php echo $RETURN_URL ?>';
		});
	</script>
</head>
<body>
</body>
</html>