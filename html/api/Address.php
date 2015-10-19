<?php

/* SERVICE OBJECTS, INC.
 * DOTS Address Validation 3
 * Language: PHP 5 using ReST
 * Operation: DPVAddressInfo
 * Note: The code being suggested in this file provides one possible solution using this particular service. There are
 *  many other possible solutions to using this service which may fit a particular problem .
 *  Please contact support@serviceobjects.com for more information
 *
 * Last Modified:   8/12/2013
 *
 * Created By: S. Alon
 *
 * Note: SSL configuration has been turned off throughout the rest php samplecodes.
 *       To turn SSL back on change 'curl_setopt($curl2, CURLOPT_SSL_VERIFYPEER, false)' to true
 *		 and add a certification agreement (example:
 *		 curl_setopt($curl2, CURLOPT_SSL_VERIFYHOST, 2);
 *		 curl_setopt($curl2, CURLOPT_CAINFO, getcwd() . <YourCert.crt> );)
 *
 *
 *
 *
 * WEBSITE
 * http://www.serviceobjects.com
 *
 * PRODUCT PAGE
 * http://www.serviceobjects.com/products/address-geocoding/address-validation-us
 *
 * DEVELOPER PAGE
 * https://docs.serviceobjects.com/display/devguide/DOTS+Address+Validation+3+-+US
 *
 * FREE TRIAL
 * http://www.serviceobjects.com/dots-key?wsid=72
 *
 * SUPPORT EMAIL
 * support@serviceobjects.com
 *
 *
 * THIS CODE AND INFORMATION IS PROVIDED "AS IS" WITHOUT WARRANTY
 * OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT
 * LIMITED TO THE IMPLIED WARRANTIES OF MERCHANTIBILITY AND/OR
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 * */

class Address {
  private $apiUrl = 'https://trial.serviceobjects.com/av3/api.svc/DPVAddressInfo/';
  private $licenseKey = '';

  public function __construct($licenseKey) {
      $this->licenseKey = $licenseKey;
  }

  public function checkAddress($address1, $address2, $city, $state, $zip) {

    global $decoded;
    $TIMEOUT = 5000;

    // variable cleanup before generating url
    $address 		= trim($address1);
    $address2 		= trim($address2);
    if($address2 == ''){
      $address2 = ' ';
    }
    $city 			= trim($city);
    $state			= trim($state);
    $zip 	= trim($zip);
    $licenseKey 	= $this->licenseKey;

    //Ensure Valid Inputs
    // Missing parameters are not allowed
    if($address 	== ''){
      $address 	= " ";
    }
    if($address2 	== ''){
      $address2 	= " ";
    }
    if($city 		== ''){
      $city 		= " ";
    }
    if($state		== ''){
      $state 		= " ";
    }
    if($zip 	== ''){
      $zip 	= " ";
    }
    if($licenseKey 	== ''){
      $licenseKey 	= "missingLicenseKey";
    }

    /*
    * Due to RFC compliance, the use of URL Paths has character limitations.
    * Certain characters are invalid and cause HTTP Errors; these characters
    * include #, /, ?,\ as well as some high bit characters.
    *
    * If you suspect that this may be an issue for you then it is recommended to change your
    * request from the URL path parameter format to the query string parameter format.
    * Example:
    *	FROM {data}/{data2}/{key}?format=json
    *	TO parameter1={data1}&parameter2={data2}&licensekey={key}
    * Another alternative is to use HTTP Post instead of HTTP Get.
    */

    $URL = "https://trial.serviceobjects.com/av3/api.svc/GetBestMatchesJson/SFWP/".rawurlencode($address)."/".rawurlencode($address2)."/".rawurlencode($city)."/".rawurlencode($state)."/".rawurlencode($zip)."/".rawurlencode($licenseKey)."?format=json";
    // Get cURL resource
    $curl = curl_init();
    curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => $URL, CURLOPT_USERAGENT => 'Service Objects Address Validation 3'));
    //Https peer certification validation turned off
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT_MS, $TIMEOUT); //timeout in milliseconds
    // Send the request & save response to $resp
    $resp = curl_exec($curl);
    $status = curl_getinfo($curl);
    $decoded = json_decode($resp, TRUE);

    //Close request to clear up some resources
    curl_close($curl);
    $gotValidInput = true;
    try {
      $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($decoded), RecursiveIteratorIterator::SELF_FIRST);
    } catch (Exception $e) {
      echo "$e";
      $gotValidInput = false;
    }
    $correctedAddress = array();

    if($gotValidInput) {
      foreach ($jsonIterator as $key => $val) {
        if($key == 'Address1') {
          $correctedAddress['address1'] = $val;
        }
        if($key == 'Address2') {
          $correctedAddress['address2'] = $val;
        }
        if($key == 'City') {
          $correctedAddress['city'] = $val;
        }
        if($key == 'State') {
          $correctedAddress['state'] = $val;
        }
        if($key == 'Zip') {
          $correctedAddress['zip'] = $val;
        }
      }
    }
    return $correctedAddress;
  }
}