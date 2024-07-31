<?php 

// Параметры для имени и телефона должны быть name и phone соответственно
// Пример:
// <input type="text" name="name"  placeholder="Ваше имя">
// <input type="text" name="lname" placeholder="Ваша фамилия">
// <input type="text" name="email" placeholder="Ваш Email">
// <input type="tel"  name="phone" placeholder="Ваш телефон">
//
// Скрытие параметры которые должны быть на странице:
//
// <input type="hidden" name="subid" value="{subid}">  // ClickID
// <input type="hidden" name="sid" value="jd2Od">      // Offer ID (TL/Shakes/LemonAD/) / GoodsID (LeadReaktor) / Product ID (M1) / Flow (OfferStore)
// <input type="hidden" name="oid" value="12892">      // Channel (KMA) / stream_hid (TL) / streamCode (Shakes) / ref (M1) / campaign_hash (luckyonline) / Offer (OfferStore)
// <input type="hidden" name="aff" value="1">          // ПП (Вместо 1 - пишем нужную ПП)
//
// Доп. параметры:
// <input type="hidden" name="sub1" value="1"> 
// <input type="hidden" name="sub2" value="1"> 
// <input type="hidden" name="sub3" value="1"> 
// <input type="hidden" name="sub4" value="1"> 
// <input type="hidden" name="sub5" value="1"> 
//
// С П И С О К    П П  (для параметра aff) :
//  1 - KMA
//  2 - TrafficLight
//  3 - Shakes
//  4 - Lemonad
//  5 - LeadReaktor
//  6 - M1
//  7 - LuckyOnline
//  8 - offer.store
//  9 - RocketProfit
// 10 - LeadTrade
// 11 - AdCombo
// 12 - CashFactories
// 13 - Cryp.IM
// 14 - terraLeads
// 15 - leadBit
// 16 - MetaCPA
// 17 - AcePartners
// 18 - OMNI

date_default_timezone_set("Europe/Moscow");

// Keitaro Postback Code
$kt = "88c2c34";

// ВЫБОР СТРАНЫ ЛИДА
$country    = "DZ";                 // Тут вводить страну
// $country    = getCountry($ip);   // Тут раскомментировать, чтобы само по айпи детектило

if(empty($_POST['name'])){
    header("Location: .");
}

function getCountry($ip){
    $a = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip);
    try{
        $a = json_decode($a);
        return $a->{'geoplugin_countryCode'};
    }catch(exception $e){
        return "RU";
    }
    return "RU";
}

function getIp() {
    $keys = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'REMOTE_ADDR'
    ];
    foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            $ip = trim(end(explode(',', $_SERVER[$key])));
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }
}

function logEvent($network, $apikey, $post, $response){
    $text  = "\n\n-------------------------------";
    $text .= "\n\nDate (UTC): " . date('m/d/Y H:i:s', time());
    $text .= "\n\nAff. Net: "   . $network;
    $text .= "\n\nAPI: "      . $apikey;
    $text .= "\n\nData: \n"     . json_encode($post, JSON_PRETTY_PRINT);
    $text .= "\n\nResponse: \n" . $response;
    file_put_contents("log.txt", $text, FILE_APPEND);
}

function kma($name, $phone, $subid, $ip, $country, $referer, $streamid){
    global $kt;
    $API_TOKEN = 'jAQTli6acnxU-qZIp6K8rIjzz0kTQBPp'; // АПИ КЛЮЧ
    $post = [
        'name'      => $name . " " . rand(1,9),
        'phone'     => $phone,
        'data1'     => $subid,
        'data2' => key_exists('sub1', $_POST) ? $_POST['sub1'] : null,
        'data3' => key_exists('sub2', $_POST) ? $_POST['sub2'] : null,
        'data4' => key_exists('sub3', $_POST) ? $_POST['sub3'] : null,
        'data5' => key_exists('sub4', $_POST) ? $_POST['sub4'] : null,
        'ip'        => $ip,
        'country'   => $country,
        'referer'   => $referer,
        'channel'   => $streamid,
    ];
    $ch = curl_init('https://api.kma.biz/lead/add');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    curl_setopt($ch, CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $API_TOKEN
        )
    );
    $j = curl_exec($ch);
    $response = json_decode($j,1);
    if($response["code"] == 0 || $response["code"] == "0"){
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_14" => $name, "sub_id_15" => $phone]));
    } else {
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "rejected", "sub_id_14" => $name, "sub_id_15" => $phone, "sub_id_8" => $response['message']]));
    }
    curl_close($ch);
    logEvent("KMA", $API_TOKEN, $post, $j);
}

