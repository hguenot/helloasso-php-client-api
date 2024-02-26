# fr\helloasso\v5\PaymentsManagementApi

All URIs are relative to *https://api.helloasso.com/v5*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getFormPayments**](PaymentsManagementApi.md#getFormPayments) | **GET** /organizations/{organizationSlug}/forms/{formType}/{formSlug}/payments | Get information about payments made in a specific form
[**getOrganizationPayments**](PaymentsManagementApi.md#getOrganizationPayments) | **GET** /organizations/{organizationSlug}/payments | Get information about payments made to a specific organization
[**getPayment**](PaymentsManagementApi.md#getPayment) | **GET** /payments/{paymentId} | Get detailed information about a specific payment.
[**getPayments**](PaymentsManagementApi.md#getPayments) | **GET** /organizations/{organizationSlug}/payments/search | Search payments.
[**refundPayment**](PaymentsManagementApi.md#refundPayment) | **POST** /payments/{paymentId}/refund | Refund a payment.


# **getFormPayments**
> \fr\helloasso\v5\model\CommonResultsWithPaginationModelOfStatisticsPayment getFormPayments($organization_slug, $form_slug, $form_type, $from, $to, $user_search_key, $page_index, $page_size, $continuation_token, $states, $sort_order, $sort_field, $authorization)

Get information about payments made in a specific form

<br/><br/><b>Your token must have one of these roles : </b><br/>FormAdmin<br/>OrganizationAdmin<br/><br/>If you are an <b>association</b>, you can obtain these roles with your client.<br/>If you are a <b>partner</b>, you can obtain these roles by the authorize flow.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessTransactions<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\PaymentsManagementApi(
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
$states = array(new \stdClass); // object[] | Filter results by states of payments
$sort_order = "Desc"; // string | Sort payments by ascending or descending order. Default is descending
$sort_field = "Date"; // string | Sort payments by a specific field (Date or UpdateDate). Default is date
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getFormPayments($organization_slug, $form_slug, $form_type, $from, $to, $user_search_key, $page_index, $page_size, $continuation_token, $states, $sort_order, $sort_field, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PaymentsManagementApi->getFormPayments: ', $e->getMessage(), PHP_EOL;
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
 **states** | [**object[]**](../Model/object.md)| Filter results by states of payments | [optional]
 **sort_order** | **string**| Sort payments by ascending or descending order. Default is descending | [optional] [default to Desc]
 **sort_field** | **string**| Sort payments by a specific field (Date or UpdateDate). Default is date | [optional] [default to Date]
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\CommonResultsWithPaginationModelOfStatisticsPayment**](../Model/CommonResultsWithPaginationModelOfStatisticsPayment.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getOrganizationPayments**
> \fr\helloasso\v5\model\CommonResultsWithPaginationModelOfStatisticsPayment getOrganizationPayments($organization_slug, $from, $to, $user_search_key, $page_index, $page_size, $continuation_token, $states, $sort_order, $sort_field, $authorization)

Get information about payments made to a specific organization

Return list of payments according to parameters<br/><br/><b>Your token must have one of these roles : </b><br/>OrganizationAdmin<br/><br/>If you are an <b>association</b>, you can obtain these roles with your client.<br/>If you are a <b>partner</b>, you can obtain these roles by the authorize flow.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessTransactions<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\PaymentsManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_slug = "organization_slug_example"; // string | The organization Slug
$from = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | First Date Filter
$to = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | End Date Filter
$user_search_key = "user_search_key_example"; // string | Filter results on user or payer first name, last name or email
$page_index = 1; // int | The page of results to retrieve
$page_size = 20; // int | The number of items per page
$continuation_token = "continuation_token_example"; // string | Continuation Token from which we wish to retrieve results
$states = array(new \stdClass); // object[] | The payment states
$sort_order = "Desc"; // string | Sort payments by ascending or descending order. Default is descending
$sort_field = "Date"; // string | Sort payments by a specific field (Date or UpdateDate). Default is date
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getOrganizationPayments($organization_slug, $from, $to, $user_search_key, $page_index, $page_size, $continuation_token, $states, $sort_order, $sort_field, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PaymentsManagementApi->getOrganizationPayments: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_slug** | **string**| The organization Slug |
 **from** | **\DateTime**| First Date Filter | [optional]
 **to** | **\DateTime**| End Date Filter | [optional]
 **user_search_key** | **string**| Filter results on user or payer first name, last name or email | [optional]
 **page_index** | **int**| The page of results to retrieve | [optional] [default to 1]
 **page_size** | **int**| The number of items per page | [optional] [default to 20]
 **continuation_token** | **string**| Continuation Token from which we wish to retrieve results | [optional]
 **states** | [**object[]**](../Model/object.md)| The payment states | [optional]
 **sort_order** | **string**| Sort payments by ascending or descending order. Default is descending | [optional] [default to Desc]
 **sort_field** | **string**| Sort payments by a specific field (Date or UpdateDate). Default is date | [optional] [default to Date]
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\CommonResultsWithPaginationModelOfStatisticsPayment**](../Model/CommonResultsWithPaginationModelOfStatisticsPayment.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, text/csv

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getPayment**
> \fr\helloasso\v5\model\StatisticsPaymentDetail getPayment($payment_id, $authorization)

Get detailed information about a specific payment.

<br/><br/><b>Your token must have one of these roles : </b><br/>FormAdmin<br/>OrganizationAdmin<br/><br/>If you are an <b>association</b>, you can obtain these roles with your client.<br/>If you are a <b>partner</b>, you can obtain these roles by the authorize flow.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessTransactions<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\PaymentsManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$payment_id = 56; // int | The payment identifier.
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getPayment($payment_id, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PaymentsManagementApi->getPayment: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **payment_id** | **int**| The payment identifier. |
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\StatisticsPaymentDetail**](../Model/StatisticsPaymentDetail.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getPayments**
> \fr\helloasso\v5\model\CommonResultsWithPaginationModelOfPaymentPublicPaymentModel getPayments($organization_slug, $from, $to, $page_size, $continuation_token, $form_types, $form_type, $states, $user_id, $search_key, $amount, $sort_order, $sort_field, $authorization)

Search payments.

Warning :  The total count is disable, we return the list of payments and the continuationToken.    Search payments based on many criteria  Search must use at least one of the following :  - OrganizationId : payments made for this organization  - Form : Payments made by this form using a the couple formId and formType  - UserId : Payments made by this user                And can combine as many of those filters.  - States : A list of Payment states to be filtered. None or empty means all payments will be returned  - DateTime range : Using from and/or to, the datetime is inclusive  - Search query : A list of words that must be contained on either payer or user names or email  - Amount of the payment : In cents, that must exactly match the payments amount (with or without the contribution)                Result order is also customizable :   - Order by field can be date, update_date or creation_date   - Order can be asc or desc<br/><br/><b>Your token must have one of these roles : </b><br/>OrganizationAdmin<br/><br/>If you are an <b>association</b>, you can obtain these roles with your client.<br/>If you are a <b>partner</b>, you can obtain these roles by the authorize flow.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> AccessTransactions<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\PaymentsManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_slug = "organization_slug_example"; // string | The organization slug
$from = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | First Date Filter
$to = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | End Date Filter
$page_size = 20; // int | The number of items to retrieve
$continuation_token = "continuation_token_example"; // string | Continuation Token from which we wish to retrieve results
$form_types = array(new \stdClass); // object[] | The form type CrowdFunding, Membership, Event, Donation, PaymentForm, Checkout, Shop
$form_type = "form_type_example"; // string | The form type CrowdFunding, Membership, Event, Donation, PaymentForm, Checkout, Shop. This parameter must be used with the parameter {formId}.
$states = array(new \stdClass); // object[] | Filter results by states of payments
$user_id = 56; // int | The User identifier
$search_key = "search_key_example"; // string | Filter results on user or payer first name, last name or email.
$amount = 56; // int | Amount of the payment in cents. Filter payments with exact amount with or without the contribution.
$sort_order = "Desc"; // string | Sort payments by ascending or descending order. Default is descending
$sort_field = "Date"; // string | Sort payments by a specific field (Date or UpdateDate). Default is date
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->getPayments($organization_slug, $from, $to, $page_size, $continuation_token, $form_types, $form_type, $states, $user_id, $search_key, $amount, $sort_order, $sort_field, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PaymentsManagementApi->getPayments: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_slug** | **string**| The organization slug |
 **from** | **\DateTime**| First Date Filter | [optional]
 **to** | **\DateTime**| End Date Filter | [optional]
 **page_size** | **int**| The number of items to retrieve | [optional] [default to 20]
 **continuation_token** | **string**| Continuation Token from which we wish to retrieve results | [optional]
 **form_types** | [**object[]**](../Model/object.md)| The form type CrowdFunding, Membership, Event, Donation, PaymentForm, Checkout, Shop | [optional]
 **form_type** | **string**| The form type CrowdFunding, Membership, Event, Donation, PaymentForm, Checkout, Shop. This parameter must be used with the parameter {formId}. | [optional]
 **states** | [**object[]**](../Model/object.md)| Filter results by states of payments | [optional]
 **user_id** | **int**| The User identifier | [optional]
 **search_key** | **string**| Filter results on user or payer first name, last name or email. | [optional]
 **amount** | **int**| Amount of the payment in cents. Filter payments with exact amount with or without the contribution. | [optional]
 **sort_order** | **string**| Sort payments by ascending or descending order. Default is descending | [optional] [default to Desc]
 **sort_field** | **string**| Sort payments by a specific field (Date or UpdateDate). Default is date | [optional] [default to Date]
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

[**\fr\helloasso\v5\model\CommonResultsWithPaginationModelOfPaymentPublicPaymentModel**](../Model/CommonResultsWithPaginationModelOfPaymentPublicPaymentModel.md)

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **refundPayment**
> object refundPayment($payment_id, $comment, $cancel_order, $send_refund_mail, $amount, $authorization)

Refund a payment.

<br/><br/><b>Your token must have one of these roles : </b><br/>OrganizationAdmin<br/>FormAdmin<br/><br/>If you are an <b>association</b>, you can obtain these roles with your client.<br/>If you are a <b>partner</b>, you can obtain these roles by the authorize flow.<br/><br/><b>Your clientId must be allowed all of those privileges : </b> <br/> RefundManagement<br/><br/>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: Client
$config = fr\helloasso\v5\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new fr\helloasso\v5\Api\PaymentsManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$payment_id = 56; // int | The payment identifier.
$comment = "comment_example"; // string | The comment about this refund.
$cancel_order = false; // bool | Whether the future payments and linked items of this order must be canceled (possible only if the payment is fully refunded)
$send_refund_mail = true; // bool | Whether a refund mail must be send or not.
$amount = 0; // int | The amount in euros to refund. Enter this amount only for a partial refund for stripe. If not filled in then the entire payment is refunded
$authorization = "authorization_example"; // string | You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN

try {
    $result = $apiInstance->refundPayment($payment_id, $comment, $cancel_order, $send_refund_mail, $amount, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PaymentsManagementApi->refundPayment: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **payment_id** | **int**| The payment identifier. |
 **comment** | **string**| The comment about this refund. | [optional]
 **cancel_order** | **bool**| Whether the future payments and linked items of this order must be canceled (possible only if the payment is fully refunded) | [optional] [default to false]
 **send_refund_mail** | **bool**| Whether a refund mail must be send or not. | [optional] [default to true]
 **amount** | **int**| The amount in euros to refund. Enter this amount only for a partial refund for stripe. If not filled in then the entire payment is refunded | [optional] [default to 0]
 **authorization** | **string**| You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN | [optional]

### Return type

**object**

### Authorization

[Client](../../README.md#Client)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, text/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

