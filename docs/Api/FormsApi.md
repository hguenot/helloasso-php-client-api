# fr\helloasso\v5\FormsApi

All URIs are relative to *https://api.helloasso.com/v5*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getFormListByOrganization**](FormsApi.md#getFormListByOrganization) | **GET** /organizations/{organizationSlug}/forms | Get the forms of a specific organization
[**getFormPublic**](FormsApi.md#getFormPublic) | **GET** /organizations/{organizationSlug}/forms/{formType}/{formSlug}/public | Get detailed public data about a specific form
[**getFormTypesList**](FormsApi.md#getFormTypesList) | **GET** /organizations/{organizationSlug}/formTypes | Get a list of formTypes for an organization
[**postQuickCreateEvent**](FormsApi.md#postQuickCreateEvent) | **POST** /organizations/{organizationSlug}/forms/{formType}/action/quick-create | Create a simplified event for an Organism


# **getFormListByOrganization**
> \fr\helloasso\v5\model\CommonResultsWithPaginationModelOfFormsFormLightModel getFormListByOrganization($organization_slug, $states, $form_types, $page_index, $page_size, $continuation_token, $authorization)

Get the forms of a specific organization

List all forms matching the filtered states and types.  If filters are left empty, no filter is applied.  Results are ordered by creation date descending.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessPublicData<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\FormsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_slug = "organization_slug_example"; // string | The organization Slug
$states = array(new \stdClass); // object[] | States to filter
$form_types = array(new \stdClass); // object[] | Types to filter
$page_index = 1; // int | The page of results to retrieve
$page_size = 20; // int | The number of items per page
$continuation_token = "continuation_token_example"; // string | Continuation Token from which we wish to retrieve results
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getFormListByOrganization($organization_slug, $states, $form_types, $page_index, $page_size, $continuation_token, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FormsApi->getFormListByOrganization: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_slug** | **string**| The organization Slug |
 **states** | [**object[]**](../Model/object.md)| States to filter | [optional]
 **form_types** | [**object[]**](../Model/object.md)| Types to filter | [optional]
 **page_index** | **int**| The page of results to retrieve | [optional] [default to 1]
 **page_size** | **int**| The number of items per page | [optional] [default to 20]
 **continuation_token** | **string**| Continuation Token from which we wish to retrieve results | [optional]
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\CommonResultsWithPaginationModelOfFormsFormLightModel**](../Model/CommonResultsWithPaginationModelOfFormsFormLightModel.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getFormPublic**
> \fr\helloasso\v5\model\FormsFormPublicModel getFormPublic($organization_slug, $form_type, $form_slug, $authorization)

Get detailed public data about a specific form

This api allows you to retrieve all public information of a form whether it is Crowdfunding, Membership, Event, Donation...<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessPublicData<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\FormsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_slug = "organization_slug_example"; // string | 
$form_type = "form_type_example"; // string | 
$form_slug = "form_slug_example"; // string | 
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getFormPublic($organization_slug, $form_type, $form_slug, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FormsApi->getFormPublic: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_slug** | **string**|  |
 **form_type** | **string**|  |
 **form_slug** | **string**|  |
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\FormsFormPublicModel**](../Model/FormsFormPublicModel.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getFormTypesList**
> \fr\helloasso\v5\model\EnumsFormType[] getFormTypesList($organization_slug, $states, $authorization)

Get a list of formTypes for an organization

List all the formTypes where the organization has at least one form. This also can be filtered by states.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessPublicData<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\FormsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_slug = "organization_slug_example"; // string | The organization Slug
$states = array(new \stdClass); // object[] | List of Form States to filter with. If none specified, it won't filter results.
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getFormTypesList($organization_slug, $states, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FormsApi->getFormTypesList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_slug** | **string**| The organization Slug |
 **states** | [**object[]**](../Model/object.md)| List of Form States to filter with. If none specified, it won&#39;t filter results. | [optional]
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\EnumsFormType[]**](../Model/EnumsFormType.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **postQuickCreateEvent**
> \fr\helloasso\v5\model\FormsFormQuickCreateModel postQuickCreateEvent($organization_slug, $form_type, $body, $authorization)

Create a simplified event for an Organism

This is a limited service to create an event with only limited information and few simple pricing.  Event created this way can be further edited with other services<br/><br/><b>Your token must have one of these roles : </b><br/>OrganizationAdmin<br/><br/>If you are an <b>association</b>, you can obtain these roles with your client.<br/>If you are a <b>partner</b>, you can obtain these roles by the authorize flow.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> FormAdministration<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\FormsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_slug = "organization_slug_example"; // string | The organization Slug
$form_type = "form_type_example"; // string | The form type to create - only Event type is supported
$body = new \fr\helloasso\v5\model\FormsFormQuickCreateRequest(); // \fr\helloasso\v5\model\FormsFormQuickCreateRequest | The body of the request.
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->postQuickCreateEvent($organization_slug, $form_type, $body, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FormsApi->postQuickCreateEvent: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_slug** | **string**| The organization Slug |
 **form_type** | **string**| The form type to create - only Event type is supported |
 **body** | [**\fr\helloasso\v5\model\FormsFormQuickCreateRequest**](../Model/FormsFormQuickCreateRequest.md)| The body of the request. |
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\FormsFormQuickCreateModel**](../Model/FormsFormQuickCreateModel.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: application/json, text/json
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