function tl($name, $phone, $subid, $ip, $country, $referer, $streamid, $offerid){
    $apiKey = '1IPcGkwfvW355wLqM4w9ZgZR0RqAvjw0yX6QcB0UrDRwMJ7aWg4e9KdRqfkT1Ns3';   // Ключ доступа к API
    $post = array(
        'key' => $apiKey,
        'id' => $subid, 
        'offer_id' => $offerid,
        'stream_hid' => $streamid,
        'name' => $name,
        'phone' => $phone,
        'comments' => $subid,
        'country' => $country,    
        'ip_address' => $ip,
        'user_agent' => $_SERVER['HTTP_USER_AGENT'],
        "sub1" => $subid,
        'utm_source' => key_exists('sub1', $_POST) ? $_POST['sub1'] : null,
        'utm_campaign' => key_exists('sub2', $_POST) ? $_POST['sub2'] : null,
        'utm_content' => key_exists('sub3', $_POST) ? $_POST['sub3'] : null,
        'utm_term' => key_exists('sub4', $_POST) ? $_POST['sub4'] : null,
        'utm_medium' => key_exists('sub5', $_POST) ? $_POST['sub5'] : null,
    );

    $ch = curl_init('http://api.cpa.tl/api/lead/send');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    $response = curl_exec($ch);
    curl_close($ch);
    logEvent("TL", $apiKey, $post, $response);
}

function shakes($name, $phone, $subid, $ip, $country, $referer, $streamid, $offerid){
    $apiKey = '9c91e7112b1dfaa4fa526b484110c008';   // Ключ доступа к API
    $post = array(
        'countryCode'   => $country,
        'comment'       => $subid,
        'createdAt'     => date('Y-m-d H:i:s'),
        'ip'            => $ip,
        'name'          => $name,
        'offerId'       => $offerid,
        'phone'         => $phone,
        'referrer'      => $referer,
        'streamCode'    => $streamid,
        'sub1'          => $subid,
        'sub2' => key_exists('sub1', $_POST) ? $_POST['sub1'] : null,
        'sub3' => key_exists('sub2', $_POST) ? $_POST['sub2'] : null,
        'sub4' => key_exists('sub3', $_POST) ? $_POST['sub3'] : null,
        'userAgent'     => $_SERVER['HTTP_USER_AGENT'],
        'landingUrl'    => explode("?",$referer)[0],
    );

    $ch = curl_init('http://shakes.pro?r=/api/order/in&key='.$apiKey);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'curl/' . (curl_version()['version'] ?? '7'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    $response = curl_exec($ch);
    curl_close($ch);
    logEvent("Shakes", $apiKey, $post, $response);
}

function lemonad($name, $phone, $subid, $ip, $offerid){
    $API_URL = "https://sendmelead.com/api/v3/lead/add";
    $WEBMASTER_TOKEN = '1fbc01f70abb3dce4fee8f2f263e4e31'; // Токен из Вашего профиля
    $post = array(
        'name'      => $name,
        'phone'     => $phone,
        'offerId'   => $offerid,
        'domain'    => "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"],
        'ip'        => $ip,
        'clickid'   => $subid,
        'utm_source' => key_exists('sub1', $_POST) ? $_POST['sub1'] : null,
        'utm_campaign' => key_exists('sub2', $_POST) ? $_POST['sub2'] : null,
        'utm_content' => key_exists('sub3', $_POST) ? $_POST['sub3'] : null,
        'utm_term' => key_exists('sub4', $_POST) ? $_POST['sub4'] : null,
        'utm_medium' => key_exists('sub5', $_POST) ? $_POST['sub5'] : null,
    //  'fbpxl'     => key_exists('fbpxl', $_POST) ? $_POST['fbpxl'] : null,
    );

    $data = json_encode($post);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $API_URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data),
            'X-Token: '. $WEBMASTER_TOKEN,
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    logEvent("Lemon.AD", $WEBMASTER_TOKEN, $post, $response);
}

