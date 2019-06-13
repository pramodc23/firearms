<?php
include 'PhpApiSettings.php';
include 'Utilities.php';
include 'Json.php';

$user_data = $this->user_data1;
//print_r($user_data);
 
//call a function of Utilities.php to generate oAuth token 
//This sample code doesn't use any 0Auth Library
$oauth_result = oAuthTokenGenerator();

//call a function of Utilities.php to verify if there is any error with OAuth token. 
$oauth_moveforward = isFoundOAuthTokenError($oauth_result);

//If IsFoundOAuthTokenError results True, means no error 
//next is to move forward for the actual request 

if(!$oauth_moveforward){
    //Decode the Raw Json response.
    $json = jsonDecode($oauth_result['temp_json_response']); 
    
    //set Authentication value based on the successful oAuth response.
    //Add a space between 'Bearer' and access _token 
    $oauth_token = sprintf("Bearer %s",$json['access_token']);
 
    // Build the transaction 
    $result = buildTransaction($oauth_token,$user_data);  
    $this->user_data1["res"] = $result;
  //  print_r($result);
}
//end of main script

function buildTransaction($oauth_token,$user_data){
    // Build the request data
    $request_data = buildRequestData($user_data);
    
    //call to make the actual request
    $result = processTransaction($oauth_token,$request_data, URL_KEYED_SALE );
    
    /*echo "<br>json_response : " . $result['json_response'];
    echo "<BR>curl_error : ".$result['curl_error'];
    echo "<br>http_status_code :".  $result['http_status_code'];
    */
    //check the result
    return verifyTransactionResult($result);
}


function buildRequestData($user_data){
   //you can assign the values from any input source fields instead of hard coded values.
/*    $request_data = array(
                    "amount" => "2.50",
                    "credit_card"=> array (
                         "number"=> "4111111111111111",
                         "expiration_month"=> "12",
                         "expiration_year"=> "2020"),
                    "csc"=> "999",
                    "billing_address"=> array(
                        "name"=> "Mark Smith",
                        "street_address"=> "8320 E. West St.",
                        "city"=> "Spokane",
                        "state"=> "WA",
                        "zip"=> "85284")
                    );*/
    
    $request_data = json_encode($user_data);
   
    //optional : Display the Jason response - this may be helpful during initial testing.
    //displayRawJsonRequest($request_data);
   
    return $request_data ;  
}

//This function is to verify the Transaction result 
function verifyTransactionResult($trans_result){      

//Handle curl level error, ExitOnCurlError
if($trans_result['curl_error'] ){
    echo "<br>Error occcured : ";
    echo '<br>curl error with Transaction request: ' . $trans_result['curl_error'] ;
    exit();  
}

//If we reach here, we have been able to communicate with the service, 
//next is decode the json response and then review Http Status code, response_code and success of the response

$json = jsonDecode($trans_result['temp_json_response']);  

if($trans_result['http_status_code'] != 200){
    if($json['success'] === false){
        //echo "<br><br>Transaction Error occurred : "; 
        $result_res = array("temp_json_response" => $trans_result['temp_json_response'],"http_status_code" => $trans_result['http_status_code']);
        return $result_res;
        
        //$this->user_data["http_status_code"] = $trans_result['http_status_code'];
        //Optional : display Http status code and message
        //displayHttpStatus($trans_result['http_status_code']);
        
        //Optional :to display raw json response
        //displayRawJsonResponse($trans_result['temp_json_response']);
       
        //echo "<br>Keyed sale :  failed !";
        //to display individual keys of unsuccessful Transaction Json response
        //displayKeyedTransactionError($json) ;
    }
    else {
        $result_res = array("temp_json_response" => $trans_result['temp_json_response'],"http_status_code" => $trans_result['http_status_code']);
        return $result_res;
        //In case of some other error occurred, next is to just utilize the http code and message.
        //echo "<br><br> Request Error occurred !" ;
        //displayHttpStatus($trans_result['http_status_code']);
    }
}
else
{
    // Optional : to display raw json response - this may be helpful with initial testing.
    //displayRawJsonResponse($trans_result['temp_json_response']);
   
    // Do your code when Response is available and based on the response_code. 
    // Please refer PayTrace-Error page for possible errors and Response Codes
    
    // For transation successfully approved 
    if($json['success']== true && $json['response_code'] == 101){
        $result_res = array("temp_json_response" => $trans_result['temp_json_response'],"http_status_code" => $trans_result['http_status_code']);
        return $result_res;
        //echo "<br><br>Keyed sale :  Success !";
        //displayHttpStatus($trans_result['http_status_code']);
        //to display individual keys of successful OAuth Json response 
        //displayKeyedTransactionResponse($trans_result['temp_json_response']);  

        //print_r($trans_result['temp_json_response']); 
   }
   else{
        //Do you code here for any additional verification such as - Avs-response and CSC_response as needed.
        //Please refer PayTrace-Error page for possible errors and Response Codes
        //success = true and response_code == 103 approved but voided because of CSC did not match.
   }
}
  
}


