<!--
widget id: 		<?php echo $ari->getWidgetId() ?> 
secret:			<?php echo $ari->getWidgetSecret() ?> 

ammount:		<?php echo $ari->getTransactionAmount() ?> 
currency:		<?php echo $ari->getTransactionCurrency() ?> 
return page:	<?php echo $ari->getReturnUrl() ?> 

signature str:	<?php echo $ari->getSignatureStr() ?> 
signatue:		<?php echo $ari->getTransactionSignature() ?> 

curl -X POST --location '<?php echo $ari->getApiBackend() ?>' -H 'Content-Type: application/json' -H 'Ari10-Widget-Id: <?php echo $ari->getWidgetId() ?>' -d '{ "widgetBaseUrl": "<?php echo $ari->getReturnUrl() ?>", "offeredCurrencyCode": "<?php echo $ari->getTransactionCurrency() ?>", "offeredAmount": <?php echo $ari->getTransactionAmount() ?>, "signature": "<?php echo $ari->getTransactionSignature() ?>" }' 
-->