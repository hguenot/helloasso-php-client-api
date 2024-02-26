# fr\helloasso\v5\OrdersItemsApi

All URIs are relative to *https://api.helloasso.com/v5*

Method | HTTP request | Description
------------- | ------------- | -------------
[**cancelOrder**](OrdersItemsApi.md#cancelOrder) | **POST** /orders/{orderId}/cancel | Cancels future payments for an order, no refunds will be given.
[**getFormItems**](OrdersItemsApi.md#getFormItems) | **GET** /organizations/{organizationSlug}/forms/{formType}/{formSlug}/items | Get a list of items \&quot;sold\&quot; in a form
[**getFormOrders**](OrdersItemsApi.md#getFormOrders) | **GET** /organizations/{organizationSlug}/forms/{formType}/{formSlug}/orders | Get form orders
[**getItem**](OrdersItemsApi.md#getItem) | **GET** /items/{itemId} | Get the detail of an item contained in an order
[**getOrder**](OrdersItemsApi.md#getOrder) | **GET** /orders/{orderId} | Get detailed information about a specific order
[**getOrganizationItems**](OrdersItemsApi.md#getOrganizationItems) | **GET** /organizations/{organizationSlug}/items | Get a list of items sold by an organization
[**getOrganizationOrders**](OrdersItemsApi.md#getOrganizationOrders) | **GET** /organizations/{organizationSlug}/orders | Get a list of orders within a specific organization


# **cancelOrder**
> object cancelOrder($order_id, $authorization)

Cancels future payments for an order, no refunds will be given.

<br/><br/><b>Your token must have one of these roles : </b><br/>OrganizationAdmin<br/>FormAdmin<br/><br/>If you are an <b>association</b>, you can obtain these roles with your client.<br/>If you are a <b>partner</b>, you can obtain these roles by the authorize flow.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> RefundManagement<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\OrdersItemsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$order_id = 56; // int | The order identifier.
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->cancelOrder($order_id, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersItemsApi->cancelOrder: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **order_id** | **int**| The order identifier. |
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

**object**

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getFormItems**
> \fr\helloasso\v5\model\CommonResultsWithPaginationModelOfStatisticsItem getFormItems($organization_slug, $form_slug, $form_type, $from, $to, $user_search_key, $page_index, $page_size, $continuation_token, $tier_types, $item_states, $tier_name, $with_details, $sort_order, $sort_field, $authorization)

Get a list of items \"sold\" in a form

<br/><br/><b>Your token must have one of these roles : </b><br/>FormAdmin<br/>OrganizationAdmin<br/><br/>If you are an <b>association</b>, you can obtain these roles with your client.<br/>If you are a <b>partner</b>, you can obtain these roles by the authorize flow.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessTransactions<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\OrdersItemsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_slug = "organization_slug_example"; // string | The organization slug
$form_slug = "form_slug_example"; // string | The form slug
$form_type = "form_type_example"; // string | The form type CrowdFunding, Membership, Event, Donation, PaymentForm, Checkout, Shop
$from = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | First Date Filter
$to = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | End Date Filter
$user_search_key = "user_search_key_example"; // string | Filter results on user or payer first name, last name or email
$page_index = 1; // int | The page of results to retrieve
$page_size = 20; // int | The number of items per page
$continuation_token = "continuation_token_example"; // string | Continuation Token from which we wish to retrieve results
$tier_types = array(new \stdClass); // object[] | The type of tiers
$item_states = array(new \stdClass); // object[] | The item states
$tier_name = "tier_name_example"; // string | The name of a tier
$with_details = false; // bool | Set to true to return CustomFields and Options
$sort_order = "Desc"; // string | Sort forms items by ascending or descending order. Default is descending
$sort_field = "Date"; // string | Sort forms items by a specific field (Date or UpdateDate). Default is date
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getFormItems($organization_slug, $form_slug, $form_type, $from, $to, $user_search_key, $page_index, $page_size, $continuation_token, $tier_types, $item_states, $tier_name, $with_details, $sort_order, $sort_field, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersItemsApi->getFormItems: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_slug** | **string**| The organization slug |
 **form_slug** | **string**| The form slug |
 **form_type** | **string**| The form type CrowdFunding, Membership, Event, Donation, PaymentForm, Checkout, Shop |
 **from** | **\DateTime**| First Date Filter | [optional]
 **to** | **\DateTime**| End Date Filter | [optional]
 **user_search_key** | **string**| Filter results on user or payer first name, last name or email | [optional]
 **page_index** | **int**| The page of results to retrieve | [optional] [default to 1]
 **page_size** | **int**| The number of items per page | [optional] [default to 20]
 **continuation_token** | **string**| Continuation Token from which we wish to retrieve results | [optional]
 **tier_types** | [**object[]**](../Model/object.md)| The type of tiers | [optional]
 **item_states** | [**object[]**](../Model/object.md)| The item states | [optional]
 **tier_name** | **string**| The name of a tier | [optional]
 **with_details** | **bool**| Set to true to return CustomFields and Options | [optional] [default to false]
 **sort_order** | **string**| Sort forms items by ascending or descending order. Default is descending | [optional] [default to Desc]
 **sort_field** | **string**| Sort forms items by a specific field (Date or UpdateDate). Default is date | [optional] [default to Date]
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\CommonResultsWithPaginationModelOfStatisticsItem**](../Model/CommonResultsWithPaginationModelOfStatisticsItem.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, text/csv

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getFormOrders**
> \fr\helloasso\v5\model\CommonResultsWithPaginationModelOfStatisticsOrder getFormOrders($organization_slug, $form_slug, $form_type, $from, $to, $user_search_key, $page_index, $page_size, $continuation_token, $with_details, $sort_order, $authorization)

Get form orders

<br/><br/><b>Your token must have one of these roles : </b><br/>FormAdmin<br/>OrganizationAdmin<br/><br/>If you are an <b>association</b>, you can obtain these roles with your client.<br/>If you are a <b>partner</b>, you can obtain these roles by the authorize flow.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessTransactions<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\OrdersItemsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_slug = "organization_slug_example"; // string | The organization slug
$form_slug = "form_slug_example"; // string | The form slug
$form_type = "form_type_example"; // string | The form type CrowdFunding, Membership, Event, Donation, PaymentForm, Checkout, Shop
$from = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | First Date Filter
$to = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | End Date Filter
$user_search_key = "user_search_key_example"; // string | Filter results on user or payer first name, last name or email
$page_index = 1; // int | The page of results to retrieve
$page_size = 20; // int | The number of items per page
$continuation_token = "continuation_token_example"; // string | Continuation Token from which we wish to retrieve results
$with_details = false; // bool | Set to true to return CustomFields
$sort_order = "Desc"; // string | Sort forms orders by ascending or descending order. Default is descending
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getFormOrders($organization_slug, $form_slug, $form_type, $from, $to, $user_search_key, $page_index, $page_size, $continuation_token, $with_details, $sort_order, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersItemsApi->getFormOrders: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_slug** | **string**| The organization slug |
 **form_slug** | **string**| The form slug |
 **form_type** | **string**| The form type CrowdFunding, Membership, Event, Donation, PaymentForm, Checkout, Shop |
 **from** | **\DateTime**| First Date Filter | [optional]
 **to** | **\DateTime**| End Date Filter | [optional]
 **user_search_key** | **string**| Filter results on user or payer first name, last name or email | [optional]
 **page_index** | **int**| The page of results to retrieve | [optional] [default to 1]
 **page_size** | **int**| The number of items per page | [optional] [default to 20]
 **continuation_token** | **string**| Continuation Token from which we wish to retrieve results | [optional]
 **with_details** | **bool**| Set to true to return CustomFields | [optional] [default to false]
 **sort_order** | **string**| Sort forms orders by ascending or descending order. Default is descending | [optional] [default to Desc]
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\CommonResultsWithPaginationModelOfStatisticsOrder**](../Model/CommonResultsWithPaginationModelOfStatisticsOrder.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getItem**
> \fr\helloasso\v5\model\StatisticsItemDetail getItem($item_id, $with_details, $authorization)

Get the detail of an item contained in an order

<br/><br/><b>Your token must have one of these roles : </b><br/>FormAdmin<br/>OrganizationAdmin<br/><br/>If you are an <b>association</b>, you can obtain these roles with your client.<br/>If you are a <b>partner</b>, you can obtain these roles by the authorize flow.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessTransactions<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\OrdersItemsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$item_id = 56; // int | The item ID
$with_details = false; // bool | Set to true to return CustomFields and Options
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getItem($item_id, $with_details, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersItemsApi->getItem: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **item_id** | **int**| The item ID |
 **with_details** | **bool**| Set to true to return CustomFields and Options | [optional] [default to false]
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\StatisticsItemDetail**](../Model/StatisticsItemDetail.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getOrder**
> \fr\helloasso\v5\model\StatisticsOrderDetail getOrder($order_id, $authorization)

Get detailed information about a specific order

<br/><br/><b>Your token must have one of these roles : </b><br/>FormAdmin<br/>OrganizationAdmin<br/><br/>If you are an <b>association</b>, you can obtain these roles with your client.<br/>If you are a <b>partner</b>, you can obtain these roles by the authorize flow.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessTransactions<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\OrdersItemsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$order_id = 56; // int | 
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getOrder($order_id, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersItemsApi->getOrder: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **order_id** | **int**|  |
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\StatisticsOrderDetail**](../Model/StatisticsOrderDetail.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getOrganizationItems**
> \fr\helloasso\v5\model\CommonResultsWithPaginationModelOfStatisticsItem getOrganizationItems($organization_slug, $from, $to, $user_search_key, $page_index, $page_size, $continuation_token, $tier_types, $item_states, $tier_name, $with_details, $sort_order, $sort_field, $authorization)

Get a list of items sold by an organization

<br/><br/><b>Your token must have one of these roles : </b><br/>OrganizationAdmin<br/><br/>If you are an <b>association</b>, you can obtain these roles with your client.<br/>If you are a <b>partner</b>, you can obtain these roles by the authorize flow.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessTransactions<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\OrdersItemsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_slug = "organization_slug_example"; // string | The organization slug
$from = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | First Date Filter
$to = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | End Date Filter
$user_search_key = "user_search_key_example"; // string | Filter results on user or payer first name, last name or email
$page_index = 1; // int | The page of results to retrieve
$page_size = 20; // int | The number of items per page
$continuation_token = "continuation_token_example"; // string | Continuation Token from which we wish to retrieve results
$tier_types = array(new \stdClass); // object[] | The type of tiers Donation, Payment, Registration, Membership, MonthlyDonation, MonthlyPayment, OfflineDonation, Contribution, Bonus
$item_states = array(new \stdClass); // object[] | The item states
$tier_name = "tier_name_example"; // string | The name of a tier
$with_details = false; // bool | Set to true to return CustomFields and Options
$sort_order = "Desc"; // string | Sort organizations items by ascending or descending order. Default is descending
$sort_field = "Date"; // string | Sort organizations items by a specific field (Date or UpdateDate). Default is date
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getOrganizationItems($organization_slug, $from, $to, $user_search_key, $page_index, $page_size, $continuation_token, $tier_types, $item_states, $tier_name, $with_details, $sort_order, $sort_field, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersItemsApi->getOrganizationItems: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_slug** | **string**| The organization slug |
 **from** | **\DateTime**| First Date Filter | [optional]
 **to** | **\DateTime**| End Date Filter | [optional]
 **user_search_key** | **string**| Filter results on user or payer first name, last name or email | [optional]
 **page_index** | **int**| The page of results to retrieve | [optional] [default to 1]
 **page_size** | **int**| The number of items per page | [optional] [default to 20]
 **continuation_token** | **string**| Continuation Token from which we wish to retrieve results | [optional]
 **tier_types** | [**object[]**](../Model/object.md)| The type of tiers Donation, Payment, Registration, Membership, MonthlyDonation, MonthlyPayment, OfflineDonation, Contribution, Bonus | [optional]
 **item_states** | [**object[]**](../Model/object.md)| The item states | [optional]
 **tier_name** | **string**| The name of a tier | [optional]
 **with_details** | **bool**| Set to true to return CustomFields and Options | [optional] [default to false]
 **sort_order** | **string**| Sort organizations items by ascending or descending order. Default is descending | [optional] [default to Desc]
 **sort_field** | **string**| Sort organizations items by a specific field (Date or UpdateDate). Default is date | [optional] [default to Date]
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\CommonResultsWithPaginationModelOfStatisticsItem**](../Model/CommonResultsWithPaginationModelOfStatisticsItem.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, text/csv

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getOrganizationOrders**
> \fr\helloasso\v5\model\CommonResultsWithPaginationModelOfStatisticsOrder getOrganizationOrders($organization_slug, $from, $to, $user_search_key, $page_index, $page_size, $continuation_token, $form_types, $with_details, $sort_order, $authorization)

Get a list of orders within a specific organization

<br/><br/><b>Your token must have one of these roles : </b><br/>OrganizationAdmin<br/><br/>If you are an <b>association</b>, you can obtain these roles with your client.<br/>If you are a <b>partner</b>, you can obtain these roles by the authorize flow.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessTransactions<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\OrdersItemsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_slug = "organization_slug_example"; // string | The organization slug
$from = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | First Date Filter
$to = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | End Date Filter
$user_search_key = "user_search_key_example"; // string | Filter results on user or payer first name, last name or email
$page_index = 1; // int | The page of results to retrieve
$page_size = 20; // int | The number of items per page
$continuation_token = "continuation_token_example"; // string | Continuation Token from which we wish to retrieve results
$form_types = array(new \stdClass); // object[] | The type of the form CrowdFunding, Membership, Event, Donation, PaymentForm, Checkout, Shop
$with_details = false; // bool | Set to true to return CustomFields
$sort_order = "Desc"; // string | Sort organizations orders by ascending or descending order. Default is descending
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getOrganizationOrders($organization_slug, $from, $to, $user_search_key, $page_index, $page_size, $continuation_token, $form_types, $with_details, $sort_order, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersItemsApi->getOrganizationOrders: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_slug** | **string**| The organization slug |
 **from** | **\DateTime**| First Date Filter | [optional]
 **to** | **\DateTime**| End Date Filter | [optional]
 **user_search_key** | **string**| Filter results on user or payer first name, last name or email | [optional]
 **page_index** | **int**| The page of results to retrieve | [optional] [default to 1]
 **page_size** | **int**| The number of items per page | [optional] [default to 20]
 **continuation_token** | **string**| Continuation Token from which we wish to retrieve results | [optional]
 **form_types** | [**object[]**](../Model/object.md)| The type of the form CrowdFunding, Membership, Event, Donation, PaymentForm, Checkout, Shop | [optional]
 **with_details** | **bool**| Set to true to return CustomFields | [optional] [default to false]
 **sort_order** | **string**| Sort organizations orders by ascending or descending order. Default is descending | [optional] [default to Desc]
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\CommonResultsWithPaginationModelOfStatisticsOrder**](../Model/CommonResultsWithPaginationModelOfStatisticsOrder.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

