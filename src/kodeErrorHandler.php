<?php

/**
 * @Author      Mark Anthony Jones
 * @Email       Mark@bmkdigital.co.uk
 * @Tel         (0)151 601 4021
 * @Date        02/12/15
 * @Time        15:37
 * @File        KodeAffiliatesTaxonomy.php
 * @Company     BMKDigital
 * @Version     1.0.0
 * @Notes       ...
 */
class kodeHandelError
{
 function __construct()
 {

 }

 function writeToLog($logData)
 {

  date_default_timezone_set('UTC');


  $file = __DIR__ . '/kodeError.log';
  if (!file_exists($file)) {
   $myfile = fopen($file, "w");
   fclose($myfile);
  }

  if (file_exists($file)) {
   $current = file_get_contents($file);
   $current .= date('l jS \of F Y h:i:s A') . " : " . $logData . "\n";
   file_put_contents($file, $current);
  }


  /*
  * Now Write To the Remote Server
  */


  $baseUrl = "http://error.kodedigital.co.uk/?publicKey=YXNkZmFzZHQ1NDZ0d2M0NWN0cmRn";
  $blockMessage = urlencode('Kode Portfolio');
  $baseUrl .= "&block=".$blockMessage;
  $logData = urlencode($logData);
  $baseUrl .= "&message=".$logData;
  $curl = curl_init();
  curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $baseUrl,
      CURLOPT_USERAGENT => 'Codular Sample cURL Request'
  ));
  curl_setopt($curl, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);
  $resp = curl_exec($curl);
  curl_close($curl);


 }
}