function leadreaktor($name, $phone, $subid, $ip, $country, $offerid){
    $apiKey = "d8f13f5049b04e6995d8dd80eef8eb25";   // Ключ доступа к API
    $post = array(
        'goods_id'  => $offerid,
        'ip'        => $ip,
        'msisdn'    => $phone,
        'name'      => $name,
        'country'   => $country,
        'domain'    => $_SERVER['SERVER_NAME'],
    );
    $post['url_params[sub1]'] = $subid;
    $post['url_params[sub2]'] = key_exists('sub1', $_POST) ? $_POST['sub1'] : null;
    $post['url_params[sub3]'] = key_exists('sub2', $_POST) ? $_POST['sub1'] : null;
    $post['url_params[sub4]'] = key_exists('sub3', $_POST) ? $_POST['sub1'] : null;
    $post['url_params[sub5]'] = key_exists('sub4', $_POST) ? $_POST['sub1'] : null;
    $post['url_params[utm_source]'] = key_exists('sub5', $_POST) ? $_POST['sub1'] : null;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api-new.leadreaktor.com/api/order/create.php?api_key=" . $apiKey);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $response = curl_exec($ch);
    curl_close($ch);
    logEvent("LeadReaktor", $apiKey, $post, $response);
}

function m1($name, $phone, $subid, $ip, $streamid, $offerid){
    $apiKey = 'ddd5e8a4750a34370c83e40315d985e8';   // Ключ доступа к API
    $post = [
        'ref'        => $streamid,
        'api_key'    => $apiKey,
        'product_id' => $offerid,
        'phone'      => $phone,
        'name'       => $name,
        'ip'         => $ip,
        's'          => $subid,
        'w' => key_exists('sub1', $_POST) ? $_POST['sub1'] : null,
        't' => key_exists('sub2', $_POST) ? $_POST['sub2'] : null,
        'p' => key_exists('sub3', $_POST) ? $_POST['sub3'] : null,
        'm' => key_exists('sub4', $_POST) ? $_POST['sub4'] : null,
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_URL, 'http://m1.top/send_order/');
    $response = curl_exec($ch);
    curl_close($ch);
    logEvent("M1", $apiKey, $post, $response);
}

function luckyonline($name, $phone, $subid, $ip, $country, $streamid){
    $apiKey = '654e2429133e1443321503402291';   // Ключ доступа к API
    $post = array(
        'campaign_hash' => $streamid,
        'ip' => $ip,
        'name' => $name,
        'phone' => $phone,
        'user_agent' => $_SERVER['HTTP_USER_AGENT'],
        'country' => $country,
        'subid'=> $subid,
        'utm_source' => key_exists('sub1', $_POST) ? $_POST['sub1'] : null,
        'utm_campaign' => key_exists('sub2', $_POST) ? $_POST['sub2'] : null,
        'utm_content' => key_exists('sub3', $_POST) ? $_POST['sub3'] : null,
        'utm_term' => key_exists('sub4', $_POST) ? $_POST['sub4'] : null,
        'utm_medium' => key_exists('sub5', $_POST) ? $_POST['sub5'] : null,
    );

    $ch = curl_init('https://lucky.online/api/v1/lead-create/webmaster?api_key='.$apiKey);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $response = curl_exec($ch);
    curl_close($ch);
    logEvent("LuckyOnline", $apiKey, $post, $response);
}

function offerStore($name, $phone, $subid, $ip, $referer, $streamid, $offerid){
    $apiKey = '1751-2fc461a9a2c2bf452ac787def5517677';   // Ключ доступа к API
    $post = [
        'name'   => $name,
        'phone'  => $phone,
        'subid'  => $subid,
        'ip'     => $ip,
        'ua'     => $_SERVER['HTTP_USER_AGENT'],
        'domain' => explode("?",$referer)[0],
        'utm_source' => key_exists('sub1', $_POST) ? $_POST['sub1'] : null,
        'utm_campaign' => key_exists('sub2', $_POST) ? $_POST['sub2'] : null,
        'utm_content' => key_exists('sub3', $_POST) ? $_POST['sub3'] : null,
        'utm_term' => key_exists('sub4', $_POST) ? $_POST['sub4'] : null,
        'utm_medium' => key_exists('sub5', $_POST) ? $_POST['sub5'] : null,
    ];

    $ch = curl_init("https://api.offer.store/wm/push.json?id=".$apiKey."&offer=".$offerid."&flow=".$streamid);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt($ch, CURLOPT_TIMEOUT, 65 );
    curl_setopt($ch, CURLOPT_POST, 1 );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post );
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"] );
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0 );
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0 );
    $response = curl_exec($ch);
    curl_close($ch);
    logEvent("OfferStore", $apiKey, $post, $response);
}

