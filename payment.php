<?php
$orderid='m14785265';
$merchant ='TESTNITEST2';
$merchantU ='merchant.TESTNITEST2';
$apipassword = '050ccb036307426a6a4ace4a57a70ad2';
$returnUrl = 'http://mpgs.test/success.php';
$currency = 'USD';
$description="mmmm";
$amount = 100;


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://test-network.mtf.gateway.mastercard.com/api/nvp/version/73');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "apiOperation=INITIATE_CHECKOUT&apiPassword=$apipassword&apiUsername=merchant.$merchant&merchant=$merchant&interaction.operation=AUTHORIZE&interaction.merchant.name=$merchant&order.id=$orderid&order.amount=$amount&order.currency=$currency&order.description=$description");

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

$successIndicator = $array['successIndicator'];
$successVersion = $array['session.version'];

file_put_contents('success.log',print_r($array,true).'\n',FILE_APPEND);


//exit;
?>
<html>
<head>

</head>
<body>
    <div id="embed-target"></div>
</body>
<script src="https://test-network.mtf.gateway.mastercard.com/static/checkout/checkout.min.js"
        data-error="errorCallback"
        data-cancel="cancelCallback"
        data-complete="<?=$returnUrl?>"
        data-afterRedirect="restorePageState"
        return_url="<?=$returnUrl?>"
></script>
<script>
    Checkout.configure({
        session: {
            id: '<?=$sessionid?>'
        }
    });
    function errorCallback(e){
        console.log("here errorCallback")
        console.log(e)
        console.log("End All ")
    }
    function cancelCallback(e){
        console.log("here cancelCallback")
        console.log(e)
        console.log("End All ")
    }
    function completeCallback(e){
        console.log("here completeCallback")
        console.log(e)
        console.log("End All ")
    }
    function restorePageState(e){
        console.log("here afterRedirect")
        console.log(e)
        console.log("End All ")
    }
    Checkout.showPaymentPage();
</script>
</html>
