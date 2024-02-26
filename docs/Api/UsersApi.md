# fr\helloasso\v5\UsersApi

All URIs are relative to *https://api.helloasso.com/v5*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getOrganizations**](UsersApi.md#getOrganizations) | **GET** /users/me/organizations | Get my organizations


# **getOrganizations**
> \fr\helloasso\v5\model\OrganizationOrganizationLightModel[] getOrganizations($authorization)

Get my organizations

Returns the list of organizations where the connected user has rights ( Form or Organization itself )<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessPublicData<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getOrganizations($authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->getOrganizations: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\OrganizationOrganizationLightModel[]**](../Model/OrganizationOrganizationLightModel.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

