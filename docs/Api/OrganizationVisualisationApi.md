# fr\helloasso\v5\OrganizationVisualisationApi

All URIs are relative to *https://api.helloasso.com/v5*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getOrganization**](OrganizationVisualisationApi.md#getOrganization) | **GET** /organizations/{organizationSlug} | Get Organization details


# **getOrganization**
> \fr\helloasso\v5\model\OrganizationOrganizationModel getOrganization($organization_slug, $authorization)

Get Organization details

Get the public information of the specified organization.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessPublicData<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\OrganizationVisualisationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_slug = "organization_slug_example"; // string | The organization Slug
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getOrganization($organization_slug, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationVisualisationApi->getOrganization: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_slug** | **string**| The organization Slug |
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\OrganizationOrganizationModel**](../Model/OrganizationOrganizationModel.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

