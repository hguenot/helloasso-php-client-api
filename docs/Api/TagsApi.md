# fr\helloasso\v5\TagsApi

All URIs are relative to *https://api.helloasso.com/v5*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getTag**](TagsApi.md#getTag) | **GET** /tags/{tagName} | Get Internal Tag Detail


# **getTag**
> \fr\helloasso\v5\model\TagsInternalTagModel getTag($tag_name, $with_count, $with_amount, $authorization)

Get Internal Tag Detail

<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> FormOpenDirectory<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\TagsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$tag_name = "tag_name_example"; // string | 
$with_count = false; // bool | If true : Count of times Tag is used
$with_amount = false; // bool | If true : Amount collected by all forms linked to this Tag
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getTag($tag_name, $with_count, $with_amount, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->getTag: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tag_name** | **string**|  |
 **with_count** | **bool**| If true : Count of times Tag is used | [optional] [default to false]
 **with_amount** | **bool**| If true : Amount collected by all forms linked to this Tag | [optional] [default to false]
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\TagsInternalTagModel**](../Model/TagsInternalTagModel.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