function rocketProfit($name, $phone, $subid, $ip, $country, $streamid){
    $order = array(
        'name' => $name,
        'phone' => $phone,
        'sid1' => $subid,
        'sid2' => key_exists('sub1', $_POST) ? $_POST['sub1'] : null,
        'sid3' => key_exists('sub2', $_POST) ? $_POST['sub2'] : null,
        'sid4' => key_exists('sub3', $_POST) ? $_POST['sub3'] : null,
        'sid5' => key_exists('sub4', $_POST) ? $_POST['sub4'] : null,
        'ip' => $ip,
        'country_code' => $country,
        'campaign_id' => $streamid,
    );
    $ch = curl_init('https://tracker.rocketprofit.com/conversion/new');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($ch, CURLOPT_POST,           1 );
    curl_setopt($ch, CURLOPT_POSTFIELDS,     http_build_query($order));
    curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: application/x-www-form-urlencoded'));
    $result = curl_exec($ch);
    logEvent("RocketProfit", "", $order, $result);
}

function leadTrade($name, $phone, $subid, $ip, $country, $streamid){
    $post = [
        'name' => $name,
        'phone' => $phone,
        'subid1' => $subid,
        'subid2' => key_exists('sub1', $_POST) ? $_POST['sub1'] : null,
        'subid3' => key_exists('sub2', $_POST) ? $_POST['sub2'] : null,
        'subid4' => key_exists('sub3', $_POST) ? $_POST['sub3'] : null,
        'ip' => $ip,
        'country' => $country,
        'hash' => $streamid,
    ];
    
    $ch = curl_init("https://leadtrade.ru/api/send_lead");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.152 Safari/537.36");
    
    $doc = curl_exec($ch);
    curl_close($ch);
    logEvent("LeadTrade", "", $post, $doc);
}

function adCombo($name, $phone, $subid, $ip, $referer, $offerid, $streamid, $country){
    $apiKey = '0cce960a2e4e46b9debbb9632de7739e';   // Ключ доступа к API
    $data = [
        'api_key' => $apiKey,
        'name' => $name,
        'phone' => $phone,
        'clickid' => $subid,
        'ip' => $ip,
        'base_url' => $referer,
        'referrer' => $referer,
        'offer_id' => $offerid,
        'country_code' => $country,
        'price' => $streamid,
        'utm_source' => key_exists('sub1', $_POST) ? $_POST['sub1'] : null,
        'utm_campaign' => key_exists('sub2', $_POST) ? $_POST['sub2'] : null,
        'utm_content' => key_exists('sub3', $_POST) ? $_POST['sub3'] : null,
        'utm_term' => key_exists('sub4', $_POST) ? $_POST['sub4'] : null,
        'utm_medium' => key_exists('sub5', $_POST) ? $_POST['sub5'] : null,
    ];

    $ch = curl_init("https://api.adcombo.com/api/v2/order/create/?".http_build_query($data));
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0 );
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0 );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
    $response = curl_exec($ch);
    curl_close($ch);
    logEvent("AdCombo", $apiKey, $data, $response);
}

function cashFactories($name, $phone, $subid, $ip, $referer, $streamid, $offerid){
    $apiKey = '1333-65c831695c53b76819098be7e1714dfc';   // Ключ доступа к API
    $post = [
        'name'   => $name,
        'phone'  => $phone,
        'subid'  => $subid,
        'ip'     => $ip,
        'ua'     => $_SERVER['HTTP_USER_AGENT'],
        'domain' => explode("?",$referer)[0],
        'utm_source' => key_exists('sub1', $_POST) ? $_POST['sub1'] : null,
        'utm_campaign' => key_exists('sub2', $_POST) ? $_POST['sub2'] : null,
        'utm_content' => key_exists('sub3', $_POST) ? $_POST['sub3'] : null,
        'utm_term' => key_exists('sub4', $_POST) ? $_POST['sub4'] : null,
        'utm_medium' => key_exists('sub5', $_POST) ? $_POST['sub5'] : null,
    ];

    $ch = curl_init("https://cashfactories.com/api/wm/push.json?id=".$apiKey."&offer=".$offerid."&flow=".$streamid);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt($ch, CURLOPT_TIMEOUT, 65 );
    curl_setopt($ch, CURLOPT_POST, 1 );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post );
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"] );
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0 );
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0 );
    $response = curl_exec($ch);
    curl_close($ch);
    logEvent("CashFactories", $apiKey, $post, $response);
}

