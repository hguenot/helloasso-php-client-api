<?php
/**
 * StatisticsItemDetail
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
 * StatisticsItemDetail Class Doc Comment
 *
 * @category Class
 * @package  fr\helloasso\v5
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class StatisticsItemDetail implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Statistics.ItemDetail';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'order' => '\fr\helloasso\v5\model\StatisticsOrderLight',
        'payer' => '\fr\helloasso\v5\model\StatisticsPayer',
        'payments' => '\fr\helloasso\v5\model\StatisticsItemPayment[]',
        'name' => 'string',
        'user' => '\fr\helloasso\v5\model\StatisticsUser',
        'price_category' => '\fr\helloasso\v5\model\EnumsPriceCategory',
        'min_amount' => 'int',
        'discount' => '\fr\helloasso\v5\model\StatisticsItemDiscount',
        'custom_fields' => '\fr\helloasso\v5\model\StatisticsItemCustomField[]',
        'options' => '\fr\helloasso\v5\model\StatisticsItemOption[]',
        'ticket_url' => 'string',
        'qr_code' => 'string',
        'membership_card_url' => 'string',
        'day_of_levy' => 'int',
        'tier_description' => 'string',
        'tier_id' => 'int',
        'comment' => 'string',
        'id' => 'int',
        'amount' => 'int',
        'type' => '\fr\helloasso\v5\model\EnumsTierType',
        'initial_amount' => 'int',
        'state' => '\fr\helloasso\v5\model\EnumsItemState'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'order' => null,
        'payer' => null,
        'payments' => null,
        'name' => null,
        'user' => null,
        'price_category' => null,
        'min_amount' => 'int32',
        'discount' => null,
        'custom_fields' => null,
        'options' => null,
        'ticket_url' => null,
        'qr_code' => null,
        'membership_card_url' => null,
        'day_of_levy' => 'int32',
        'tier_description' => null,
        'tier_id' => 'int32',
        'comment' => null,
        'id' => 'int32',
        'amount' => 'int32',
        'type' => null,
        'initial_amount' => 'int32',
        'state' => null
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
        'order' => 'order',
        'payer' => 'payer',
        'payments' => 'payments',
        'name' => 'name',
        'user' => 'user',
        'price_category' => 'priceCategory',
        'min_amount' => 'minAmount',
        'discount' => 'discount',
        'custom_fields' => 'customFields',
        'options' => 'options',
        'ticket_url' => 'ticketUrl',
        'qr_code' => 'qrCode',
        'membership_card_url' => 'membershipCardUrl',
        'day_of_levy' => 'dayOfLevy',
        'tier_description' => 'tierDescription',
        'tier_id' => 'tierId',
        'comment' => 'comment',
        'id' => 'id',
        'amount' => 'amount',
        'type' => 'type',
        'initial_amount' => 'initialAmount',
        'state' => 'state'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'order' => 'setOrder',
        'payer' => 'setPayer',
        'payments' => 'setPayments',
        'name' => 'setName',
        'user' => 'setUser',
        'price_category' => 'setPriceCategory',
        'min_amount' => 'setMinAmount',
        'discount' => 'setDiscount',
        'custom_fields' => 'setCustomFields',
        'options' => 'setOptions',
        'ticket_url' => 'setTicketUrl',
        'qr_code' => 'setQrCode',
        'membership_card_url' => 'setMembershipCardUrl',
        'day_of_levy' => 'setDayOfLevy',
        'tier_description' => 'setTierDescription',
        'tier_id' => 'setTierId',
        'comment' => 'setComment',
        'id' => 'setId',
        'amount' => 'setAmount',
        'type' => 'setType',
        'initial_amount' => 'setInitialAmount',
        'state' => 'setState'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'order' => 'getOrder',
        'payer' => 'getPayer',
        'payments' => 'getPayments',
        'name' => 'getName',
        'user' => 'getUser',
        'price_category' => 'getPriceCategory',
        'min_amount' => 'getMinAmount',
        'discount' => 'getDiscount',
        'custom_fields' => 'getCustomFields',
        'options' => 'getOptions',
        'ticket_url' => 'getTicketUrl',
        'qr_code' => 'getQrCode',
        'membership_card_url' => 'getMembershipCardUrl',
        'day_of_levy' => 'getDayOfLevy',
        'tier_description' => 'getTierDescription',
        'tier_id' => 'getTierId',
        'comment' => 'getComment',
        'id' => 'getId',
        'amount' => 'getAmount',
        'type' => 'getType',
        'initial_amount' => 'getInitialAmount',
        'state' => 'getState'
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
        $this->container['order'] = isset($data['order']) ? $data['order'] : null;
        $this->container['payer'] = isset($data['payer']) ? $data['payer'] : null;
        $this->container['payments'] = isset($data['payments']) ? $data['payments'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['user'] = isset($data['user']) ? $data['user'] : null;
        $this->container['price_category'] = isset($data['price_category']) ? $data['price_category'] : null;
        $this->container['min_amount'] = isset($data['min_amount']) ? $data['min_amount'] : null;
        $this->container['discount'] = isset($data['discount']) ? $data['discount'] : null;
        $this->container['custom_fields'] = isset($data['custom_fields']) ? $data['custom_fields'] : null;
        $this->container['options'] = isset($data['options']) ? $data['options'] : null;
        $this->container['ticket_url'] = isset($data['ticket_url']) ? $data['ticket_url'] : null;
        $this->container['qr_code'] = isset($data['qr_code']) ? $data['qr_code'] : null;
        $this->container['membership_card_url'] = isset($data['membership_card_url']) ? $data['membership_card_url'] : null;
        $this->container['day_of_levy'] = isset($data['day_of_levy']) ? $data['day_of_levy'] : null;
        $this->container['tier_description'] = isset($data['tier_description']) ? $data['tier_description'] : null;
        $this->container['tier_id'] = isset($data['tier_id']) ? $data['tier_id'] : null;
        $this->container['comment'] = isset($data['comment']) ? $data['comment'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['amount'] = isset($data['amount']) ? $data['amount'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['initial_amount'] = isset($data['initial_amount']) ? $data['initial_amount'] : null;
        $this->container['state'] = isset($data['state']) ? $data['state'] : null;
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
     * Gets order
     *
     * @return \fr\helloasso\v5\model\StatisticsOrderLight
     */
    public function getOrder()
    {
        return $this->container['order'];
    }

    /**
     * Sets order
     *
     * @param \fr\helloasso\v5\model\StatisticsOrderLight $order order
     *
     * @return $this
     */
    public function setOrder($order)
    {
        $this->container['order'] = $order;

        return $this;
    }

    /**
     * Gets payer
     *
     * @return \fr\helloasso\v5\model\StatisticsPayer
     */
    public function getPayer()
    {
        return $this->container['payer'];
    }

    /**
     * Sets payer
     *
     * @param \fr\helloasso\v5\model\StatisticsPayer $payer payer
     *
     * @return $this
     */
    public function setPayer($payer)
    {
        $this->container['payer'] = $payer;

        return $this;
    }

    /**
     * Gets payments
     *
     * @return \fr\helloasso\v5\model\StatisticsItemPayment[]
     */
    public function getPayments()
    {
        return $this->container['payments'];
    }

    /**
     * Sets payments
     *
     * @param \fr\helloasso\v5\model\StatisticsItemPayment[] $payments payments
     *
     * @return $this
     */
    public function setPayments($payments)
    {
        $this->container['payments'] = $payments;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets user
     *
     * @return \fr\helloasso\v5\model\StatisticsUser
     */
    public function getUser()
    {
        return $this->container['user'];
    }

    /**
     * Sets user
     *
     * @param \fr\helloasso\v5\model\StatisticsUser $user user
     *
     * @return $this
     */
    public function setUser($user)
    {
        $this->container['user'] = $user;

        return $this;
    }

    /**
     * Gets price_category
     *
     * @return \fr\helloasso\v5\model\EnumsPriceCategory
     */
    public function getPriceCategory()
    {
        return $this->container['price_category'];
    }

    /**
     * Sets price_category
     *
     * @param \fr\helloasso\v5\model\EnumsPriceCategory $price_category price_category
     *
     * @return $this
     */
    public function setPriceCategory($price_category)
    {
        $this->container['price_category'] = $price_category;

        return $this;
    }

    /**
     * Gets min_amount
     *
     * @return int
     */
    public function getMinAmount()
    {
        return $this->container['min_amount'];
    }

    /**
     * Sets min_amount
     *
     * @param int $min_amount min_amount
     *
     * @return $this
     */
    public function setMinAmount($min_amount)
    {
        $this->container['min_amount'] = $min_amount;

        return $this;
    }

    /**
     * Gets discount
     *
     * @return \fr\helloasso\v5\model\StatisticsItemDiscount
     */
    public function getDiscount()
    {
        return $this->container['discount'];
    }

    /**
     * Sets discount
     *
     * @param \fr\helloasso\v5\model\StatisticsItemDiscount $discount discount
     *
     * @return $this
     */
    public function setDiscount($discount)
    {
        $this->container['discount'] = $discount;

        return $this;
    }

    /**
     * Gets custom_fields
     *
     * @return \fr\helloasso\v5\model\StatisticsItemCustomField[]
     */
    public function getCustomFields()
    {
        return $this->container['custom_fields'];
    }

    /**
     * Sets custom_fields
     *
     * @param \fr\helloasso\v5\model\StatisticsItemCustomField[] $custom_fields custom_fields
     *
     * @return $this
     */
    public function setCustomFields($custom_fields)
    {
        $this->container['custom_fields'] = $custom_fields;

        return $this;
    }

    /**
     * Gets options
     *
     * @return \fr\helloasso\v5\model\StatisticsItemOption[]
     */
    public function getOptions()
    {
        return $this->container['options'];
    }

    /**
     * Sets options
     *
     * @param \fr\helloasso\v5\model\StatisticsItemOption[] $options options
     *
     * @return $this
     */
    public function setOptions($options)
    {
        $this->container['options'] = $options;

        return $this;
    }

    /**
     * Gets ticket_url
     *
     * @return string
     */
    public function getTicketUrl()
    {
        return $this->container['ticket_url'];
    }

    /**
     * Sets ticket_url
     *
     * @param string $ticket_url ticket_url
     *
     * @return $this
     */
    public function setTicketUrl($ticket_url)
    {
        $this->container['ticket_url'] = $ticket_url;

        return $this;
    }

    /**
     * Gets qr_code
     *
     * @return string
     */
    public function getQrCode()
    {
        return $this->container['qr_code'];
    }

    /**
     * Sets qr_code
     *
     * @param string $qr_code qr_code
     *
     * @return $this
     */
    public function setQrCode($qr_code)
    {
        $this->container['qr_code'] = $qr_code;

        return $this;
    }

    /**
     * Gets membership_card_url
     *
     * @return string
     */
    public function getMembershipCardUrl()
    {
        return $this->container['membership_card_url'];
    }

    /**
     * Sets membership_card_url
     *
     * @param string $membership_card_url membership_card_url
     *
     * @return $this
     */
    public function setMembershipCardUrl($membership_card_url)
    {
        $this->container['membership_card_url'] = $membership_card_url;

        return $this;
    }

    /**
     * Gets day_of_levy
     *
     * @return int
     */
    public function getDayOfLevy()
    {
        return $this->container['day_of_levy'];
    }

    /**
     * Sets day_of_levy
     *
     * @param int $day_of_levy day_of_levy
     *
     * @return $this
     */
    public function setDayOfLevy($day_of_levy)
    {
        $this->container['day_of_levy'] = $day_of_levy;

        return $this;
    }

    /**
     * Gets tier_description
     *
     * @return string
     */
    public function getTierDescription()
    {
        return $this->container['tier_description'];
    }

    /**
     * Sets tier_description
     *
     * @param string $tier_description tier_description
     *
     * @return $this
     */
    public function setTierDescription($tier_description)
    {
        $this->container['tier_description'] = $tier_description;

        return $this;
    }

    /**
     * Gets tier_id
     *
     * @return int
     */
    public function getTierId()
    {
        return $this->container['tier_id'];
    }

    /**
     * Sets tier_id
     *
     * @param int $tier_id tier_id
     *
     * @return $this
     */
    public function setTierId($tier_id)
    {
        $this->container['tier_id'] = $tier_id;

        return $this;
    }

    /**
     * Gets comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->container['comment'];
    }

    /**
     * Sets comment
     *
     * @param string $comment comment
     *
     * @return $this
     */
    public function setComment($comment)
    {
        $this->container['comment'] = $comment;

        return $this;
    }

    /**
     * Gets id
     *
     * @return int
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int $id id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets amount
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount
     *
     * @param int $amount amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets type
     *
     * @return \fr\helloasso\v5\model\EnumsTierType
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param \fr\helloasso\v5\model\EnumsTierType $type type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets initial_amount
     *
     * @return int
     */
    public function getInitialAmount()
    {
        return $this->container['initial_amount'];
    }

    /**
     * Sets initial_amount
     *
     * @param int $initial_amount initial_amount
     *
     * @return $this
     */
    public function setInitialAmount($initial_amount)
    {
        $this->container['initial_amount'] = $initial_amount;

        return $this;
    }

    /**
     * Gets state
     *
     * @return \fr\helloasso\v5\model\EnumsItemState
     */
    public function getState()
    {
        return $this->container['state'];
    }

    /**
     * Sets state
     *
     * @param \fr\helloasso\v5\model\EnumsItemState $state state
     *
     * @return $this
     */
    public function setState($state)
    {
        $this->container['state'] = $state;

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


