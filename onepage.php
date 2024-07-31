<?php

global $dir_name, $offers, $offer;
$dir_name = dirname(__FILE__);
require_once( $dir_name .'/config.php');

$offers = json_decode($dataOffers, true);
$offer = json_decode($dataOffer, true);

$newPrice = 147;
$oldPrice = 294;
$currencyDisplay = 'ZŁ';

require($dir_name . '/app.php');

$dbg_mod = is_debug($_debug, True);

$ip_address = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);
if ( $is_geo_detect ) {
    $offer = get_offer_by_ip($ip_address, $offers, $offer);
}

$countryDetect = $offer['country']['code'];
$currencyDisplay = $offer['currency']['name'];
$newPrice = $offer['price'];
$oldPrice = $offer['price2'];


$utm = [
    "utm_source" => '',
    "utm_medium" => '',
    "utm_campaign" => '',
    "utm_content" => '',
    "utm_term" => '',

    "sub1" => '',
    "sub2" => '',
    "sub3" => '',
    "sub4" => '',
    "sub5" => '',

    'fb_pixel' => '',
    'fb_verify' => '',
    'ya_pixel' => '',
    'tiktok_pixel' => '',
    'mail_pixel' => '',
    'google_pixel' => '',
    'google_adw_pixel' => '',
    'vk_pixel' => '',
    'topmail_pixel' => '',
    'bigo_pixel' => '',

    'formFields' => '',
];
$data_get = $_GET;
if (isset($formFields)) {
    $data_get['formFields'] = urlencode(json_encode($formFields));
}
foreach($utm as $key => $val) {
    $utm[$key] = clear_value(array_get($data_get, $key));
}

$utm['topmail_pixel'] = !empty($utm['topmail_pixel']) ? $utm['topmail_pixel'] : $utm['mail_pixel'];

$GLOBALS['utm'] = $utm;

$newPriceHtml = '<x-newprice>' . $newPrice . '</x-newprice>';
$oldPriceHtml = '<x-oldprice>' . $oldPrice. '</x-oldprice>';
$currencyDisplayHtml = '<x-currency>'. $currencyDisplay .'</x-currency>';

$newPrice = $newPriceHtml;
$oldPrice = $oldPriceHtml;

$file_translate = __DIR__.'/invoice2/languages/'. $language . '.php';
if (!file_exists($file_translate)) {
    $file_translate = __DIR__.'/invoice2/languages/ru.php';
}
require_once($file_translate);

$renderCallback = new BeforeRenderCallback([], getcwd());

$render_context = ['pixels' => $pixels, 'fb_verify' => $fb_verification];

$js_injector = new JsInjector($data_get, $render_context);
$renderCallback->addCallback($js_injector);

if (!checkPluginsConflict($plugins) && isPluginsExist($plugins)) {
    $pluginPrices = [
        'newPrice' => $offer['price'],
        'oldPrice' => $offer['price2'],
        'promoPrice'=> get_promo_price($offer['price'], $offer['price2']),
        'currency' => $currencyDisplay,
        'client_city' => '',
    ];
    injectPlugins($renderCallback, $plugins, $pluginPrices);
}

ob_start();

register_shutdown_function(function() use($renderCallback) {
    $renderCallback->prepare();
    $content = $renderCallback(ob_get_clean(), 0);
    echo $content;
});

$data_get = $_GET;