function crypIM($name, $lname, $email, $phone, $subid, $ip, $referer, $streamid){
    $apiKey = 'cWPy2COKr57eW8oWX0LvAKu9ObISb0r7cG0wx6l3vWmWt0N1kNkwLGH6otiT';   // Ключ доступа к API
    $data = [
        'api_token' => $apiKey,
        'first_name' => $name,
        'last_name' => $lname,
        'email' => $email,
        'phone' => $phone,
        'sub1' => $subid,
        'sub2' => key_exists('sub1', $_POST) ? $_POST['sub1'] : null,
        'sub3' => key_exists('sub2', $_POST) ? $_POST['sub2'] : null,
        'sub4' => key_exists('sub3', $_POST) ? $_POST['sub3'] : null,
        'click_id' => $subid,
        'ip' => $ip,
        'flow_hash' => $streamid,
        'landing' => explode("?",$referer)[0],
        'user-agent' => $_SERVER['HTTP_USER_AGENT']
    ];

    $ch = curl_init("https://cryp.im/api/v1/web/conversion/?api_token=".$apiKey);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);
    logEvent("CrypIM", $apiKey, $post, $response);
}

function terraLeads($name, $phone, $subid, $country, $ip, $referer, $streamid, $offerid){
    $apiKey = '10d470a3e918a233ecc224e0b1259f14';  // API access key
    $userID = '66954';
    $data = [
        'user_id' => $userID,
        'data' => [
            // 'api_key' => $apiKey,
            'name' => $name,
            'phone' => preg_replace('/[ \+\(\)-]/', '', $phone),
            'offer_id' => $offerid, 
            'country' => $country,  
            'sub_id' => $subid,
            'sub_id_1' => key_exists('sub1', $_POST) ? $_POST['sub1'] : null,
            'sub_id_2' => key_exists('sub2', $_POST) ? $_POST['sub2'] : null,
            'sub_id_3' => key_exists('sub3', $_POST) ? $_POST['sub3'] : null,
            'sub_id_4' => key_exists('sub4', $_POST) ? $_POST['sub4'] : null,
            'stream_id' => $streamid,
            'ip' => $ip,
            'referer' => $referer,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
        ],
    ];

    $checksum = sha1(json_encode($data).$apiKey);

    $ch = curl_init("http://tl-api.com/api/lead/create?" . http_build_query(['check_sum' => $checksum]));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    $response = curl_exec($ch);
    curl_close($ch);

    logEvent("TerraLeads", $apiKey, $data, $response);
}

function leadBit($name, $phone, $subid, $country, $referer, $streamid){
    $apiKey = '_666181c29a5bf446772125';  // API access key
    $data = [
        "flow_hash" => $streamid,
        "landing" => explode("?",$referer)[0],
        "phone" => $phone,
        "name" => $name,
        "country" => $country,
        "referrer" => $referer,
        "comment" => $subid,
        "sub1" => $subid,
        "sub2" => key_exists('sub1', $_POST) ? $_POST['sub1'] : null,
        "sub3" => key_exists('sub2', $_POST) ? $_POST['sub2'] : null,
        "sub4" => key_exists('sub3', $_POST) ? $_POST['sub3'] : null,
        "sub5" => key_exists('sub4', $_POST) ? $_POST['sub4'] : null,
    ];

    $url = "http://wapi.leadbit.com/api/pub/new-order/" . $apiKey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);
    curl_close($ch);

    logEvent("leadBit", $apiKey, $data, $response);
}

