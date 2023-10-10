<?php
$orderid='23232';
$merchant ='TESTNITEST2';
$merchantU ='merchant.TESTNITEST2';
$apipassword = '050ccb036307426a6a4ace4a57a70ad2';
$returnUrl = 'http://mpgs.test/success.php';
$currency = 'USD';
$description="mmmm";
$amount = 1;


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://test-network.mtf.gateway.mastercard.com/api/nvp/version/73');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "apiOperation=INITIATE_CHECKOUT&apiPassword=$apipassword&apiUsername=merchant.$merchant&merchant=$merchant&interaction.operation=AUTHORIZE&interaction.merchant.name=$merchant&order.id=$orderid&order.amount=100.00&order.currency=USD&order.description=$description");

$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);

if(curl_errno($ch)){
    echo curl_error($ch);
}
curl_close($ch);
$a = explode('&', $result);
foreach ($a as $result) {
    $b = explode('=', $result);
    $array[$b[0]] = $b[1];
}
$sessionid = ($array['session.id']);
//exit;
?>
<script src="https://test-gateway.mastercard.com/static/checkout/checkout.min.js" data-error="errorCallback" data-cancel="cancelCallback"></script>
<script>
    Checkout.configure({
        session: {
            id: '<?=$sessionid?>'
        },
    });
    function errorCallback(e){
        console.log(e)
    }
    function cancelCallback(e){
        console.log(e)
    }
    Checkout.showPaymentPage()
</script>