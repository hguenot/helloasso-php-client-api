# PaymentPublicPaymentModel

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**organization_id** | **int** |  | [optional] 
**form_id** | **int** |  | [optional] 
**form_type** | [**\fr\helloasso\v5\model\EnumsFormType**](EnumsFormType.md) |  | [optional] 
**amount** | **int** |  | [optional] 
**means_payment** | [**\fr\helloasso\v5\model\EnumsPaymentMeans**](EnumsPaymentMeans.md) |  | [optional] 
**cash_out_state** | [**\fr\helloasso\v5\model\EnumsPaymentCashOutState**](EnumsPaymentCashOutState.md) |  | [optional] 
**date** | [**\DateTime**](\DateTime.md) |  | [optional] 
**authorization_date** | [**\DateTime**](\DateTime.md) |  | [optional] 
**order_date** | [**\DateTime**](\DateTime.md) |  | [optional] 
**order_id** | **int** |  | [optional] 
**fiscal_receipt_generated** | **bool** |  | [optional] 
**payer_first_name** | **string** |  | [optional] 
**payer_last_name** | **string** |  | [optional] 
**status** | [**\fr\helloasso\v5\model\EnumsPaymentState**](EnumsPaymentState.md) |  | [optional] 
**user_id** | **int** |  | [optional] 
**user_first_name** | **string** |  | [optional] 
**user_last_name** | **string** |  | [optional] 
**user_email** | **string** |  | [optional] 
**provider_title** | **string** |  | [optional] 
**installment_number** | **int** |  | [optional] 
**meta** | [**\fr\helloasso\v5\model\CommonMetaModel**](CommonMetaModel.md) |  | [optional] 
**refund_operations** | [**\fr\helloasso\v5\model\StatisticsRefundOperationLightModel[]**](StatisticsRefundOperationLightModel.md) |  | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