function metacpa($name, $phone, $subid, $country, $ip, $streamid){
    $apiKey = '1da7861e51513dc73b3d29825c5df127cdd6438dda094948';  // API access key
    $geocode = ["IR" => "25325", "CY" => "25342", "RW" => "25372", "SO" => "25373", "YE" => "25384", "LY" => "25392", "IQ" => "25395", "SA" => "25432", "AO" => "25680", "AZ" => "25724", "TZ" => "25731", "TM" => "25755", "SY" => "25758", "AM" => "25775", "ZM" => "25782", "KE" => "25784", "CG" => "25835", "DJ" => "25840", "UG" => "25841", "CF" => "25850", "SC" => "25854", "TD" => "25862", "JO" => "25864", "GR" => "25875", "LB" => "26067", "PS" => "26106", "IL" => "26109", "KW" => "26122", "OM" => "26144", "QA" => "26161", "BH" => "26177", "AE" => "26209", "TR" => "26518", "ET" => "26729", "ER" => "26743", "EG" => "26763", "AL" => "26851", "SD" => "26854", "SS" => "26873", "BI" => "26910", "RU" => "26927", "EE" => "26930", "LV" => "26932", "LT" => "28525", "SE" => "28645", "KZ" => "28711", "GE" => "28730", "MD" => "28796", "BY" => "28891", "FI" => "28958", "AX" => "29098", "RO" => "29625", "UA" => "30746", "HU" => "31134", "MK" => "31339", "SK" => "31527", "BG" => "31697", "PL" => "32250", "NO" => "33397", "RS" => "33459", "XK" => "33477", "NA" => "33760", "ZW" => "33765", "YT" => "33813", "KM" => "33817", "MW" => "33829", "LS" => "33836", "BW" => "33843", "MU" => "33860", "SZ" => "33903", "RE" => "33912", "ZA" => "33953", "MZ" => "34405", "MG" => "34421", "PK" => "34456", "TH" => "34461", "AF" => "34465", "BD" => "34667", "ID" => "34695", "UZ" => "34717", "TJ" => "34726", "MY" => "34734", "LK" => "34737", "BT" => "34797", "IN" => "34801", "CN" => "36228", "MV" => "36252", "IO" => "36254", "NP" => "36256", "MM" => "36273", "MN" => "36705", "KG" => "36787", "TF" => "36835", "CC" => "36837", "PW" => "36862", "VN" => "36864", "TL" => "37527", "LA" => "37588", "TW" => "37592", "PH" => "37681", "HK" => "39388", "BN" => "39492", "MO" => "39507", "KH" => "39512", "KR" => "39539", "JP" => "39725", "KP" => "40807", "SG" => "40809", "CK" => "40883", "AU" => "41655", "CX" => "42146", "MH" => "42177", "FM" => "42179", "PG" => "42186", "SB" => "42233", "KI" => "42237", "TV" => "42239", "NR" => "42242", "VU" => "42596", "NC" => "42602", "NF" => "43492", "NZ" => "45179", "FJ" => "45546", "CM" => "45728", "SN" => "45769", "CG" => "45794", "PT" => "45801", "LR" => "46299", "CI" => "46304", "GH" => "46311", "GQ" => "46342", "NG" => "46351", "BF" => "46483", "TG" => "46495", "GW" => "46500", "MR" => "46508", "BJ" => "46513", "GA" => "46520", "SL" => "46533", "ST" => "46536", "GI" => "46540", "GM" => "46545", "GN" => "46550", "NE" => "46577", "ML" => "46584", "MA" => "46590", "TN" => "46597", "DZ" => "46671", "ES" => "46846", "IT" => "48162", "MT" => "49016", "AT" => "49180", "DK" => "49196", "FO" => "49252", "IS" => "49995", "GB" => "50006", "IE" => "55169", "CH" => "56046", "SJ" => "58732", "NL" => "59241", "BE" => "63000", "DE" => "64127", "LU" => "71403", "FR" => "71915", "MC" => "79698", "AD" => "90970", "LI" => "91003", "JE" => "91027", "IM" => "91030", "GG" => "91042", "CZ" => "92368", "VA" => "98648", "SM" => "99129", "BA" => "103241", "HR" => "103244", "SI" => "103255", "ME" => "103371", "SH" => "104980", "BB" => "104998", "CV" => "105040", "GY" => "105051", "GF" => "105064", "SR" => "105073", "BR" => "105095", "GL" => "105974", "PM" => "105998", "GS" => "106003", "FK" => "106005", "AR" => "106008", "PY" => "106330", "UY" => "106386", "VE" => "109176", "MX" => "109188", "JM" => "109198", "DO" => "109219", "CW" => "109290", "BQ" => "109294", "SX" => "109296", "CU" => "109945", "MQ" => "109977", "BS" => "110010", "BM" => "110025", "AI" => "110031", "TT" => "110035", "KN" => "110123", "DM" => "110132", "AG" => "110141", "LC" => "110162", "TC" => "110176", "AW" => "110182", "VG" => "110190", "VC" => "110192", "MS" => "110197", "GP" => "110202", "MF" => "110209", "BL" => "110215", "GD" => "110242", "KY" => "110252", "BZ" => "110261", "SV" => "110282", "GT" => "110349", "HN" => "110416", "NI" => "110479", "CR" => "110518", "EC" => "110827", "CO" => "110990", "PE" => "111143", "PA" => "111185", "HT" => "111265", "CL" => "112091", "BO" => "112304", "PF" => "113025", "PN" => "113026", "TK" => "113028", "TO" => "113031", "WF" => "113049", "WS" => "113053", "NU" => "113060", "GU" => "113062", "MP" => "113066", "US" => "113076", "PR" => "120477", "VI" => "123075", "UM" => "137871", "AS" => "138030", "CA" => "138035", "AQ" => "142424", "WW" => "146773", "EH" => "317778", "HM" => "323186", "BV" => "343142"];
    $data = [
        "flow_id" => $streamid, 
        "name" => $name,
        "phone" => $phone,
        "ip" => $ip, 
        "geo" => $geocode[$country],
        "sub1" => $subid,
        "sub2" => key_exists('sub1', $_POST) ? $_POST['sub1'] : null,
        "sub3" => key_exists('sub2', $_POST) ? $_POST['sub2'] : null,
        "sub4" => key_exists('sub3', $_POST) ? $_POST['sub3'] : null,
        "sub5" => key_exists('sub4', $_POST) ? $_POST['sub4'] : null,
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_URL, 'http://metacpa.ru/create?' . http_build_query($data));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);

    logEvent("MetaCPA", $apiKey, $data, $response);
}

