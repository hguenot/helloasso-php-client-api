# fr\helloasso\v5\DirectoryApi

All URIs are relative to *https://api.helloasso.com/v5*

Method | HTTP request | Description
------------- | ------------- | -------------
[**postFormsListRequest**](DirectoryApi.md#postFormsListRequest) | **POST** /directory/forms | Get all forms by form filters and organization filters
[**postOrganizationsListRequest**](DirectoryApi.md#postOrganizationsListRequest) | **POST** /directory/organizations | Get all organization by organization filters


# **postFormsListRequest**
> \fr\helloasso\v5\model\CommonResultsWithPaginationModelOfDirectorySynchronizableFormModel postFormsListRequest($body, $page_size, $continuation_token, $authorization)

Get all forms by form filters and organization filters

Allows you to retrieve a list of all forms visible (only) matching all the filters in the directory until it is synchronized (using the continuationToken).  If filters are left empty, no filter is applied.  Results are ordered by Api visibility update date ascending.  Once the list is synchronized, only forms with an Api visibility update date greater than the last form sent are returned (still using the continuationToken).  This concerns the new forms to be inserted (wishing to appear in the directory) as well as the old ones to be deleted (no longer wishing to appear in the directory).  The total number of results (or pages) isn't retrievable, so the pagination information returned will always say -1.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> FormOpenDirectory<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\DirectoryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \fr\helloasso\v5\model\DirectoryListFormsRequest(); // \fr\helloasso\v5\model\DirectoryListFormsRequest | Body which contains the filters to apply
$page_size = 20; // int | The number of items per page
$continuation_token = "continuation_token_example"; // string | Continuation Token from which we wish to retrieve results
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->postFormsListRequest($body, $page_size, $continuation_token, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DirectoryApi->postFormsListRequest: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\fr\helloasso\v5\model\DirectoryListFormsRequest**](../Model/DirectoryListFormsRequest.md)| Body which contains the filters to apply |
 **page_size** | **int**| The number of items per page | [optional] [default to 20]
 **continuation_token** | **string**| Continuation Token from which we wish to retrieve results | [optional]
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\CommonResultsWithPaginationModelOfDirectorySynchronizableFormModel**](../Model/CommonResultsWithPaginationModelOfDirectorySynchronizableFormModel.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: application/json, text/json
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **postOrganizationsListRequest**
> \fr\helloasso\v5\model\CommonResultsWithPaginationModelOfDirectorySynchronizableOrganizationModel postOrganizationsListRequest($body, $page_size, $continuation_token, $authorization)

Get all organization by organization filters

Allows you to retrieve a list of all organizations visible (only) matching all the filters in the directory until it is synchronized (using the continuationToken).  If filters are left empty, no filter is applied.  Results are ordered by Api visibility update date ascending.  Once the list is synchronized, only organizations with an Api visibility update date greater than the last organization sent are returned (still using the continuationToken).  This concerns the new organizations to be inserted (wishing to appear in the directory) as well as the old ones to be deleted (no longer wishing to appear in the directory).  The total number of results (or pages) isn't retrievable, so the pagination information returned will always say -1.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> OrganizationOpenDirectory<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\DirectoryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \fr\helloasso\v5\model\DirectoryListOrganizationsRequest(); // \fr\helloasso\v5\model\DirectoryListOrganizationsRequest | Body which contains the filters to apply
$page_size = 20; // int | The number of items per page
$continuation_token = "continuation_token_example"; // string | Continuation Token from which we wish to retrieve results
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->postOrganizationsListRequest($body, $page_size, $continuation_token, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DirectoryApi->postOrganizationsListRequest: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\fr\helloasso\v5\model\DirectoryListOrganizationsRequest**](../Model/DirectoryListOrganizationsRequest.md)| Body which contains the filters to apply |
 **page_size** | **int**| The number of items per page | [optional] [default to 20]
 **continuation_token** | **string**| Continuation Token from which we wish to retrieve results | [optional]
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\CommonResultsWithPaginationModelOfDirectorySynchronizableOrganizationModel**](../Model/CommonResultsWithPaginationModelOfDirectorySynchronizableOrganizationModel.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: application/json, text/json
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

