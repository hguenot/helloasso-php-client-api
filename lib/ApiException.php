<?php
/**
 * ApiException
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

namespace fr\helloasso\v5;

use \Exception;

/**
 * ApiException Class Doc Comment
 *
 * @category Class
 * @package  fr\helloasso\v5
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ApiException extends Exception
{

    /**
     * The HTTP body of the server response either as Json or string.
     *
     * @var mixed
     */
    protected $responseBody;

    /**
     * The HTTP header of the server response.
     *
     * @var string[]|null
     */
    protected $responseHeaders;

    /**
     * The deserialized response object
     *
     * @var $responseObject;
     */
    protected $responseObject;

    /**
     * Constructor
     *
     * @param string        $message         Error message
     * @param int           $code            HTTP status code
     * @param string[]|null $responseHeaders HTTP response header
     * @param mixed         $responseBody    HTTP decoded body of the server response either as \stdClass or string
     */
    public function __construct($message = "", $code = 0, $responseHeaders = [], $responseBody = null)
    {
        parent::__construct($message, $code);
        $this->responseHeaders = $responseHeaders;
        $this->responseBody = $responseBody;
    }

    /**
     * Gets the HTTP response header
     *
     * @return string[]|null HTTP response header
     */
    public function getResponseHeaders()
    {
        return $this->responseHeaders;
    }

    /**
     * Gets the HTTP body of the server response either as Json or string
     *
     * @return mixed HTTP body of the server response either as \stdClass or string
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }

    /**
     * Sets the deseralized response object (during deserialization)
     *
     * @param mixed $obj Deserialized response object
     *
     * @return void
     */
    public function setResponseObject($obj)
    {
        $this->responseObject = $obj;
    }

    /**
     * Gets the deseralized response object (during deserialization)
     *
     * @return mixed the deserialized response object
     */
    public function getResponseObject()
    {
        return $this->responseObject;
    }
}