function acepa($name, $phone, $subid, $country, $ip, $streamid, $offerid){
    $apiKey = 'Loa9Ag4Y4fpTlr1GKZa1FSAgJpyK7SgbGBcAod0PlIknsfAM';  // API access key
    $data = [
        'key' => $apiKey,
        'id' => microtime(true), 
        'offer_id' => $offerid,
        'stream_hid' => $streamid,
        'name' => $name,
        'phone' => $phone,
        'comments' => $subid,
        'country' => $country, 
        "sub1" => $subid,
        "sub2" => key_exists('sub1', $_POST) ? $_POST['sub1'] : null,
        "sub3" => key_exists('sub2', $_POST) ? $_POST['sub2'] : null,
        "sub4" => key_exists('sub3', $_POST) ? $_POST['sub3'] : null,
        "sub5" => key_exists('sub4', $_POST) ? $_POST['sub4'] : null,
        'ip_address' => $ip,
        'user_agent' => $_SERVER['HTTP_USER_AGENT'],
    ];

    $ch = curl_init("http://api.ace.pa/api/lead/send");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

    $response = curl_exec($ch);
    curl_close($ch);

    logEvent("Ace Partners", $apiKey, $data, $response);
}

function omni($name, $phone, $subid, $ip, $country, $streamid, $offerid){
    $apiKey = 'l9X6Vhznde5pJDmCHJMxof';   // Ключ доступа к API
    $secret = 'hSriL28chqb5jkuWQQBc2H';
    $data = array(
        "country_wish_price" => [strtolower($country) => key_exists('sub2', $_POST) ? $_POST['sub2'] : 219],
        "fio" => $name,
        "phone" => $phone,
        "pbid" => $subid,
        // "visitor_id" => $subid . "_" . time(),
        'ip' => $ip,
        'country' => strtolower($country), 
        "traffic_flow_id" => $streamid,
        "product_id" => $offerid,
        'useragent' => $_SERVER['HTTP_USER_AGENT'],
        'utm_source' => key_exists('sub1', $_POST) ? $_POST['sub1'] : null,
        'special_price' => key_exists('sub3', $_POST) ? $_POST['sub3'] : null,
        'promo_language' => key_exists('sub4', $_POST) ? $_POST['sub4'] : null,
        'price' => key_exists('sub5', $_POST) ? $_POST['sub5'] : null,
    );

    $dataSign = sha1(json_encode([$secret, $data]));

    $post = [
        'token' => $apiKey,
        'data' => $data,
        'dataSign' => $dataSign,
    ];

    $ch = curl_init('https://jsapcreate.com/api/User/3.0/createOrder');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
    $response = curl_exec($ch);
    curl_close($ch);
    logEvent("OMNI", $apiKey, $post, $response);
}

