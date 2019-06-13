<?php
// This file holds all the settings related to API.
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Define variables that holds API settings and urls.
//Get the user credential for the account and change the user credentials
define("USERNAME", "shaijulkarWeb");
define("PASSWORD", "Deepika@webhungers123"); //pvc
define("GRANT_TYPE","password");


define("BASE_URL","https://api.paytrace.com"); //Production

//API version
define("API_VERSION", "/v1");

// Url for OAuth Token 
define("URL_OAUTH",BASE_URL."/oauth/token");

// URL for Keyed Sale
define("URL_KEYED_SALE",BASE_URL.API_VERSION."/transactions/sale/keyed");

// URL for Swiped Sale
define("URL_SWIPED_SALE" , BASE_URL.API_VERSION."/transactions/sale/swiped");
		
// URL for Keyed Authorization
define("URL_KEYED_AUTHORIZATION" ,BASE_URL.API_VERSION."/transactions/authorization/keyed");

// URL for Keyed Refund
define("URL_KEYED_REFUND" , BASE_URL.API_VERSION."/transactions/refund/keyed");

// URL for Capture Transaction
define("URL_CAPTURE", BASE_URL.API_VERSION."/transactions/authorization/capture");

// URL for Void Sale Transaction
define("URL_VOID_TRANSACTION", BASE_URL. API_VERSION."/transactions/void");

// URL for Create Customer(PayTrace Vault) Method
define("URL_CREATE_CUSTOMER", BASE_URL.API_VERSION."/customer/create");
		
// URL for Vault Sale by CustomerId Method
define("URL_VAULT_SALE_BY_CUSTOMER_ID", BASE_URL.API_VERSION."/transactions/sale/by_customer");

//URL for API Method
define("PING_URL",BASE_URL.API_VERSION."/ping"); 

