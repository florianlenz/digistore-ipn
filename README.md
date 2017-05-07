# Digistore IPN (Instant Paypent Notification) SDK (Unofficial)

Digistore IPN documentation: https://doc.digistore24.com/technics/technical-access-to-the-system/ipn/further-information-about-the-digistore24-ipn-interface/?lang=en

## Short discription
This library will help you implementing the Digistore IPN in your application. You need a logger, the sha password and the request data.

### Getting started
In order to use the library instantiate the "DigistoreIpn" you need to inject the following:
1. The first parameter must be an instance of the monolog interface (e.g a Monolog instance).
2. The second parameter must be a string and is the password you entered in the Digsitore backend to generate the sha512 sign.
3. The third parameter must be the raw request data from digistore as an array (e.g $_GET)

    New DigistoreIpn(new NullLogger(), 'password', $requestData)

### Add event handler
Depending on an digistore event you want to perform an action. In order to do so, add an event handler. An event handler must implement the EventHandlerInterface.

    // Your event handler
    class OnPaymentEventHandler implements EventHandlerInterface
    {

        public function handle(array $requestData)
        {
            //The stuff you want to do e.g. create user
        }

    }

    $ipn = new DigistoreIpn(new NullLogger, 'my_password', $_GET);
    $ipn->addEventHandler(DigistoreEvents::EVENT_ON_PAYMENT, new OnPaymentEventHandler());

Call "->handle()" to handle the digistore data and the event

    $ipn->handle();


### Use a custom authenticator
The default authenticator is the "Sha512Authenticator" to validate the request via the sha sign send by digistore. Its recommended to work with the default on. An important note is,
Important note: If the request is not allowed and AccessDeniedException will be thrown




If you want to set a custom authenticator see below:

    //You custom authenticator
    class MyAuthenticator implements DigistoreAuthenticatorInterface
    {

        public function auth(string $shaSign, array $requestData)
        {
            //Your logic to validate that the request is allowed
        }

    }

    $ipn = new DigistoreIpn(new NullLogger, 'my_password', $_GET);
    $ipn->setAuthenticator(new MyAuthenticator());

### Use a custom request data validator
The default StandardRequestDataValidator will check if

* order_id
* product_id
* email
* event
* sha_sign

are in the request and will throw an MissingDataException exception if on of those keys is missing.

Use a custom one:

    class MyDataValidator impements RequestDataValidatorInterface
    {

        public function validate(array $data) : bool
        {
            //Perform your custom validation logic
        }

    }

    $ipn = new DigistoreIpn(new NullLogger, 'my_password', $_GET);
    $ipn->setDataValidator(new MyDataValidator());


## Development
1. Clone this repo
2. Run "docker-composer exec app bash"
3. Run "cd /srv/app". Now you are at the project root in the container
4. Add your code in a new branch AND add unit tests