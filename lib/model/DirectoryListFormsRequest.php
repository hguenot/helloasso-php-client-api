<?php
/**
 * DirectoryListFormsRequest
 *
 * PHP version 5
 *
 * @category Class
 * @package  fr\helloasso\v5
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * HelloAsso API
 *
 * You can find a french guide on how to use HelloAsso API in the following [document](https://www.helloasso.com/public-documents/documents_api/guide_utilisation_api.pdf).    A python wrapper is also available by following this [link](https://github.com/HelloAsso/HaApiV5).    In order to access any endpoint you will need to authenticate using **OAuth 2.0** authentication server : `https://api.helloasso.com/oauth2`    When browsing the Swagger documentation :  - The easiest way to use it is to use the Swagger Authorize feature.    - Or you can override the Input `Bearer JWT` in the Authorization Header field. You can easily generate a JWT using Postman's Request Token feature    There are two levels of authorization :    - Client privileges : this defines the endpoints the client has access to.    - User Roles : being authorized by an organization grants rights on this organization.    <details><summary>Connecting to the API with OAuth 2.0</summary>    **In order to use the API, you must authenticate with the OAuth 2.0 server using a private API Client.**    *What is OAuth 2.0 ? : https://tools.ietf.org/html/rfc6749*    * If you are an **organization** (i.e. association), you can obtain a client (Id and Secret) in your administration area. You will be granted the following privileges : AccessPublicData, AccessTransactions and Checkout.  * If you are a **partner**, please contact HelloAsso at partenariats@helloasso.org in order to obtain a client.    In any case, please keep the client (id and secret) to yourself.    On HelloAsso, we support the following grants :  * Client Credentials    `grant_type=client_credentials`    If used by an organization, the rights are limited to the current organization to which the client has been issued.    If used by a partner, it does not grant you any rights (User Roles) on resource owned by an organization, you can only access routes without any User Role required.    See [more information below](#DescClientCredentials).  * Refresh    `grant_type=refresh_token`    See [more information below](#DescRefreshToken).  * Authorization Code    `grant_type=authorization_code`    Only for partners : it permits you to access private resources of organizations, by using the [authorization flow](#DescAuthorizeFlow).  * Disconnect (custom endpoint)    By calling https://api.helloasso.com/oauth2/disconnect, with a valid Bearer token in the Authorization Header, you will disconnect the user, and revoke its tokens. See [more information below](#DescDisconnect).    When authenticating, you will receive an `access_token` which is short-lived (30 minutes), and a `refresh_token`, that will permit you to obtain a new `access_token` for one month. When you have an `access_token` and a `refresh_token`, **you MUST obtain a new `access_token` using the `refresh_token` issued to you** (with the `grant_type=refresh_token`), **and MUST NOT obtain a new `access_token` by using the client**. When refreshing, you will obtain a new `access_token` valid for 30 minutes, and a new `refresh_token` valid for another month. If you continue to use each `refresh_token` that you receive, you could stay authenticated forever, without requiring to enter again your client secret or prompting the user for its login and password.    <details><summary id=\"DescClientCredentials\">Client Credentials</summary>    This is your first route to obtain an `access_token` to communicate with the API.    Route : **POST** `https://api.helloasso.com/oauth2/token`    <details><summary>Headers</summary>    Key          | Value  -------------|------------------------------------  Content-Type | *application/x-www-form-urlencoded*  </details>  <details><summary>Body</summary>    Key           | Information          | Required/Optional  --------------|----------------------|------------------  client_id     | Your Client Id       | **Required**  client_secret | Your Client Secret   | **Required**  grant_type    | *client_credentials* | **Required**  </details>  <details><summary>Result (JSON)</summary>    Key                | Information  -------------------|-------------------------------------------------------------------------  access_token       | The JWT token to use in future requests  refresh_token      | Token used to refresh the token and get a new JWT token after expiration  token_type         | Token Type : always \"*bearer*\"  expires_in         | The lifetime in seconds of the access token  </details>  <details><summary>CURL Example</summary>    ```  curl -X POST \\    https://api.helloasso.com/oauth2/token \\    -H 'content-type: application/x-www-form-urlencoded' \\    -d 'grant_type=client_credentials&client_id=9fdc22226bf24ff99b875f4a7c503715&client_secret=AvUYelYH1aSZZ3QNBiZOybmBlZTpUcNSonsufB5txuw='  ```  </details>  </details>  <details><summary id=\"DescRefreshToken\">Refresh Token</summary>    Your route to refresh indefinitely your `access_token` and obtain a new one.    Route : **POST** `https://api.helloasso.com/oauth2/token`    <details><summary>Headers</summary>    Key          | Value  -------------|------------------------------------  Content-Type | *application/x-www-form-urlencoded*  </details>  <details><summary>Body</summary>    Key           | Information        | Required/Optional  --------------|--------------------|------------------  client_id     | Your Client Id     | **Required**  grant_type    | *refresh_token*    | **Required**  refresh_token | Your Refresh Token | **Required**  </details>  <details><summary>Result (JSON)</summary>    Key                | Information  -------------------|-------------------------------------------------------------------------  access_token       | The JWT token to use in future requests  refresh_token      | Token used to refresh the token and get a new JWT token after expiration  token_type         | Token Type : always \"*bearer*\"  expires_in         | The lifetime in seconds of the access token  </details>  <details><summary>CURL Example</summary>    ```  curl -X POST \\    https://api.helloasso.com/oauth2/token \\    -H 'content-type: application/x-www-form-urlencoded' \\    -d 'grant_type=refresh_token&client_id=9fdc22226bf24ff99b875f4a7c503715&refresh_token=REFRESH_TOKEN'  ```  </details>  </details>  <details><summary id=\"DescAuthorizeFlow\">Authorize flow</summary>    The authorize flow will permit partner's applications to access protected resources (resources owned by an organization). Typically, you must display a button to your user to ask him to login on HelloAsso, and authorize you to access his resources.    Button example :    ![](../../DocAssets/ImgHaAuthorizeButton.png)    <details><summary>Button Code (HTML & CSS)</summary>  ```  <button class=\"HaAuthorizeButton\">    <img src=\"https://api.helloasso.com/v5/DocAssets/logo-ha.svg\" alt=\"\" class=\"HaAuthorizeButtonLogo\">    <span class=\"HaAuthorizeButtonTitle\">Connecter à HelloAsso</span>  </button>    <style>  .HaAuthorizeButton {    align-items: center;    -webkit-box-pack: center;    -ms-flex-pack: center;    background-color: #FFFFFF;    border: 0.0625rem solid #49D38A;    border-radius: 0.125rem;    display: -webkit-box;    display: -ms-flexbox;    display: flex;    padding: 0;  }  .HaAuthorizeButton:disabled {    background-color: #E9E9F0;    border-color: transparent;    cursor: not-allowed;  }  .HaAuthorizeButton:not(:disabled):focus {    box-shadow: 0 0 0 0.25rem rgba(73, 211, 138, 0.25);    -webkit-box-shadow: 0 0 0 0.25rem rgba(73, 211, 138, 0.25);  }  .HaAuthorizeButtonLogo {    padding: 0 0.8rem;    width: 2.25rem;  }  .HaAuthorizeButtonTitle {    background-color: #49D38A;    color: #FFFFFF;    font-size: 1rem;    font-weight: 700;    padding: 0.78125rem 1.5rem;  }  .HaAuthorizeButton:disabled .HaAuthorizeButtonTitle {    background-color: #E9E9F0;    color: #9A9DA8;  }  .HaAuthorizeButton:not(:disabled):hover .HaAuthorizeButtonTitle,  .HaAuthorizeButton:not(:disabled):focus .HaAuthorizeButtonTitle {    background-color: #30c677;  }  </style>  ```  </details>    When the user clicks on the button or link, you must open a popup window and direct him to this url : https://auth.helloasso.com/authorize with all the appropriate query parameters (see below).    <details><summary>Authorization Request</summary>    Route to display : **GET** `https://auth.helloasso.com/authorize`    <details><summary>Parameters</summary>    Key                    | Information                                                      | Required/Optional  -----------------------|------------------------------------------------------------------|------------------  client_id              | Your Client Id                                                   | **Required**  redirect_uri           | The redirect uri that will be used when the authorize is complete (success or error). For security considerations, the domain of the redirect uri must be the same configured on your client in our database. The redirect uri must use the secure protocol `https`. You can modify this domain with the following endpoint https://api.helloasso.com/v5/partners/me/api-clients (see section \"Partners Managment\" bellow) | **Required**  code_challenge         | The PKCE code challenge. See section [PKCE](#PKCE) below.        | **Required**  code_challenge_method  | The PKCE code challenge method, must be \"*S256*\"                 | **Required**  state                  | A value that will be sent back to you, to maintain state between the request and callback. The parameter should be used for preventing cross-site request forgery : **the state sent back must match the one you sent**. Must be a string, but you can use this to encode any data you want. The state should be less than 500 characters. | Optional    We recommend you to open the window with at least an height of 650px and a width of 500px.    </details>  <details><summary>Request Example</summary>    ```  https://auth.helloasso.com/authorize    ?client_id=9fdc22226bf24ff99b875f4a7c503715    &redirect_uri=YOUR_REDIRECT_URI    &code_challenge=YOUR_CODE_CHALLENGE    &code_challenge_method=S256    &state=abc  ```  </details>  </details>    This will display the login window and then the authorize window to the user :     <img alt=\"\" src=\"../../DocAssets/ImgHaLoginWindow.png\" style=\"height:400px\"><img alt=\"\" src=\"../../DocAssets/ImgHaAuthorizeWindow.png\" style=\"height:400px;margin-left:20px\">    The user has an option to sign up and register its organization, if he does not have one already.  When the user completes the process, the window will redirect to the given `redirect_uri`, with the `authorization_code` in parameter (or with an error code if an error occurred).    <details><summary>Redirect response</summary>    If success :  Key   | Information  ------|----------------------------------------------------------------------------------------------  code  | The authorization code generated by the authorization server. Has a lifetime of five minutes.  state | If you supplied a state in the request, will be sent back to you    If error :  Key               | Information  ------------------|-----------------------------------------------------------------  error             | A single error code.  error_description | Optional : a text providing additional information  state             | If you supplied a state in the request, will be sent back to you  See more info here on error codes : https://tools.ietf.org/html/rfc6749#section-4.1.2.1  </details>    You can then exchange the code for an `access_token` and a `refresh_token`.    <details><summary>Access Token Request</summary>    Route : **POST** `https://api.helloasso.com/oauth2/token`    <details><summary>Headers</summary>    Key          | Value  -------------|------------------------------------  Content-Type | *application/x-www-form-urlencoded*  </details>  <details><summary>Body</summary>    Key           | Information                                                       | Required/Optional  --------------|-------------------------------------------------------------------|------------------  client_id     | Your Client Id                                                    | **Required**  client_secret | Your Client Secret                                                | **Required**  grant_type    | *authorization_code*                                              | **Required**  code          | The authorization code received (when redirecting to your domain) | **Required**  redirect_uri  | The same redirect uri used when displaying the authorize window   | **Required**  code_verifier | The PKCE code verifier                                            | **Required**  </details>  <details><summary>Result (JSON)</summary>    Key                | Information  -------------------|-------------------------------------------------------------------------  access_token       | The JWT token to use in future requests  refresh_token      | Token used to refresh the token and get a new JWT token after expiration  token_type         | Token Type : always \"*bearer*\"  expires_in         | The lifetime in seconds of the access token  organization_slug  | The slug of the association which authorized the access  </details>  <details><summary>CURL Example</summary>    ```  curl -X POST \\    https://api.helloasso.com/oauth2/token \\    -H 'content-type: application/x-www-form-urlencoded' \\    -d 'grant_type=authorization_code&client_id=9fdc22226bf24ff99b875f4a7c503715&client_secret=AvUYelYH1aSZZ3QNBiZOybmBlZTpUcNSonsufB5txuw=' \\    -d 'code=AUTHORIZATION_CODE_RECEIVED&redirect_uri=YOUR_REDIRECT_URI&code_verifier=YOUR_CODE_VERIFIER'  ```  </details>  </details>  <details><summary id=\"PKCE\">PKCE</summary>    PKCE (Proof Key for Code Exchange) is a security measure for the authorization grant.    The specification can be found here : https://tools.ietf.org/html/rfc7636    We require you to use the challenge_method S256.    Basically, you must generate a random Code Verifier of 43 to 128 characters, from the following characters : `ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-._~`. You then create the Code Challenge : you hash the code verifier with the SHA-256 hash function, encode it to base64, and then url encode it.    You will send the code challenge in the initial request to display the authorize window. HelloAsso will keep it stored with your request. When you will request a token in exchange for your authorization code, you will send the code verifier. HelloAsso will then validate it (length and characters used) and encode it the same way you did it (SHA-256, base 64 & uri encode) and compare the result with the code challenge stored during the authorize request. If it does not match, you will receive the error \"invalid_grant\".    If you want to test your code challenge generator, you can do so here with this online tool : https://tonyxu-io.github.io/pkce-generator/  </details>  </details>  <details><summary id=\"DescDisconnect\">Disconnect</summary>    Disconnect the user, and revoke its tokens. Returns 200 if disconnect worked.    Route : **GET** `https://api.helloasso.com/oauth2/disconnect`    <details><summary>Headers</summary>    Key           | Value  --------------|----------------------------------------------------------  Authorization | *Bearer JWT* (replace JWT with your `access_token` value)  </details>  <details><summary>CURL Example</summary>    ```  curl -X GET \\    https://api.helloasso.com/oauth2/disconnect \\    -H 'Authorization: Bearer JWT'  ```  </details>  </details>  </details>  <details><summary id=\"DescNotifications\">Handling the notifications system</summary>    You will receive a notification when one of the following events occur:  - A campaign is created  - An order is made (including free orders where there are no payments)  - A payment is made (whether it is a single payment or a payment by installment)  - A payment is refunded  - A payment by installment is refused  - An organization is renamed and his slug change    <details><summary>Define your notification URL</summary>    * If you are an **organization** (i.e. association), you can define and manage your notification URL in your administration area.  * If you are a **partner**, You can modify this notification URL with the following endpoint https://api.helloasso.com/v5/partners/me/api-notifications (see section \"Partners Managment\" bellow).     In any case, your callback URL **must use the secure protocol `https` and must support the `POST` verb.**    Then, in your code, you can handle and listen for information coming from the defined URL.  </details>    <details><summary>Get the notification content</summary>    The notification can have 4 different types : **Order**, **Payment**, **Form** (for campaign creation) or **Organization** (when the organization slug changed).    When a new content is available, we will call the notification URL callback defined before with the corresponding data in the body.    <details><summary>Order Result (JSON)</summary>  Key               | Information  ------------------|-------------------------------------------------------------------------  eventType         | Order  data              | The order data. See [more information on the order model below](#model-Orders.OrderDetail)  </details>  <details><summary id=\"PaymentResultJson\">Payment Result (JSON)</summary>  Key               | Information  ------------------|-------------------------------------------------------------------------  eventType         | Payment  data              | The payment data. See [more information on the payment model below](#model-Orders.PaymentDetail)  </details>  <details><summary>Form Result (JSON)</summary>  Key               | Information  ------------------|-------------------------------------------------------------------------  eventType         | Form  data              | The form data. See [more information on the form model below](#model-Forms.FormPublicModel)  </details>  <details><summary>Organization Result (JSON)</summary>  Key               | Information  ------------------|-------------------------------------------------------------------------  eventType         | Organization  data              | { \"data\": { \"old_slug_organization\": \"ctb\", \"new_slug_organization\": \"club tennis bordeaux\"  }, \"eventType\": \"Organization\"}  </details>  </details>  </details>  </details>  <details><summary id=\"DescCheckout\">Checkout Form</summary>    The Checkout is a type of form, specifically designed to allow contributors to make payments prefilled by an authorized partner or an organization.  The partner/organization creates a checkout intent (with all the contributor information that he may have, and specified payment terms ; see the following API route *POST checkout-intents* of the [Checkout intents management](#Checkout%20intents%20management) section), and receives in response a url (which is valid for 15 minutes). The contributor follows the url, and then validates the form and pays. The contributor is then redirected to the page of your choosing, with a result parameter (error, success etc).  The initiator receives a notification of each Order and Payment authorized (if you have configured them, see [Handling the notifications system](#DescNotifications). You can also verify your checkout intent result and receive the created order. See the route *GET checkout-intents/{checkoutIntentId}* of the [Checkout intents management](#operations-tag-Checkout%20intents%20management) section.    You can find a more detailed description on how to integrate it in the following [document](https://www.helloasso.com/public-documents/documents_api/documentation_checkout.pdf).    If you want try checkout payments please use our test environnement https://www.helloasso-sandbox.com/ to create an organization.  You can then retrieve your API client in the back office and make calls on https://api.helloasso-sandbox.com/v5.  Virtual credit cards are avaible by following this [link](https://docs.sips.worldline-solutions.com/fr/cartes-de-test.html).    </details>
 *
 * OpenAPI spec version: V5
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.39
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace fr\helloasso\v5\model;

use \ArrayAccess;
use \fr\helloasso\v5\ObjectSerializer;

/**
 * DirectoryListFormsRequest Class Doc Comment
 *
 * @category Class
 * @package  fr\helloasso\v5
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class DirectoryListFormsRequest implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Directory.ListFormsRequest';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'form_name' => 'string',
        'form_description' => 'string',
        'form_zip_codes' => 'string[]',
        'form_cities' => 'string[]',
        'form_regions' => 'string[]',
        'form_departments' => 'string[]',
        'form_countries' => 'string[]',
        'form_types' => '\fr\helloasso\v5\model\EnumsFormType[]',
        'form_activity_type' => 'string[]',
        'form_publication_start_date_min' => '\DateTime',
        'form_publication_start_date_max' => '\DateTime',
        'form_start_date_min' => '\DateTime',
        'form_start_date_max' => '\DateTime',
        'form_end_date_max' => '\DateTime',
        'form_end_date_min' => '\DateTime',
        'form_is_free' => 'bool',
        'form_has_remaining_entries' => 'bool',
        'form_internal_tags' => 'string[]',
        'form_public_tags' => 'string[]',
        'organization_name' => 'string',
        'organization_description' => 'string',
        'organization_categories' => 'string[]',
        'organization_types' => 'string[]',
        'organization_zip_codes' => 'string[]',
        'organization_cities' => 'string[]',
        'organization_regions' => 'string[]',
        'organization_departments' => 'string[]',
        'organization_fiscal_receipt_eligibility' => 'bool',
        'organization_linked_partners' => 'string[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'form_name' => null,
        'form_description' => null,
        'form_zip_codes' => null,
        'form_cities' => null,
        'form_regions' => null,
        'form_departments' => null,
        'form_countries' => null,
        'form_types' => null,
        'form_activity_type' => null,
        'form_publication_start_date_min' => 'date-time',
        'form_publication_start_date_max' => 'date-time',
        'form_start_date_min' => 'date-time',
        'form_start_date_max' => 'date-time',
        'form_end_date_max' => 'date-time',
        'form_end_date_min' => 'date-time',
        'form_is_free' => null,
        'form_has_remaining_entries' => null,
        'form_internal_tags' => null,
        'form_public_tags' => null,
        'organization_name' => null,
        'organization_description' => null,
        'organization_categories' => null,
        'organization_types' => null,
        'organization_zip_codes' => null,
        'organization_cities' => null,
        'organization_regions' => null,
        'organization_departments' => null,
        'organization_fiscal_receipt_eligibility' => null,
        'organization_linked_partners' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'form_name' => 'formName',
        'form_description' => 'formDescription',
        'form_zip_codes' => 'formZipCodes',
        'form_cities' => 'formCities',
        'form_regions' => 'formRegions',
        'form_departments' => 'formDepartments',
        'form_countries' => 'formCountries',
        'form_types' => 'formTypes',
        'form_activity_type' => 'formActivityType',
        'form_publication_start_date_min' => 'formPublicationStartDateMin',
        'form_publication_start_date_max' => 'formPublicationStartDateMax',
        'form_start_date_min' => 'formStartDateMin',
        'form_start_date_max' => 'formStartDateMax',
        'form_end_date_max' => 'formEndDateMax',
        'form_end_date_min' => 'formEndDateMin',
        'form_is_free' => 'formIsFree',
        'form_has_remaining_entries' => 'formHasRemainingEntries',
        'form_internal_tags' => 'formInternalTags',
        'form_public_tags' => 'formPublicTags',
        'organization_name' => 'organizationName',
        'organization_description' => 'organizationDescription',
        'organization_categories' => 'organizationCategories',
        'organization_types' => 'organizationTypes',
        'organization_zip_codes' => 'organizationZipCodes',
        'organization_cities' => 'organizationCities',
        'organization_regions' => 'organizationRegions',
        'organization_departments' => 'organizationDepartments',
        'organization_fiscal_receipt_eligibility' => 'organizationFiscalReceiptEligibility',
        'organization_linked_partners' => 'organizationLinkedPartners'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'form_name' => 'setFormName',
        'form_description' => 'setFormDescription',
        'form_zip_codes' => 'setFormZipCodes',
        'form_cities' => 'setFormCities',
        'form_regions' => 'setFormRegions',
        'form_departments' => 'setFormDepartments',
        'form_countries' => 'setFormCountries',
        'form_types' => 'setFormTypes',
        'form_activity_type' => 'setFormActivityType',
        'form_publication_start_date_min' => 'setFormPublicationStartDateMin',
        'form_publication_start_date_max' => 'setFormPublicationStartDateMax',
        'form_start_date_min' => 'setFormStartDateMin',
        'form_start_date_max' => 'setFormStartDateMax',
        'form_end_date_max' => 'setFormEndDateMax',
        'form_end_date_min' => 'setFormEndDateMin',
        'form_is_free' => 'setFormIsFree',
        'form_has_remaining_entries' => 'setFormHasRemainingEntries',
        'form_internal_tags' => 'setFormInternalTags',
        'form_public_tags' => 'setFormPublicTags',
        'organization_name' => 'setOrganizationName',
        'organization_description' => 'setOrganizationDescription',
        'organization_categories' => 'setOrganizationCategories',
        'organization_types' => 'setOrganizationTypes',
        'organization_zip_codes' => 'setOrganizationZipCodes',
        'organization_cities' => 'setOrganizationCities',
        'organization_regions' => 'setOrganizationRegions',
        'organization_departments' => 'setOrganizationDepartments',
        'organization_fiscal_receipt_eligibility' => 'setOrganizationFiscalReceiptEligibility',
        'organization_linked_partners' => 'setOrganizationLinkedPartners'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'form_name' => 'getFormName',
        'form_description' => 'getFormDescription',
        'form_zip_codes' => 'getFormZipCodes',
        'form_cities' => 'getFormCities',
        'form_regions' => 'getFormRegions',
        'form_departments' => 'getFormDepartments',
        'form_countries' => 'getFormCountries',
        'form_types' => 'getFormTypes',
        'form_activity_type' => 'getFormActivityType',
        'form_publication_start_date_min' => 'getFormPublicationStartDateMin',
        'form_publication_start_date_max' => 'getFormPublicationStartDateMax',
        'form_start_date_min' => 'getFormStartDateMin',
        'form_start_date_max' => 'getFormStartDateMax',
        'form_end_date_max' => 'getFormEndDateMax',
        'form_end_date_min' => 'getFormEndDateMin',
        'form_is_free' => 'getFormIsFree',
        'form_has_remaining_entries' => 'getFormHasRemainingEntries',
        'form_internal_tags' => 'getFormInternalTags',
        'form_public_tags' => 'getFormPublicTags',
        'organization_name' => 'getOrganizationName',
        'organization_description' => 'getOrganizationDescription',
        'organization_categories' => 'getOrganizationCategories',
        'organization_types' => 'getOrganizationTypes',
        'organization_zip_codes' => 'getOrganizationZipCodes',
        'organization_cities' => 'getOrganizationCities',
        'organization_regions' => 'getOrganizationRegions',
        'organization_departments' => 'getOrganizationDepartments',
        'organization_fiscal_receipt_eligibility' => 'getOrganizationFiscalReceiptEligibility',
        'organization_linked_partners' => 'getOrganizationLinkedPartners'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['form_name'] = isset($data['form_name']) ? $data['form_name'] : null;
        $this->container['form_description'] = isset($data['form_description']) ? $data['form_description'] : null;
        $this->container['form_zip_codes'] = isset($data['form_zip_codes']) ? $data['form_zip_codes'] : null;
        $this->container['form_cities'] = isset($data['form_cities']) ? $data['form_cities'] : null;
        $this->container['form_regions'] = isset($data['form_regions']) ? $data['form_regions'] : null;
        $this->container['form_departments'] = isset($data['form_departments']) ? $data['form_departments'] : null;
        $this->container['form_countries'] = isset($data['form_countries']) ? $data['form_countries'] : null;
        $this->container['form_types'] = isset($data['form_types']) ? $data['form_types'] : null;
        $this->container['form_activity_type'] = isset($data['form_activity_type']) ? $data['form_activity_type'] : null;
        $this->container['form_publication_start_date_min'] = isset($data['form_publication_start_date_min']) ? $data['form_publication_start_date_min'] : null;
        $this->container['form_publication_start_date_max'] = isset($data['form_publication_start_date_max']) ? $data['form_publication_start_date_max'] : null;
        $this->container['form_start_date_min'] = isset($data['form_start_date_min']) ? $data['form_start_date_min'] : null;
        $this->container['form_start_date_max'] = isset($data['form_start_date_max']) ? $data['form_start_date_max'] : null;
        $this->container['form_end_date_max'] = isset($data['form_end_date_max']) ? $data['form_end_date_max'] : null;
        $this->container['form_end_date_min'] = isset($data['form_end_date_min']) ? $data['form_end_date_min'] : null;
        $this->container['form_is_free'] = isset($data['form_is_free']) ? $data['form_is_free'] : null;
        $this->container['form_has_remaining_entries'] = isset($data['form_has_remaining_entries']) ? $data['form_has_remaining_entries'] : null;
        $this->container['form_internal_tags'] = isset($data['form_internal_tags']) ? $data['form_internal_tags'] : null;
        $this->container['form_public_tags'] = isset($data['form_public_tags']) ? $data['form_public_tags'] : null;
        $this->container['organization_name'] = isset($data['organization_name']) ? $data['organization_name'] : null;
        $this->container['organization_description'] = isset($data['organization_description']) ? $data['organization_description'] : null;
        $this->container['organization_categories'] = isset($data['organization_categories']) ? $data['organization_categories'] : null;
        $this->container['organization_types'] = isset($data['organization_types']) ? $data['organization_types'] : null;
        $this->container['organization_zip_codes'] = isset($data['organization_zip_codes']) ? $data['organization_zip_codes'] : null;
        $this->container['organization_cities'] = isset($data['organization_cities']) ? $data['organization_cities'] : null;
        $this->container['organization_regions'] = isset($data['organization_regions']) ? $data['organization_regions'] : null;
        $this->container['organization_departments'] = isset($data['organization_departments']) ? $data['organization_departments'] : null;
        $this->container['organization_fiscal_receipt_eligibility'] = isset($data['organization_fiscal_receipt_eligibility']) ? $data['organization_fiscal_receipt_eligibility'] : null;
        $this->container['organization_linked_partners'] = isset($data['organization_linked_partners']) ? $data['organization_linked_partners'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets form_name
     *
     * @return string
     */
    public function getFormName()
    {
        return $this->container['form_name'];
    }

    /**
     * Sets form_name
     *
     * @param string $form_name form_name
     *
     * @return $this
     */
    public function setFormName($form_name)
    {
        $this->container['form_name'] = $form_name;

        return $this;
    }

    /**
     * Gets form_description
     *
     * @return string
     */
    public function getFormDescription()
    {
        return $this->container['form_description'];
    }

    /**
     * Sets form_description
     *
     * @param string $form_description form_description
     *
     * @return $this
     */
    public function setFormDescription($form_description)
    {
        $this->container['form_description'] = $form_description;

        return $this;
    }

    /**
     * Gets form_zip_codes
     *
     * @return string[]
     */
    public function getFormZipCodes()
    {
        return $this->container['form_zip_codes'];
    }

    /**
     * Sets form_zip_codes
     *
     * @param string[] $form_zip_codes form_zip_codes
     *
     * @return $this
     */
    public function setFormZipCodes($form_zip_codes)
    {
        $this->container['form_zip_codes'] = $form_zip_codes;

        return $this;
    }

    /**
     * Gets form_cities
     *
     * @return string[]
     */
    public function getFormCities()
    {
        return $this->container['form_cities'];
    }

    /**
     * Sets form_cities
     *
     * @param string[] $form_cities form_cities
     *
     * @return $this
     */
    public function setFormCities($form_cities)
    {
        $this->container['form_cities'] = $form_cities;

        return $this;
    }

    /**
     * Gets form_regions
     *
     * @return string[]
     */
    public function getFormRegions()
    {
        return $this->container['form_regions'];
    }

    /**
     * Sets form_regions
     *
     * @param string[] $form_regions form_regions
     *
     * @return $this
     */
    public function setFormRegions($form_regions)
    {
        $this->container['form_regions'] = $form_regions;

        return $this;
    }

    /**
     * Gets form_departments
     *
     * @return string[]
     */
    public function getFormDepartments()
    {
        return $this->container['form_departments'];
    }

    /**
     * Sets form_departments
     *
     * @param string[] $form_departments form_departments
     *
     * @return $this
     */
    public function setFormDepartments($form_departments)
    {
        $this->container['form_departments'] = $form_departments;

        return $this;
    }

    /**
     * Gets form_countries
     *
     * @return string[]
     */
    public function getFormCountries()
    {
        return $this->container['form_countries'];
    }

    /**
     * Sets form_countries
     *
     * @param string[] $form_countries form_countries
     *
     * @return $this
     */
    public function setFormCountries($form_countries)
    {
        $this->container['form_countries'] = $form_countries;

        return $this;
    }

    /**
     * Gets form_types
     *
     * @return \fr\helloasso\v5\model\EnumsFormType[]
     */
    public function getFormTypes()
    {
        return $this->container['form_types'];
    }

    /**
     * Sets form_types
     *
     * @param \fr\helloasso\v5\model\EnumsFormType[] $form_types form_types
     *
     * @return $this
     */
    public function setFormTypes($form_types)
    {
        $this->container['form_types'] = $form_types;

        return $this;
    }

    /**
     * Gets form_activity_type
     *
     * @return string[]
     */
    public function getFormActivityType()
    {
        return $this->container['form_activity_type'];
    }

    /**
     * Sets form_activity_type
     *
     * @param string[] $form_activity_type form_activity_type
     *
     * @return $this
     */
    public function setFormActivityType($form_activity_type)
    {
        $this->container['form_activity_type'] = $form_activity_type;

        return $this;
    }

    /**
     * Gets form_publication_start_date_min
     *
     * @return \DateTime
     */
    public function getFormPublicationStartDateMin()
    {
        return $this->container['form_publication_start_date_min'];
    }

    /**
     * Sets form_publication_start_date_min
     *
     * @param \DateTime $form_publication_start_date_min form_publication_start_date_min
     *
     * @return $this
     */
    public function setFormPublicationStartDateMin($form_publication_start_date_min)
    {
        $this->container['form_publication_start_date_min'] = $form_publication_start_date_min;

        return $this;
    }

    /**
     * Gets form_publication_start_date_max
     *
     * @return \DateTime
     */
    public function getFormPublicationStartDateMax()
    {
        return $this->container['form_publication_start_date_max'];
    }

    /**
     * Sets form_publication_start_date_max
     *
     * @param \DateTime $form_publication_start_date_max form_publication_start_date_max
     *
     * @return $this
     */
    public function setFormPublicationStartDateMax($form_publication_start_date_max)
    {
        $this->container['form_publication_start_date_max'] = $form_publication_start_date_max;

        return $this;
    }

    /**
     * Gets form_start_date_min
     *
     * @return \DateTime
     */
    public function getFormStartDateMin()
    {
        return $this->container['form_start_date_min'];
    }

    /**
     * Sets form_start_date_min
     *
     * @param \DateTime $form_start_date_min form_start_date_min
     *
     * @return $this
     */
    public function setFormStartDateMin($form_start_date_min)
    {
        $this->container['form_start_date_min'] = $form_start_date_min;

        return $this;
    }

    /**
     * Gets form_start_date_max
     *
     * @return \DateTime
     */
    public function getFormStartDateMax()
    {
        return $this->container['form_start_date_max'];
    }

    /**
     * Sets form_start_date_max
     *
     * @param \DateTime $form_start_date_max form_start_date_max
     *
     * @return $this
     */
    public function setFormStartDateMax($form_start_date_max)
    {
        $this->container['form_start_date_max'] = $form_start_date_max;

        return $this;
    }

    /**
     * Gets form_end_date_max
     *
     * @return \DateTime
     */
    public function getFormEndDateMax()
    {
        return $this->container['form_end_date_max'];
    }

    /**
     * Sets form_end_date_max
     *
     * @param \DateTime $form_end_date_max form_end_date_max
     *
     * @return $this
     */
    public function setFormEndDateMax($form_end_date_max)
    {
        $this->container['form_end_date_max'] = $form_end_date_max;

        return $this;
    }

    /**
     * Gets form_end_date_min
     *
     * @return \DateTime
     */
    public function getFormEndDateMin()
    {
        return $this->container['form_end_date_min'];
    }

    /**
     * Sets form_end_date_min
     *
     * @param \DateTime $form_end_date_min form_end_date_min
     *
     * @return $this
     */
    public function setFormEndDateMin($form_end_date_min)
    {
        $this->container['form_end_date_min'] = $form_end_date_min;

        return $this;
    }

    /**
     * Gets form_is_free
     *
     * @return bool
     */
    public function getFormIsFree()
    {
        return $this->container['form_is_free'];
    }

    /**
     * Sets form_is_free
     *
     * @param bool $form_is_free form_is_free
     *
     * @return $this
     */
    public function setFormIsFree($form_is_free)
    {
        $this->container['form_is_free'] = $form_is_free;

        return $this;
    }

    /**
     * Gets form_has_remaining_entries
     *
     * @return bool
     */
    public function getFormHasRemainingEntries()
    {
        return $this->container['form_has_remaining_entries'];
    }

    /**
     * Sets form_has_remaining_entries
     *
     * @param bool $form_has_remaining_entries form_has_remaining_entries
     *
     * @return $this
     */
    public function setFormHasRemainingEntries($form_has_remaining_entries)
    {
        $this->container['form_has_remaining_entries'] = $form_has_remaining_entries;

        return $this;
    }

    /**
     * Gets form_internal_tags
     *
     * @return string[]
     */
    public function getFormInternalTags()
    {
        return $this->container['form_internal_tags'];
    }

    /**
     * Sets form_internal_tags
     *
     * @param string[] $form_internal_tags form_internal_tags
     *
     * @return $this
     */
    public function setFormInternalTags($form_internal_tags)
    {
        $this->container['form_internal_tags'] = $form_internal_tags;

        return $this;
    }

    /**
     * Gets form_public_tags
     *
     * @return string[]
     */
    public function getFormPublicTags()
    {
        return $this->container['form_public_tags'];
    }

    /**
     * Sets form_public_tags
     *
     * @param string[] $form_public_tags form_public_tags
     *
     * @return $this
     */
    public function setFormPublicTags($form_public_tags)
    {
        $this->container['form_public_tags'] = $form_public_tags;

        return $this;
    }

    /**
     * Gets organization_name
     *
     * @return string
     */
    public function getOrganizationName()
    {
        return $this->container['organization_name'];
    }

    /**
     * Sets organization_name
     *
     * @param string $organization_name organization_name
     *
     * @return $this
     */
    public function setOrganizationName($organization_name)
    {
        $this->container['organization_name'] = $organization_name;

        return $this;
    }

    /**
     * Gets organization_description
     *
     * @return string
     */
    public function getOrganizationDescription()
    {
        return $this->container['organization_description'];
    }

    /**
     * Sets organization_description
     *
     * @param string $organization_description organization_description
     *
     * @return $this
     */
    public function setOrganizationDescription($organization_description)
    {
        $this->container['organization_description'] = $organization_description;

        return $this;
    }

    /**
     * Gets organization_categories
     *
     * @return string[]
     */
    public function getOrganizationCategories()
    {
        return $this->container['organization_categories'];
    }

    /**
     * Sets organization_categories
     *
     * @param string[] $organization_categories organization_categories
     *
     * @return $this
     */
    public function setOrganizationCategories($organization_categories)
    {
        $this->container['organization_categories'] = $organization_categories;

        return $this;
    }

    /**
     * Gets organization_types
     *
     * @return string[]
     */
    public function getOrganizationTypes()
    {
        return $this->container['organization_types'];
    }

    /**
     * Sets organization_types
     *
     * @param string[] $organization_types organization_types
     *
     * @return $this
     */
    public function setOrganizationTypes($organization_types)
    {
        $this->container['organization_types'] = $organization_types;

        return $this;
    }

    /**
     * Gets organization_zip_codes
     *
     * @return string[]
     */
    public function getOrganizationZipCodes()
    {
        return $this->container['organization_zip_codes'];
    }

    /**
     * Sets organization_zip_codes
     *
     * @param string[] $organization_zip_codes organization_zip_codes
     *
     * @return $this
     */
    public function setOrganizationZipCodes($organization_zip_codes)
    {
        $this->container['organization_zip_codes'] = $organization_zip_codes;

        return $this;
    }

    /**
     * Gets organization_cities
     *
     * @return string[]
     */
    public function getOrganizationCities()
    {
        return $this->container['organization_cities'];
    }

    /**
     * Sets organization_cities
     *
     * @param string[] $organization_cities organization_cities
     *
     * @return $this
     */
    public function setOrganizationCities($organization_cities)
    {
        $this->container['organization_cities'] = $organization_cities;

        return $this;
    }

    /**
     * Gets organization_regions
     *
     * @return string[]
     */
    public function getOrganizationRegions()
    {
        return $this->container['organization_regions'];
    }

    /**
     * Sets organization_regions
     *
     * @param string[] $organization_regions organization_regions
     *
     * @return $this
     */
    public function setOrganizationRegions($organization_regions)
    {
        $this->container['organization_regions'] = $organization_regions;

        return $this;
    }

    /**
     * Gets organization_departments
     *
     * @return string[]
     */
    public function getOrganizationDepartments()
    {
        return $this->container['organization_departments'];
    }

    /**
     * Sets organization_departments
     *
     * @param string[] $organization_departments organization_departments
     *
     * @return $this
     */
    public function setOrganizationDepartments($organization_departments)
    {
        $this->container['organization_departments'] = $organization_departments;

        return $this;
    }

    /**
     * Gets organization_fiscal_receipt_eligibility
     *
     * @return bool
     */
    public function getOrganizationFiscalReceiptEligibility()
    {
        return $this->container['organization_fiscal_receipt_eligibility'];
    }

    /**
     * Sets organization_fiscal_receipt_eligibility
     *
     * @param bool $organization_fiscal_receipt_eligibility organization_fiscal_receipt_eligibility
     *
     * @return $this
     */
    public function setOrganizationFiscalReceiptEligibility($organization_fiscal_receipt_eligibility)
    {
        $this->container['organization_fiscal_receipt_eligibility'] = $organization_fiscal_receipt_eligibility;

        return $this;
    }

    /**
     * Gets organization_linked_partners
     *
     * @return string[]
     */
    public function getOrganizationLinkedPartners()
    {
        return $this->container['organization_linked_partners'];
    }

    /**
     * Sets organization_linked_partners
     *
     * @param string[] $organization_linked_partners organization_linked_partners
     *
     * @return $this
     */
    public function setOrganizationLinkedPartners($organization_linked_partners)
    {
        $this->container['organization_linked_partners'] = $organization_linked_partners;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


