# fr\helloasso\v5\PartnerManagementApi

All URIs are relative to *https://api.helloasso.com/v5*

Method | HTTP request | Description
------------- | ------------- | -------------
[**deletePartnerOrganizationUrlNotification**](PartnerManagementApi.md#deletePartnerOrganizationUrlNotification) | **DELETE** /partners/me/api-notifications/organizations/{organizationSlug} | A partner can delete a notification url linked to an organization
[**deletePartnerUrlNotification**](PartnerManagementApi.md#deletePartnerUrlNotification) | **DELETE** /partners/me/api-notifications | A partner can delete his main notification url
[**getOrganizations**](PartnerManagementApi.md#getOrganizations) | **GET** /partners/me/organizations | Get all organization by partner
[**getPartner**](PartnerManagementApi.md#getPartner) | **GET** /partners/me | A partner can retrieve his information
[**putPartnerDomain**](PartnerManagementApi.md#putPartnerDomain) | **PUT** /partners/me/api-clients | A partner can update his domain
[**putPartnerOrganizationUrlNotification**](PartnerManagementApi.md#putPartnerOrganizationUrlNotification) | **PUT** /partners/me/api-notifications/organizations/{organizationSlug} | A partner can update a notification url linked to an organization
[**putPartnerUrlNotification**](PartnerManagementApi.md#putPartnerUrlNotification) | **PUT** /partners/me/api-notifications | A partner can update his main notification url


# **deletePartnerOrganizationUrlNotification**
> deletePartnerOrganizationUrlNotification($organization_slug, $authorization)

A partner can delete a notification url linked to an organization

<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessPublicData<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\PartnerManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_slug = "organization_slug_example"; // string | 
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $apiInstance->deletePartnerOrganizationUrlNotification($organization_slug, $authorization);
} catch (Exception $e) {
    echo 'Exception when calling PartnerManagementApi->deletePartnerOrganizationUrlNotification: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_slug** | **string**|  |
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

void (empty response body)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deletePartnerUrlNotification**
> deletePartnerUrlNotification($authorization)

A partner can delete his main notification url

<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessPublicData<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\PartnerManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $apiInstance->deletePartnerUrlNotification($authorization);
} catch (Exception $e) {
    echo 'Exception when calling PartnerManagementApi->deletePartnerUrlNotification: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

void (empty response body)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getOrganizations**
> \fr\helloasso\v5\model\CommonResultsWithPaginationModelOfDirectoryPartnerOrganizationModel getOrganizations($page_size, $continuation_token, $authorization)

Get all organization by partner

List all organization linked to partner.  Results are ordered by Api visibility update date ascending.  The total number of results (or pages) isn't retrievable, so the pagination information returned will always say -1.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessPublicData<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\PartnerManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page_size = 20; // int | The number of items per page
$continuation_token = "continuation_token_example"; // string | Continuation Token from which we wish to retrieve results
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getOrganizations($page_size, $continuation_token, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PartnerManagementApi->getOrganizations: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page_size** | **int**| The number of items per page | [optional] [default to 20]
 **continuation_token** | **string**| Continuation Token from which we wish to retrieve results | [optional]
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\CommonResultsWithPaginationModelOfDirectoryPartnerOrganizationModel**](../Model/CommonResultsWithPaginationModelOfDirectoryPartnerOrganizationModel.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getPartner**
> \fr\helloasso\v5\model\PartnersPartnerPublicModel getPartner($authorization)

A partner can retrieve his information

<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessPublicData<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\PartnerManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getPartner($authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PartnerManagementApi->getPartner: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\PartnersPartnerPublicModel**](../Model/PartnersPartnerPublicModel.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **putPartnerDomain**
> putPartnerDomain($body, $authorization)

A partner can update his domain

<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessPublicData<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\PartnerManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \fr\helloasso\v5\model\AccountsClientsPublicPutApiClientRequest(); // \fr\helloasso\v5\model\AccountsClientsPublicPutApiClientRequest | 
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $apiInstance->putPartnerDomain($body, $authorization);
} catch (Exception $e) {
    echo 'Exception when calling PartnerManagementApi->putPartnerDomain: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\fr\helloasso\v5\model\AccountsClientsPublicPutApiClientRequest**](../Model/AccountsClientsPublicPutApiClientRequest.md)|  |
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

void (empty response body)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: application/json, text/json
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **putPartnerOrganizationUrlNotification**
> putPartnerOrganizationUrlNotification($body, $organization_slug, $authorization)

A partner can update a notification url linked to an organization

<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessPublicData<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\PartnerManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \fr\helloasso\v5\model\ApiNotificationsPostApiUrlNotificationBody(); // \fr\helloasso\v5\model\ApiNotificationsPostApiUrlNotificationBody | 
$organization_slug = "organization_slug_example"; // string | 
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $apiInstance->putPartnerOrganizationUrlNotification($body, $organization_slug, $authorization);
} catch (Exception $e) {
    echo 'Exception when calling PartnerManagementApi->putPartnerOrganizationUrlNotification: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\fr\helloasso\v5\model\ApiNotificationsPostApiUrlNotificationBody**](../Model/ApiNotificationsPostApiUrlNotificationBody.md)|  |
 **organization_slug** | **string**|  |
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

void (empty response body)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: application/json, text/json
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **putPartnerUrlNotification**
> putPartnerUrlNotification($body, $authorization)

A partner can update his main notification url

<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessPublicData<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\PartnerManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \fr\helloasso\v5\model\ApiNotificationsPostApiUrlNotificationBody(); // \fr\helloasso\v5\model\ApiNotificationsPostApiUrlNotificationBody | 
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $apiInstance->putPartnerUrlNotification($body, $authorization);
} catch (Exception $e) {
    echo 'Exception when calling PartnerManagementApi->putPartnerUrlNotification: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\fr\helloasso\v5\model\ApiNotificationsPostApiUrlNotificationBody**](../Model/ApiNotificationsPostApiUrlNotificationBody.md)|  |
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

void (empty response body)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: application/json, text/json
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