//This function displays keyed transaction successful response.
function displayKeyedTransactionResponse($post_fields){
    $ch = curl_init();
    $url = 'http://webhungers.com/firearms-new-dev/paytraces/transaction_details';
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.0; en; rv:1.8.0.4) Gecko/20060508 Firefox/1.5.0.4");
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
               array('Content-Type:application/json',
                      'Content-Length: ' . strlen($post_fields))
               );
        if ($post_fields != "") 
        {
            if (is_array($post_fields)) 
            {
                $post_fields = implode("&", $post_fields);
            }
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        }

        //file_put_contents("Bookingdotcom.log", $post_fields, FILE_APPEND);
        $result = curl_exec($ch);
        $err = curl_error($ch);

        $results["messages"] = $result;
        $results["errors"] = $err;
        curl_close($ch);
        
    //optional : Display the output
   
    //echo "<br><br> Keyed Sale Response : ";
    //since php interprets boolean value as 1 for true and 0 for false when accessed.
    /*echo "<br>success : ";
    echo $json_string['success'] ? 'true' : 'false';  
    echo "<br>response_code : ".$json_string['response_code'] ; 
    echo "<br>status_message : ".$json_string['status_message'] ; 
    echo "<br>transaction_id : ".$json_string['transaction_id'] ;  
    echo "<br>approval_code : ".$json_string['approval_code'] ;
    echo "<br>approval_message : ".$json_string['approval_message'] ;
    echo "<br>avs_response : ".$json_string['avs_response'] ;
    echo "<br>csc_response : ".$json_string['csc_response'] ; 
    echo "<br>external_transaction_id: ".$json_string['external_transaction_id'] ;
    echo "<br>masked_card_number : ".$json_string['masked_card_number'] ;    */   

}


//This function displays keyed transaction error response.
function displayKeyedTransactionError($json_string){
    //optional : Display the output
    echo "<br><br> Keyed Sale Response : ";
    //since php interprets boolean value as 1 for true and 0 for false when accessed.
    echo "<br>success : ";
    echo $json_string['success'] ? 'true' : 'false';  
    echo "<br>response_code : ".$json_string['response_code'] ; 
    echo "<br>status_message : ".$json_string['status_message'] ;  
    echo "<br>external_transaction_id: ".$json_string['external_transaction_id'] ;
    echo "<br>masked_card_number : ".$json_string['masked_card_number'] ;  
   
    //to check the actual API errors and get the individual error keys 
    echo "<br>API Errors : " ;
   
    foreach($json_string['errors'] as $error =>$no_of_errors )
    {
        //Do you code here as an action based on the particular error number 
        //you can access the error key with $error in the loop as shown below.
        echo "<br>". $error;
        // to access the error message in array assosicated with each key.
        foreach($no_of_errors as $item)
        {
           //Optional - error message with each individual error key.
            echo "  " . $item ; 
        } 
    }
    
     
}


?>
    
</body>
</html>