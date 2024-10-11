<?php
include 'inc/base_class.php';

$WIDGET_ID = 				'f3f8ba74-20c7-40b5-9061-4834c89351e2';
$WIDGET_SECRET = 			'5f5f2774f1964c08846240b15e0eb9fc';

$TRANSACTION_AMMOUNT = 		79.99;
$TRANSACTION_CURRENCY = 	'PLN';

$PARTNER_METADATA = array(
	"partnerTransactionId"=>"12345678-abc-9012-abc-123456789ab", 
	"partnerClientType"=>"vip-client",
	"partnerParams"=>array(
		"clientID"=>"1234567890abcde",
		"clientAdditionalInfo"=>"custom info"
	)
);

$ari = new AriClass(widget_id: $WIDGET_ID, widget_secret: $WIDGET_SECRET, partner_metadata: $PARTNER_METADATA);
$ari->setAmount($TRANSACTION_AMMOUNT);
$ari->setCurrency($TRANSACTION_CURRENCY); ?>
<!DOCTYPE html>
<html lang="pl">
<?php include 'inc/header_docs.php' ?>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Comodities event listener load no redirrect - Simple + multiple payments  + partnerMetadata Custom Params</title>
	<script>
		widget_simple_view_9501036516336 = 'true';
		widget_no_logo_8075047110440 = 'true';
		widget_id_6851681344231 = "<?php echo $ari->getWidgetId() ?>"
		widget_language_1776290735652 = "en"
	</script>
	<script src="https://gateway-dev.ari10.com/widget/main-tst.min.js"></script>
</head>
<body>
	<script>
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
</body>
</html>