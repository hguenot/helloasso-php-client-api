# fr\helloasso\v5\CheckoutIntentsManagementApi

All URIs are relative to *https://api.helloasso.com/v5*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getCheckoutIntent**](CheckoutIntentsManagementApi.md#getCheckoutIntent) | **GET** /organizations/{organizationSlug}/checkout-intents/{checkoutIntentId} | Retrieve a checkout intent, with the order if the payment has been authorized.
[**postInitCheckout**](CheckoutIntentsManagementApi.md#postInitCheckout) | **POST** /organizations/{organizationSlug}/checkout-intents | Init a checkout.


# **getCheckoutIntent**
> \fr\helloasso\v5\model\CartsCheckoutIntentResponse getCheckoutIntent($organization_slug, $checkout_intent_id, $authorization)

Retrieve a checkout intent, with the order if the payment has been authorized.

<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> Checkout<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\CheckoutIntentsManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_slug = "organization_slug_example"; // string | 
$checkout_intent_id = 56; // int | 
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getCheckoutIntent($organization_slug, $checkout_intent_id, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckoutIntentsManagementApi->getCheckoutIntent: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_slug** | **string**|  |
 **checkout_intent_id** | **int**|  |
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\CartsCheckoutIntentResponse**](../Model/CartsCheckoutIntentResponse.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **postInitCheckout**
> \fr\helloasso\v5\model\CartsInitCheckoutResponse postInitCheckout($organization_slug, $body, $authorization)

Init a checkout.

<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> Checkout<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\CheckoutIntentsManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_slug = "organization_slug_example"; // string | 
$body = new \fr\helloasso\v5\model\CartsInitCheckoutBody(); // \fr\helloasso\v5\model\CartsInitCheckoutBody | 
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->postInitCheckout($organization_slug, $body, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckoutIntentsManagementApi->postInitCheckout: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_slug** | **string**|  |
 **body** | [**\fr\helloasso\v5\model\CartsInitCheckoutBody**](../Model/CartsInitCheckoutBody.md)|  |
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\CartsInitCheckoutResponse**](../Model/CartsInitCheckoutResponse.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: application/json, text/json
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

