<?php
/**
 * FormsFormQuickCreateRequest
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
 * FormsFormQuickCreateRequest Class Doc Comment
 *
 * @category Class
 * @package  fr\helloasso\v5
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class FormsFormQuickCreateRequest implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Forms.FormQuickCreateRequest';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'tier_list' => '\fr\helloasso\v5\model\FormsTierLightModel[]',
        'banner' => 'string',
        'description' => 'string',
        'end_date' => '\DateTime',
        'logo' => 'string',
        'private_title' => 'string',
        'start_date' => '\DateTime',
        'title' => 'string',
        'activity_type_id' => 'int',
        'place' => '\fr\helloasso\v5\model\CommonPlaceModel',
        'sale_end_date' => '\DateTime',
        'sale_start_date' => '\DateTime',
        'validity_type' => '\fr\helloasso\v5\model\EnumsMembershipValidityType',
        'accept_open_donation' => 'bool',
        'allow_comment' => 'bool',
        'amount_visible' => 'bool',
        'color' => 'string',
        'widget_button_text' => 'string',
        'contact' => '\fr\helloasso\v5\model\CommonContactModel',
        'display_contributor_name' => 'bool',
        'display_participants_count' => 'bool',
        'display_remaining_entries' => 'bool',
        'financial_goal' => 'int',
        'generate_membership_cards' => 'bool',
        'generate_tickets' => 'bool',
        'invert_descriptions' => 'bool',
        'label_conditions_and_terms_file' => 'string',
        'long_description' => 'string',
        'open_donation_preset_amounts' => 'int[]',
        'personalized_message' => 'string',
        'project_beneficiaries' => 'string',
        'project_expenses_details' => 'string',
        'project_owners' => 'string',
        'project_target_country' => 'string',
        'max_entries' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'tier_list' => null,
        'banner' => null,
        'description' => null,
        'end_date' => 'date-time',
        'logo' => null,
        'private_title' => null,
        'start_date' => 'date-time',
        'title' => null,
        'activity_type_id' => 'int32',
        'place' => null,
        'sale_end_date' => 'date-time',
        'sale_start_date' => 'date-time',
        'validity_type' => null,
        'accept_open_donation' => null,
        'allow_comment' => null,
        'amount_visible' => null,
        'color' => null,
        'widget_button_text' => null,
        'contact' => null,
        'display_contributor_name' => null,
        'display_participants_count' => null,
        'display_remaining_entries' => null,
        'financial_goal' => 'int64',
        'generate_membership_cards' => null,
        'generate_tickets' => null,
        'invert_descriptions' => null,
        'label_conditions_and_terms_file' => null,
        'long_description' => null,
        'open_donation_preset_amounts' => 'int32',
        'personalized_message' => null,
        'project_beneficiaries' => null,
        'project_expenses_details' => null,
        'project_owners' => null,
        'project_target_country' => null,
        'max_entries' => 'int32'
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
        'tier_list' => 'tierList',
        'banner' => 'banner',
        'description' => 'description',
        'end_date' => 'endDate',
        'logo' => 'logo',
        'private_title' => 'privateTitle',
        'start_date' => 'startDate',
        'title' => 'title',
        'activity_type_id' => 'activityTypeId',
        'place' => 'place',
        'sale_end_date' => 'saleEndDate',
        'sale_start_date' => 'saleStartDate',
        'validity_type' => 'validityType',
        'accept_open_donation' => 'acceptOpenDonation',
        'allow_comment' => 'allowComment',
        'amount_visible' => 'amountVisible',
        'color' => 'color',
        'widget_button_text' => 'widgetButtonText',
        'contact' => 'contact',
        'display_contributor_name' => 'displayContributorName',
        'display_participants_count' => 'displayParticipantsCount',
        'display_remaining_entries' => 'displayRemainingEntries',
        'financial_goal' => 'financialGoal',
        'generate_membership_cards' => 'generateMembershipCards',
        'generate_tickets' => 'generateTickets',
        'invert_descriptions' => 'invertDescriptions',
        'label_conditions_and_terms_file' => 'labelConditionsAndTermsFile',
        'long_description' => 'longDescription',
        'open_donation_preset_amounts' => 'openDonationPresetAmounts',
        'personalized_message' => 'personalizedMessage',
        'project_beneficiaries' => 'projectBeneficiaries',
        'project_expenses_details' => 'projectExpensesDetails',
        'project_owners' => 'projectOwners',
        'project_target_country' => 'projectTargetCountry',
        'max_entries' => 'maxEntries'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'tier_list' => 'setTierList',
        'banner' => 'setBanner',
        'description' => 'setDescription',
        'end_date' => 'setEndDate',
        'logo' => 'setLogo',
        'private_title' => 'setPrivateTitle',
        'start_date' => 'setStartDate',
        'title' => 'setTitle',
        'activity_type_id' => 'setActivityTypeId',
        'place' => 'setPlace',
        'sale_end_date' => 'setSaleEndDate',
        'sale_start_date' => 'setSaleStartDate',
        'validity_type' => 'setValidityType',
        'accept_open_donation' => 'setAcceptOpenDonation',
        'allow_comment' => 'setAllowComment',
        'amount_visible' => 'setAmountVisible',
        'color' => 'setColor',
        'widget_button_text' => 'setWidgetButtonText',
        'contact' => 'setContact',
        'display_contributor_name' => 'setDisplayContributorName',
        'display_participants_count' => 'setDisplayParticipantsCount',
        'display_remaining_entries' => 'setDisplayRemainingEntries',
        'financial_goal' => 'setFinancialGoal',
        'generate_membership_cards' => 'setGenerateMembershipCards',
        'generate_tickets' => 'setGenerateTickets',
        'invert_descriptions' => 'setInvertDescriptions',
        'label_conditions_and_terms_file' => 'setLabelConditionsAndTermsFile',
        'long_description' => 'setLongDescription',
        'open_donation_preset_amounts' => 'setOpenDonationPresetAmounts',
        'personalized_message' => 'setPersonalizedMessage',
        'project_beneficiaries' => 'setProjectBeneficiaries',
        'project_expenses_details' => 'setProjectExpensesDetails',
        'project_owners' => 'setProjectOwners',
        'project_target_country' => 'setProjectTargetCountry',
        'max_entries' => 'setMaxEntries'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'tier_list' => 'getTierList',
        'banner' => 'getBanner',
        'description' => 'getDescription',
        'end_date' => 'getEndDate',
        'logo' => 'getLogo',
        'private_title' => 'getPrivateTitle',
        'start_date' => 'getStartDate',
        'title' => 'getTitle',
        'activity_type_id' => 'getActivityTypeId',
        'place' => 'getPlace',
        'sale_end_date' => 'getSaleEndDate',
        'sale_start_date' => 'getSaleStartDate',
        'validity_type' => 'getValidityType',
        'accept_open_donation' => 'getAcceptOpenDonation',
        'allow_comment' => 'getAllowComment',
        'amount_visible' => 'getAmountVisible',
        'color' => 'getColor',
        'widget_button_text' => 'getWidgetButtonText',
        'contact' => 'getContact',
        'display_contributor_name' => 'getDisplayContributorName',
        'display_participants_count' => 'getDisplayParticipantsCount',
        'display_remaining_entries' => 'getDisplayRemainingEntries',
        'financial_goal' => 'getFinancialGoal',
        'generate_membership_cards' => 'getGenerateMembershipCards',
        'generate_tickets' => 'getGenerateTickets',
        'invert_descriptions' => 'getInvertDescriptions',
        'label_conditions_and_terms_file' => 'getLabelConditionsAndTermsFile',
        'long_description' => 'getLongDescription',
        'open_donation_preset_amounts' => 'getOpenDonationPresetAmounts',
        'personalized_message' => 'getPersonalizedMessage',
        'project_beneficiaries' => 'getProjectBeneficiaries',
        'project_expenses_details' => 'getProjectExpensesDetails',
        'project_owners' => 'getProjectOwners',
        'project_target_country' => 'getProjectTargetCountry',
        'max_entries' => 'getMaxEntries'
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
        $this->container['tier_list'] = isset($data['tier_list']) ? $data['tier_list'] : null;
        $this->container['banner'] = isset($data['banner']) ? $data['banner'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['end_date'] = isset($data['end_date']) ? $data['end_date'] : null;
        $this->container['logo'] = isset($data['logo']) ? $data['logo'] : null;
        $this->container['private_title'] = isset($data['private_title']) ? $data['private_title'] : null;
        $this->container['start_date'] = isset($data['start_date']) ? $data['start_date'] : null;
        $this->container['title'] = isset($data['title']) ? $data['title'] : null;
        $this->container['activity_type_id'] = isset($data['activity_type_id']) ? $data['activity_type_id'] : null;
        $this->container['place'] = isset($data['place']) ? $data['place'] : null;
        $this->container['sale_end_date'] = isset($data['sale_end_date']) ? $data['sale_end_date'] : null;
        $this->container['sale_start_date'] = isset($data['sale_start_date']) ? $data['sale_start_date'] : null;
        $this->container['validity_type'] = isset($data['validity_type']) ? $data['validity_type'] : null;
        $this->container['accept_open_donation'] = isset($data['accept_open_donation']) ? $data['accept_open_donation'] : null;
        $this->container['allow_comment'] = isset($data['allow_comment']) ? $data['allow_comment'] : null;
        $this->container['amount_visible'] = isset($data['amount_visible']) ? $data['amount_visible'] : null;
        $this->container['color'] = isset($data['color']) ? $data['color'] : null;
        $this->container['widget_button_text'] = isset($data['widget_button_text']) ? $data['widget_button_text'] : null;
        $this->container['contact'] = isset($data['contact']) ? $data['contact'] : null;
        $this->container['display_contributor_name'] = isset($data['display_contributor_name']) ? $data['display_contributor_name'] : null;
        $this->container['display_participants_count'] = isset($data['display_participants_count']) ? $data['display_participants_count'] : null;
        $this->container['display_remaining_entries'] = isset($data['display_remaining_entries']) ? $data['display_remaining_entries'] : null;
        $this->container['financial_goal'] = isset($data['financial_goal']) ? $data['financial_goal'] : null;
        $this->container['generate_membership_cards'] = isset($data['generate_membership_cards']) ? $data['generate_membership_cards'] : null;
        $this->container['generate_tickets'] = isset($data['generate_tickets']) ? $data['generate_tickets'] : null;
        $this->container['invert_descriptions'] = isset($data['invert_descriptions']) ? $data['invert_descriptions'] : null;
        $this->container['label_conditions_and_terms_file'] = isset($data['label_conditions_and_terms_file']) ? $data['label_conditions_and_terms_file'] : null;
        $this->container['long_description'] = isset($data['long_description']) ? $data['long_description'] : null;
        $this->container['open_donation_preset_amounts'] = isset($data['open_donation_preset_amounts']) ? $data['open_donation_preset_amounts'] : null;
        $this->container['personalized_message'] = isset($data['personalized_message']) ? $data['personalized_message'] : null;
        $this->container['project_beneficiaries'] = isset($data['project_beneficiaries']) ? $data['project_beneficiaries'] : null;
        $this->container['project_expenses_details'] = isset($data['project_expenses_details']) ? $data['project_expenses_details'] : null;
        $this->container['project_owners'] = isset($data['project_owners']) ? $data['project_owners'] : null;
        $this->container['project_target_country'] = isset($data['project_target_country']) ? $data['project_target_country'] : null;
        $this->container['max_entries'] = isset($data['max_entries']) ? $data['max_entries'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['title'] === null) {
            $invalidProperties[] = "'title' can't be null";
        }
        if (!is_null($this->container['project_target_country']) && (mb_strlen($this->container['project_target_country']) > 3)) {
            $invalidProperties[] = "invalid value for 'project_target_country', the character length must be smaller than or equal to 3.";
        }

        if (!is_null($this->container['project_target_country']) && (mb_strlen($this->container['project_target_country']) < 3)) {
            $invalidProperties[] = "invalid value for 'project_target_country', the character length must be bigger than or equal to 3.";
        }

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
     * Gets tier_list
     *
     * @return \fr\helloasso\v5\model\FormsTierLightModel[]
     */
    public function getTierList()
    {
        return $this->container['tier_list'];
    }

    /**
     * Sets tier_list
     *
     * @param \fr\helloasso\v5\model\FormsTierLightModel[] $tier_list tier_list
     *
     * @return $this
     */
    public function setTierList($tier_list)
    {
        $this->container['tier_list'] = $tier_list;

        return $this;
    }

    /**
     * Gets banner
     *
     * @return string
     */
    public function getBanner()
    {
        return $this->container['banner'];
    }

    /**
     * Sets banner
     *
     * @param string $banner banner
     *
     * @return $this
     */
    public function setBanner($banner)
    {
        $this->container['banner'] = $banner;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets end_date
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->container['end_date'];
    }

    /**
     * Sets end_date
     *
     * @param \DateTime $end_date end_date
     *
     * @return $this
     */
    public function setEndDate($end_date)
    {
        $this->container['end_date'] = $end_date;

        return $this;
    }

    /**
     * Gets logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->container['logo'];
    }

    /**
     * Sets logo
     *
     * @param string $logo logo
     *
     * @return $this
     */
    public function setLogo($logo)
    {
        $this->container['logo'] = $logo;

        return $this;
    }

    /**
     * Gets private_title
     *
     * @return string
     */
    public function getPrivateTitle()
    {
        return $this->container['private_title'];
    }

    /**
     * Sets private_title
     *
     * @param string $private_title private_title
     *
     * @return $this
     */
    public function setPrivateTitle($private_title)
    {
        $this->container['private_title'] = $private_title;

        return $this;
    }

    /**
     * Gets start_date
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->container['start_date'];
    }

    /**
     * Sets start_date
     *
     * @param \DateTime $start_date start_date
     *
     * @return $this
     */
    public function setStartDate($start_date)
    {
        $this->container['start_date'] = $start_date;

        return $this;
    }

    /**
     * Gets title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string $title title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets activity_type_id
     *
     * @return int
     */
    public function getActivityTypeId()
    {
        return $this->container['activity_type_id'];
    }

    /**
     * Sets activity_type_id
     *
     * @param int $activity_type_id activity_type_id
     *
     * @return $this
     */
    public function setActivityTypeId($activity_type_id)
    {
        $this->container['activity_type_id'] = $activity_type_id;

        return $this;
    }

    /**
     * Gets place
     *
     * @return \fr\helloasso\v5\model\CommonPlaceModel
     */
    public function getPlace()
    {
        return $this->container['place'];
    }

    /**
     * Sets place
     *
     * @param \fr\helloasso\v5\model\CommonPlaceModel $place place
     *
     * @return $this
     */
    public function setPlace($place)
    {
        $this->container['place'] = $place;

        return $this;
    }

    /**
     * Gets sale_end_date
     *
     * @return \DateTime
     */
    public function getSaleEndDate()
    {
        return $this->container['sale_end_date'];
    }

    /**
     * Sets sale_end_date
     *
     * @param \DateTime $sale_end_date sale_end_date
     *
     * @return $this
     */
    public function setSaleEndDate($sale_end_date)
    {
        $this->container['sale_end_date'] = $sale_end_date;

        return $this;
    }

    /**
     * Gets sale_start_date
     *
     * @return \DateTime
     */
    public function getSaleStartDate()
    {
        return $this->container['sale_start_date'];
    }

    /**
     * Sets sale_start_date
     *
     * @param \DateTime $sale_start_date sale_start_date
     *
     * @return $this
     */
    public function setSaleStartDate($sale_start_date)
    {
        $this->container['sale_start_date'] = $sale_start_date;

        return $this;
    }

    /**
     * Gets validity_type
     *
     * @return \fr\helloasso\v5\model\EnumsMembershipValidityType
     */
    public function getValidityType()
    {
        return $this->container['validity_type'];
    }

    /**
     * Sets validity_type
     *
     * @param \fr\helloasso\v5\model\EnumsMembershipValidityType $validity_type validity_type
     *
     * @return $this
     */
    public function setValidityType($validity_type)
    {
        $this->container['validity_type'] = $validity_type;

        return $this;
    }

    /**
     * Gets accept_open_donation
     *
     * @return bool
     */
    public function getAcceptOpenDonation()
    {
        return $this->container['accept_open_donation'];
    }

    /**
     * Sets accept_open_donation
     *
     * @param bool $accept_open_donation accept_open_donation
     *
     * @return $this
     */
    public function setAcceptOpenDonation($accept_open_donation)
    {
        $this->container['accept_open_donation'] = $accept_open_donation;

        return $this;
    }

    /**
     * Gets allow_comment
     *
     * @return bool
     */
    public function getAllowComment()
    {
        return $this->container['allow_comment'];
    }

    /**
     * Sets allow_comment
     *
     * @param bool $allow_comment allow_comment
     *
     * @return $this
     */
    public function setAllowComment($allow_comment)
    {
        $this->container['allow_comment'] = $allow_comment;

        return $this;
    }

    /**
     * Gets amount_visible
     *
     * @return bool
     */
    public function getAmountVisible()
    {
        return $this->container['amount_visible'];
    }

    /**
     * Sets amount_visible
     *
     * @param bool $amount_visible amount_visible
     *
     * @return $this
     */
    public function setAmountVisible($amount_visible)
    {
        $this->container['amount_visible'] = $amount_visible;

        return $this;
    }

    /**
     * Gets color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->container['color'];
    }

    /**
     * Sets color
     *
     * @param string $color color
     *
     * @return $this
     */
    public function setColor($color)
    {
        $this->container['color'] = $color;

        return $this;
    }

    /**
     * Gets widget_button_text
     *
     * @return string
     */
    public function getWidgetButtonText()
    {
        return $this->container['widget_button_text'];
    }

    /**
     * Sets widget_button_text
     *
     * @param string $widget_button_text widget_button_text
     *
     * @return $this
     */
    public function setWidgetButtonText($widget_button_text)
    {
        $this->container['widget_button_text'] = $widget_button_text;

        return $this;
    }

    /**
     * Gets contact
     *
     * @return \fr\helloasso\v5\model\CommonContactModel
     */
    public function getContact()
    {
        return $this->container['contact'];
    }

    /**
     * Sets contact
     *
     * @param \fr\helloasso\v5\model\CommonContactModel $contact contact
     *
     * @return $this
     */
    public function setContact($contact)
    {
        $this->container['contact'] = $contact;

        return $this;
    }

    /**
     * Gets display_contributor_name
     *
     * @return bool
     */
    public function getDisplayContributorName()
    {
        return $this->container['display_contributor_name'];
    }

    /**
     * Sets display_contributor_name
     *
     * @param bool $display_contributor_name display_contributor_name
     *
     * @return $this
     */
    public function setDisplayContributorName($display_contributor_name)
    {
        $this->container['display_contributor_name'] = $display_contributor_name;

        return $this;
    }

    /**
     * Gets display_participants_count
     *
     * @return bool
     */
    public function getDisplayParticipantsCount()
    {
        return $this->container['display_participants_count'];
    }

    /**
     * Sets display_participants_count
     *
     * @param bool $display_participants_count display_participants_count
     *
     * @return $this
     */
    public function setDisplayParticipantsCount($display_participants_count)
    {
        $this->container['display_participants_count'] = $display_participants_count;

        return $this;
    }

    /**
     * Gets display_remaining_entries
     *
     * @return bool
     */
    public function getDisplayRemainingEntries()
    {
        return $this->container['display_remaining_entries'];
    }

    /**
     * Sets display_remaining_entries
     *
     * @param bool $display_remaining_entries display_remaining_entries
     *
     * @return $this
     */
    public function setDisplayRemainingEntries($display_remaining_entries)
    {
        $this->container['display_remaining_entries'] = $display_remaining_entries;

        return $this;
    }

    /**
     * Gets financial_goal
     *
     * @return int
     */
    public function getFinancialGoal()
    {
        return $this->container['financial_goal'];
    }

    /**
     * Sets financial_goal
     *
     * @param int $financial_goal financial_goal
     *
     * @return $this
     */
    public function setFinancialGoal($financial_goal)
    {
        $this->container['financial_goal'] = $financial_goal;

        return $this;
    }

    /**
     * Gets generate_membership_cards
     *
     * @return bool
     */
    public function getGenerateMembershipCards()
    {
        return $this->container['generate_membership_cards'];
    }

    /**
     * Sets generate_membership_cards
     *
     * @param bool $generate_membership_cards generate_membership_cards
     *
     * @return $this
     */
    public function setGenerateMembershipCards($generate_membership_cards)
    {
        $this->container['generate_membership_cards'] = $generate_membership_cards;

        return $this;
    }

    /**
     * Gets generate_tickets
     *
     * @return bool
     */
    public function getGenerateTickets()
    {
        return $this->container['generate_tickets'];
    }

    /**
     * Sets generate_tickets
     *
     * @param bool $generate_tickets generate_tickets
     *
     * @return $this
     */
    public function setGenerateTickets($generate_tickets)
    {
        $this->container['generate_tickets'] = $generate_tickets;

        return $this;
    }

    /**
     * Gets invert_descriptions
     *
     * @return bool
     */
    public function getInvertDescriptions()
    {
        return $this->container['invert_descriptions'];
    }

    /**
     * Sets invert_descriptions
     *
     * @param bool $invert_descriptions invert_descriptions
     *
     * @return $this
     */
    public function setInvertDescriptions($invert_descriptions)
    {
        $this->container['invert_descriptions'] = $invert_descriptions;

        return $this;
    }

    /**
     * Gets label_conditions_and_terms_file
     *
     * @return string
     */
    public function getLabelConditionsAndTermsFile()
    {
        return $this->container['label_conditions_and_terms_file'];
    }

    /**
     * Sets label_conditions_and_terms_file
     *
     * @param string $label_conditions_and_terms_file label_conditions_and_terms_file
     *
     * @return $this
     */
    public function setLabelConditionsAndTermsFile($label_conditions_and_terms_file)
    {
        $this->container['label_conditions_and_terms_file'] = $label_conditions_and_terms_file;

        return $this;
    }

    /**
     * Gets long_description
     *
     * @return string
     */
    public function getLongDescription()
    {
        return $this->container['long_description'];
    }

    /**
     * Sets long_description
     *
     * @param string $long_description long_description
     *
     * @return $this
     */
    public function setLongDescription($long_description)
    {
        $this->container['long_description'] = $long_description;

        return $this;
    }

    /**
     * Gets open_donation_preset_amounts
     *
     * @return int[]
     */
    public function getOpenDonationPresetAmounts()
    {
        return $this->container['open_donation_preset_amounts'];
    }

    /**
     * Sets open_donation_preset_amounts
     *
     * @param int[] $open_donation_preset_amounts open_donation_preset_amounts
     *
     * @return $this
     */
    public function setOpenDonationPresetAmounts($open_donation_preset_amounts)
    {
        $this->container['open_donation_preset_amounts'] = $open_donation_preset_amounts;

        return $this;
    }

    /**
     * Gets personalized_message
     *
     * @return string
     */
    public function getPersonalizedMessage()
    {
        return $this->container['personalized_message'];
    }

    /**
     * Sets personalized_message
     *
     * @param string $personalized_message personalized_message
     *
     * @return $this
     */
    public function setPersonalizedMessage($personalized_message)
    {
        $this->container['personalized_message'] = $personalized_message;

        return $this;
    }

    /**
     * Gets project_beneficiaries
     *
     * @return string
     */
    public function getProjectBeneficiaries()
    {
        return $this->container['project_beneficiaries'];
    }

    /**
     * Sets project_beneficiaries
     *
     * @param string $project_beneficiaries project_beneficiaries
     *
     * @return $this
     */
    public function setProjectBeneficiaries($project_beneficiaries)
    {
        $this->container['project_beneficiaries'] = $project_beneficiaries;

        return $this;
    }

    /**
     * Gets project_expenses_details
     *
     * @return string
     */
    public function getProjectExpensesDetails()
    {
        return $this->container['project_expenses_details'];
    }

    /**
     * Sets project_expenses_details
     *
     * @param string $project_expenses_details project_expenses_details
     *
     * @return $this
     */
    public function setProjectExpensesDetails($project_expenses_details)
    {
        $this->container['project_expenses_details'] = $project_expenses_details;

        return $this;
    }

    /**
     * Gets project_owners
     *
     * @return string
     */
    public function getProjectOwners()
    {
        return $this->container['project_owners'];
    }

    /**
     * Sets project_owners
     *
     * @param string $project_owners project_owners
     *
     * @return $this
     */
    public function setProjectOwners($project_owners)
    {
        $this->container['project_owners'] = $project_owners;

        return $this;
    }

    /**
     * Gets project_target_country
     *
     * @return string
     */
    public function getProjectTargetCountry()
    {
        return $this->container['project_target_country'];
    }

    /**
     * Sets project_target_country
     *
     * @param string $project_target_country project_target_country
     *
     * @return $this
     */
    public function setProjectTargetCountry($project_target_country)
    {
        if (!is_null($project_target_country) && (mb_strlen($project_target_country) > 3)) {
            throw new \InvalidArgumentException('invalid length for $project_target_country when calling FormsFormQuickCreateRequest., must be smaller than or equal to 3.');
        }
        if (!is_null($project_target_country) && (mb_strlen($project_target_country) < 3)) {
            throw new \InvalidArgumentException('invalid length for $project_target_country when calling FormsFormQuickCreateRequest., must be bigger than or equal to 3.');
        }

        $this->container['project_target_country'] = $project_target_country;

        return $this;
    }

    /**
     * Gets max_entries
     *
     * @return int
     */
    public function getMaxEntries()
    {
        return $this->container['max_entries'];
    }

    /**
     * Sets max_entries
     *
     * @param int $max_entries max_entries
     *
     * @return $this
     */
    public function setMaxEntries($max_entries)
    {
        $this->container['max_entries'] = $max_entries;

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