$referer    = $_SERVER['HTTP_REFERER'];
$name       = $_POST['name'];
$lname      = $_POST['lname'];
$email      = $_POST['email'];
$phone      = $_POST['phone'];
$subid      = $_POST['subid'];
$streamid   = $_POST['sid'];
$offerid    = $_POST['oid'];
$aff        = $_POST['aff'];
$ip         = getIp();
$phone      = str_replace(" ", '', $phone);
$phone      = str_replace("(", '', $phone);
$phone      = str_replace(")", '', $phone);
$phone      = str_replace("-", '', $phone);

if (empty($phone) || empty($name)) {
    echo '<script type="text/javascript">
            alert("Both phone and name fields are required.");
            history.back();
          </script>';
    exit;
}


// Check for duplication

if(
  strpos(
    file_get_contents("dedup.log"),
    $phone
    ) !== FALSE
){
  ?>
<script type="text/javascript">
window.location.href = "thankyou.php"
</script>
<?php
  die();
}else{
  file_put_contents("dedup.log", $phone.PHP_EOL, FILE_APPEND);
}


switch (intval($aff)) {
    case 1:
        kma($name, $phone, $subid, $ip, $country, $referer, $streamid);
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

    case 2:
        tl($name, $phone, $subid, $ip, $country, $referer, $streamid, $offerid);
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_14" => $name, "sub_id_15" => $phone]));
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

    case 3:
        shakes($name, $phone, $subid, $ip, $country, $referer, $streamid, $offerid);
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_14" => $name, "sub_id_15" => $phone]));
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

    case 4:
        lemonad($name, $phone, $subid, $ip, $offerid);
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_14" => $name, "sub_id_15" => $phone]));
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

    case 5:
        leadreaktor($name, $phone, $subid, $ip, $country, $offerid);
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_14" => $name, "sub_id_15" => $phone]));
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

    case 6:
        m1($name, $phone, $subid, $ip, $streamid, $offerid);
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_14" => $name, "sub_id_15" => $phone]));
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

    case 7:
        luckyonline($name, $phone, $subid, $ip, $country, $streamid);
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_14" => $name, "sub_id_15" => $phone]));
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

    case 8:
        offerStore($name, $phone, $subid, $ip, $referer, $streamid, $offerid);
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_14" => $name, "sub_id_15" => $phone]));
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

    case 9:
        rocketProfit($name, $phone, $subid, $ip, $country, $streamid);
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_14" => $name, "sub_id_15" => $phone]));
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

    case 10:
        leadTrade($name, $phone, $subid, $ip, $country, $streamid);
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_14" => $name, "sub_id_15" => $phone]));
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

    case 11:
        adCombo($name, $phone, $subid, $ip, $referer, $offerid, $streamid, $country);
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_14" => $name, "sub_id_15" => $phone]));
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

    case 12:
        cashFactories($name, $phone, $subid, $ip, $referer, $streamid, $offerid);
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_14" => $name, "sub_id_15" => $phone]));
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

    case 13:
        crypIM($name, $lname, $email, $phone, $subid, $ip, $referer, $streamid);
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_9" => $email, "sub_id_14" => $name . " " . $lname, "sub_id_15" => $phone]));
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

    case 14:
        terraLeads($name, $phone, $subid, $country, $ip, $referer, $streamid, $offerid);
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_14" => $name, "sub_id_15" => $phone]));
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

    case 15:
        leadBit($name, $phone, $subid, $country, $referer, $streamid);
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_14" => $name, "sub_id_15" => $phone]));
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

    case 16:
        metacpa($name, $phone, $subid, $country, $ip, $streamid);
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_14" => $name, "sub_id_15" => $phone]));
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

    case 17:
        acepa($name, $phone, $subid, $country, $ip, $streamid, $offerid);
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_14" => $name, "sub_id_15" => $phone]));
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

    case 18:
        omni($name, $phone, $subid, $ip, $country, $streamid, $offerid);
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_14" => $name, "sub_id_15" => $phone]));
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

    default:
        file_get_contents("http://127.0.0.1/$kt/postback?" . http_build_query(["subid" => $subid, "status" => "lead", "sub_id_14" => $name, "sub_id_15" => $phone]));
        header("Location: thankyou.php?p=" . $_POST['p']);
        echo "<script>window.location.href = 'thankyou.php?p=".$_POST['p']."';</script>";
        break;

}