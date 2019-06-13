<?php
include 'PhpApiSettings.php';
include 'Utilities.php';
include 'Json.php';
  
$oauth_result = oAuthTokenGenerator();
$oauth_moveforward = isFoundOAuthTokenError($oauth_result);

if(!$oauth_moveforward){
    //Decode the Raw Json response.
    $json = jsonDecode($oauth_result['temp_json_response']); 
    
    //set Authentication value based on the successful oAuth response.
    //Add a space between 'Bearer' and access _token 
    $oauth_token = sprintf("Bearer %s",$json['access_token']);
 
    // Build the transaction 
    buildTransaction($oauth_token);  
    
} 

function buildTransaction($oauth_token){
    
    $result2 = processTransaction($oauth_token,array(), BASE_URL.API_VERSION.'/transactions/settle' );

    print_r($result2);
     
}

function refund(){
    
}
?>
    
