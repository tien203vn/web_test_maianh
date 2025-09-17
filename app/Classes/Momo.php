<?php
namespace App\Classes;

class Momo{

    public function __construct(){

    }

    public function payment($order){
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

    $orderId = time() . "";
    $orderInfo = "Test thanh toán MoMo";
    $amount = "10000"; // 10.000đ
    $redirectUrl = "https://webhook.site/your-redirect-url"; // Địa chỉ redirect (hoặc localhost)
    $ipnUrl = "https://webhook.site/your-ipn-url"; // Địa chỉ nhận kết quả (notifyUrl)
    $extraData = ""; // không bắt buộc

    $requestId = time() . "";
    $requestType = "captureMoMoWallet";

    // Tạo chuỗi signature
    $rawHash = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";
    $signature = hash_hmac("sha256", $rawHash, $secretKey);

    $data = array(
        'partnerCode' => $partnerCode,
        'accessKey' => $accessKey,
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature,
        'lang' => 'vi'
    );

    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $result = curl_exec($ch);
    curl_close($ch);

    $jsonResult = json_decode($result, true);
    header('Location: ' . $jsonResult['payUrl']); // Mở trang giả lập MoMo

    }
    
	
}