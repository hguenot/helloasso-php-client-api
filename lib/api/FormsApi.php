<?php
/**
 * FormsApi
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

namespace fr\helloasso\v5\api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use fr\helloasso\v5\ApiException;
use fr\helloasso\v5\Configuration;
use fr\helloasso\v5\HeaderSelector;
use fr\helloasso\v5\ObjectSerializer;

/**
 * FormsApi Class Doc Comment
 *
 * @category Class
 * @package  fr\helloasso\v5
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class FormsApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation getFormListByOrganization
     *
     * Get the forms of a specific organization
     *
     * @param  string $organization_slug The organization Slug (required)
     * @param  object[] $states States to filter (optional)
     * @param  object[] $form_types Types to filter (optional)
     * @param  int $page_index The page of results to retrieve (optional, default to 1)
     * @param  int $page_size The number of items per page (optional, default to 20)
     * @param  string $continuation_token Continuation Token from which we wish to retrieve results (optional)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \fr\helloasso\v5\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \fr\helloasso\v5\model\CommonResultsWithPaginationModelOfFormsFormLightModel
     */
    public function getFormListByOrganization($organization_slug, $states = null, $form_types = null, $page_index = '1', $page_size = '20', $continuation_token = null, $authorization = null)
    {
        list($response) = $this->getFormListByOrganizationWithHttpInfo($organization_slug, $states, $form_types, $page_index, $page_size, $continuation_token, $authorization);
        return $response;
    }

    /**
     * Operation getFormListByOrganizationWithHttpInfo
     *
     * Get the forms of a specific organization
     *
     * @param  string $organization_slug The organization Slug (required)
     * @param  object[] $states States to filter (optional)
     * @param  object[] $form_types Types to filter (optional)
     * @param  int $page_index The page of results to retrieve (optional, default to 1)
     * @param  int $page_size The number of items per page (optional, default to 20)
     * @param  string $continuation_token Continuation Token from which we wish to retrieve results (optional)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \fr\helloasso\v5\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \fr\helloasso\v5\model\CommonResultsWithPaginationModelOfFormsFormLightModel, HTTP status code, HTTP response headers (array of strings)
     */
    public function getFormListByOrganizationWithHttpInfo($organization_slug, $states = null, $form_types = null, $page_index = '1', $page_size = '20', $continuation_token = null, $authorization = null)
    {
        $returnType = '\fr\helloasso\v5\model\CommonResultsWithPaginationModelOfFormsFormLightModel';
        $request = $this->getFormListByOrganizationRequest($organization_slug, $states, $form_types, $page_index, $page_size, $continuation_token, $authorization);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\fr\helloasso\v5\model\CommonResultsWithPaginationModelOfFormsFormLightModel',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getFormListByOrganizationAsync
     *
     * Get the forms of a specific organization
     *
     * @param  string $organization_slug The organization Slug (required)
     * @param  object[] $states States to filter (optional)
     * @param  object[] $form_types Types to filter (optional)
     * @param  int $page_index The page of results to retrieve (optional, default to 1)
     * @param  int $page_size The number of items per page (optional, default to 20)
     * @param  string $continuation_token Continuation Token from which we wish to retrieve results (optional)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getFormListByOrganizationAsync($organization_slug, $states = null, $form_types = null, $page_index = '1', $page_size = '20', $continuation_token = null, $authorization = null)
    {
        return $this->getFormListByOrganizationAsyncWithHttpInfo($organization_slug, $states, $form_types, $page_index, $page_size, $continuation_token, $authorization)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getFormListByOrganizationAsyncWithHttpInfo
     *
     * Get the forms of a specific organization
     *
     * @param  string $organization_slug The organization Slug (required)
     * @param  object[] $states States to filter (optional)
     * @param  object[] $form_types Types to filter (optional)
     * @param  int $page_index The page of results to retrieve (optional, default to 1)
     * @param  int $page_size The number of items per page (optional, default to 20)
     * @param  string $continuation_token Continuation Token from which we wish to retrieve results (optional)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getFormListByOrganizationAsyncWithHttpInfo($organization_slug, $states = null, $form_types = null, $page_index = '1', $page_size = '20', $continuation_token = null, $authorization = null)
    {
        $returnType = '\fr\helloasso\v5\model\CommonResultsWithPaginationModelOfFormsFormLightModel';
        $request = $this->getFormListByOrganizationRequest($organization_slug, $states, $form_types, $page_index, $page_size, $continuation_token, $authorization);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getFormListByOrganization'
     *
     * @param  string $organization_slug The organization Slug (required)
     * @param  object[] $states States to filter (optional)
     * @param  object[] $form_types Types to filter (optional)
     * @param  int $page_index The page of results to retrieve (optional, default to 1)
     * @param  int $page_size The number of items per page (optional, default to 20)
     * @param  string $continuation_token Continuation Token from which we wish to retrieve results (optional)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getFormListByOrganizationRequest($organization_slug, $states = null, $form_types = null, $page_index = '1', $page_size = '20', $continuation_token = null, $authorization = null)
    {
        // verify the required parameter 'organization_slug' is set
        if ($organization_slug === null || (is_array($organization_slug) && count($organization_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_slug when calling getFormListByOrganization'
            );
        }

        $resourcePath = '/organizations/{organizationSlug}/forms';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if (is_array($states)) {
            $queryParams['states'] = $states;
        } else
        if ($states !== null) {
            $queryParams['states'] = ObjectSerializer::toQueryValue($states);
        }
        // query params
        if (is_array($form_types)) {
            $queryParams['formTypes'] = $form_types;
        } else
        if ($form_types !== null) {
            $queryParams['formTypes'] = ObjectSerializer::toQueryValue($form_types);
        }
        // query params
        if ($page_index !== null) {
            $queryParams['pageIndex'] = ObjectSerializer::toQueryValue($page_index);
        }
        // query params
        if ($page_size !== null) {
            $queryParams['pageSize'] = ObjectSerializer::toQueryValue($page_size);
        }
        // query params
        if ($continuation_token !== null) {
            $queryParams['continuationToken'] = ObjectSerializer::toQueryValue($continuation_token);
        }
        // header params
        if ($authorization !== null) {
            $headerParams['Authorization'] = ObjectSerializer::toHeaderValue($authorization);
        }

        // path params
        if ($organization_slug !== null) {
            $resourcePath = str_replace(
                '{' . 'organizationSlug' . '}',
                ObjectSerializer::toPathValue($organization_slug),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'text/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'text/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getFormPublic
     *
     * Get detailed public data about a specific form
     *
     * @param  string $organization_slug organization_slug (required)
     * @param  string $form_type form_type (required)
     * @param  string $form_slug form_slug (required)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \fr\helloasso\v5\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \fr\helloasso\v5\model\FormsFormPublicModel
     */
    public function getFormPublic($organization_slug, $form_type, $form_slug, $authorization = null)
    {
        list($response) = $this->getFormPublicWithHttpInfo($organization_slug, $form_type, $form_slug, $authorization);
        return $response;
    }

    /**
     * Operation getFormPublicWithHttpInfo
     *
     * Get detailed public data about a specific form
     *
     * @param  string $organization_slug (required)
     * @param  string $form_type (required)
     * @param  string $form_slug (required)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \fr\helloasso\v5\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \fr\helloasso\v5\model\FormsFormPublicModel, HTTP status code, HTTP response headers (array of strings)
     */
    public function getFormPublicWithHttpInfo($organization_slug, $form_type, $form_slug, $authorization = null)
    {
        $returnType = '\fr\helloasso\v5\model\FormsFormPublicModel';
        $request = $this->getFormPublicRequest($organization_slug, $form_type, $form_slug, $authorization);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\fr\helloasso\v5\model\FormsFormPublicModel',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getFormPublicAsync
     *
     * Get detailed public data about a specific form
     *
     * @param  string $organization_slug (required)
     * @param  string $form_type (required)
     * @param  string $form_slug (required)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getFormPublicAsync($organization_slug, $form_type, $form_slug, $authorization = null)
    {
        return $this->getFormPublicAsyncWithHttpInfo($organization_slug, $form_type, $form_slug, $authorization)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getFormPublicAsyncWithHttpInfo
     *
     * Get detailed public data about a specific form
     *
     * @param  string $organization_slug (required)
     * @param  string $form_type (required)
     * @param  string $form_slug (required)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getFormPublicAsyncWithHttpInfo($organization_slug, $form_type, $form_slug, $authorization = null)
    {
        $returnType = '\fr\helloasso\v5\model\FormsFormPublicModel';
        $request = $this->getFormPublicRequest($organization_slug, $form_type, $form_slug, $authorization);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getFormPublic'
     *
     * @param  string $organization_slug (required)
     * @param  string $form_type (required)
     * @param  string $form_slug (required)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getFormPublicRequest($organization_slug, $form_type, $form_slug, $authorization = null)
    {
        // verify the required parameter 'organization_slug' is set
        if ($organization_slug === null || (is_array($organization_slug) && count($organization_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_slug when calling getFormPublic'
            );
        }
        // verify the required parameter 'form_type' is set
        if ($form_type === null || (is_array($form_type) && count($form_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $form_type when calling getFormPublic'
            );
        }
        // verify the required parameter 'form_slug' is set
        if ($form_slug === null || (is_array($form_slug) && count($form_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $form_slug when calling getFormPublic'
            );
        }

        $resourcePath = '/organizations/{organizationSlug}/forms/{formType}/{formSlug}/public';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($authorization !== null) {
            $headerParams['Authorization'] = ObjectSerializer::toHeaderValue($authorization);
        }

        // path params
        if ($organization_slug !== null) {
            $resourcePath = str_replace(
                '{' . 'organizationSlug' . '}',
                ObjectSerializer::toPathValue($organization_slug),
                $resourcePath
            );
        }
        // path params
        if ($form_type !== null) {
            $resourcePath = str_replace(
                '{' . 'formType' . '}',
                ObjectSerializer::toPathValue($form_type),
                $resourcePath
            );
        }
        // path params
        if ($form_slug !== null) {
            $resourcePath = str_replace(
                '{' . 'formSlug' . '}',
                ObjectSerializer::toPathValue($form_slug),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'text/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'text/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getFormTypesList
     *
     * Get a list of formTypes for an organization
     *
     * @param  string $organization_slug The organization Slug (required)
     * @param  object[] $states List of Form States to filter with. If none specified, it won&#39;t filter results. (optional)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \fr\helloasso\v5\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \fr\helloasso\v5\model\EnumsFormType[]
     */
    public function getFormTypesList($organization_slug, $states = null, $authorization = null)
    {
        list($response) = $this->getFormTypesListWithHttpInfo($organization_slug, $states, $authorization);
        return $response;
    }

    /**
     * Operation getFormTypesListWithHttpInfo
     *
     * Get a list of formTypes for an organization
     *
     * @param  string $organization_slug The organization Slug (required)
     * @param  object[] $states List of Form States to filter with. If none specified, it won&#39;t filter results. (optional)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \fr\helloasso\v5\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \fr\helloasso\v5\model\EnumsFormType[], HTTP status code, HTTP response headers (array of strings)
     */
    public function getFormTypesListWithHttpInfo($organization_slug, $states = null, $authorization = null)
    {
        $returnType = '\fr\helloasso\v5\model\EnumsFormType[]';
        $request = $this->getFormTypesListRequest($organization_slug, $states, $authorization);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\fr\helloasso\v5\model\EnumsFormType[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getFormTypesListAsync
     *
     * Get a list of formTypes for an organization
     *
     * @param  string $organization_slug The organization Slug (required)
     * @param  object[] $states List of Form States to filter with. If none specified, it won&#39;t filter results. (optional)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getFormTypesListAsync($organization_slug, $states = null, $authorization = null)
    {
        return $this->getFormTypesListAsyncWithHttpInfo($organization_slug, $states, $authorization)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getFormTypesListAsyncWithHttpInfo
     *
     * Get a list of formTypes for an organization
     *
     * @param  string $organization_slug The organization Slug (required)
     * @param  object[] $states List of Form States to filter with. If none specified, it won&#39;t filter results. (optional)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getFormTypesListAsyncWithHttpInfo($organization_slug, $states = null, $authorization = null)
    {
        $returnType = '\fr\helloasso\v5\model\EnumsFormType[]';
        $request = $this->getFormTypesListRequest($organization_slug, $states, $authorization);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getFormTypesList'
     *
     * @param  string $organization_slug The organization Slug (required)
     * @param  object[] $states List of Form States to filter with. If none specified, it won&#39;t filter results. (optional)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getFormTypesListRequest($organization_slug, $states = null, $authorization = null)
    {
        // verify the required parameter 'organization_slug' is set
        if ($organization_slug === null || (is_array($organization_slug) && count($organization_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_slug when calling getFormTypesList'
            );
        }

        $resourcePath = '/organizations/{organizationSlug}/formTypes';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if (is_array($states)) {
            $queryParams['states'] = $states;
        } else
        if ($states !== null) {
            $queryParams['states'] = ObjectSerializer::toQueryValue($states);
        }
        // header params
        if ($authorization !== null) {
            $headerParams['Authorization'] = ObjectSerializer::toHeaderValue($authorization);
        }

        // path params
        if ($organization_slug !== null) {
            $resourcePath = str_replace(
                '{' . 'organizationSlug' . '}',
                ObjectSerializer::toPathValue($organization_slug),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'text/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'text/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation postQuickCreateEvent
     *
     * Create a simplified event for an Organism
     *
     * @param  string $organization_slug The organization Slug (required)
     * @param  string $form_type The form type to create - only Event type is supported (required)
     * @param  \fr\helloasso\v5\model\FormsFormQuickCreateRequest $body The body of the request. (required)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \fr\helloasso\v5\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \fr\helloasso\v5\model\FormsFormQuickCreateModel
     */
    public function postQuickCreateEvent($organization_slug, $form_type, $body, $authorization = null)
    {
        list($response) = $this->postQuickCreateEventWithHttpInfo($organization_slug, $form_type, $body, $authorization);
        return $response;
    }

    /**
     * Operation postQuickCreateEventWithHttpInfo
     *
     * Create a simplified event for an Organism
     *
     * @param  string $organization_slug The organization Slug (required)
     * @param  string $form_type The form type to create - only Event type is supported (required)
     * @param  \fr\helloasso\v5\model\FormsFormQuickCreateRequest $body The body of the request. (required)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \fr\helloasso\v5\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \fr\helloasso\v5\model\FormsFormQuickCreateModel, HTTP status code, HTTP response headers (array of strings)
     */
    public function postQuickCreateEventWithHttpInfo($organization_slug, $form_type, $body, $authorization = null)
    {
        $returnType = '\fr\helloasso\v5\model\FormsFormQuickCreateModel';
        $request = $this->postQuickCreateEventRequest($organization_slug, $form_type, $body, $authorization);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\fr\helloasso\v5\model\FormsFormQuickCreateModel',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation postQuickCreateEventAsync
     *
     * Create a simplified event for an Organism
     *
     * @param  string $organization_slug The organization Slug (required)
     * @param  string $form_type The form type to create - only Event type is supported (required)
     * @param  \fr\helloasso\v5\model\FormsFormQuickCreateRequest $body The body of the request. (required)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function postQuickCreateEventAsync($organization_slug, $form_type, $body, $authorization = null)
    {
        return $this->postQuickCreateEventAsyncWithHttpInfo($organization_slug, $form_type, $body, $authorization)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation postQuickCreateEventAsyncWithHttpInfo
     *
     * Create a simplified event for an Organism
     *
     * @param  string $organization_slug The organization Slug (required)
     * @param  string $form_type The form type to create - only Event type is supported (required)
     * @param  \fr\helloasso\v5\model\FormsFormQuickCreateRequest $body The body of the request. (required)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function postQuickCreateEventAsyncWithHttpInfo($organization_slug, $form_type, $body, $authorization = null)
    {
        $returnType = '\fr\helloasso\v5\model\FormsFormQuickCreateModel';
        $request = $this->postQuickCreateEventRequest($organization_slug, $form_type, $body, $authorization);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'postQuickCreateEvent'
     *
     * @param  string $organization_slug The organization Slug (required)
     * @param  string $form_type The form type to create - only Event type is supported (required)
     * @param  \fr\helloasso\v5\model\FormsFormQuickCreateRequest $body The body of the request. (required)
     * @param  string $authorization You can override the JWT used fo authorization here. ie : Bearer JWT_TOKEN (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function postQuickCreateEventRequest($organization_slug, $form_type, $body, $authorization = null)
    {
        // verify the required parameter 'organization_slug' is set
        if ($organization_slug === null || (is_array($organization_slug) && count($organization_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $organization_slug when calling postQuickCreateEvent'
            );
        }
        // verify the required parameter 'form_type' is set
        if ($form_type === null || (is_array($form_type) && count($form_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $form_type when calling postQuickCreateEvent'
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling postQuickCreateEvent'
            );
        }

        $resourcePath = '/organizations/{organizationSlug}/forms/{formType}/action/quick-create';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($authorization !== null) {
            $headerParams['Authorization'] = ObjectSerializer::toHeaderValue($authorization);
        }

        // path params
        if ($organization_slug !== null) {
            $resourcePath = str_replace(
                '{' . 'organizationSlug' . '}',
                ObjectSerializer::toPathValue($organization_slug),
                $resourcePath
            );
        }
        // path params
        if ($form_type !== null) {
            $resourcePath = str_replace(
                '{' . 'formType' . '}',
                ObjectSerializer::toPathValue($form_type),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'text/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'text/json'],
                ['application/json', 'text/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
