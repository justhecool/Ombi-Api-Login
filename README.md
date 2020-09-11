# Ombi Api Login
 Simple, alternative login page for [Ombi](https://github.com/tidusjar/Ombi). With added ability to ask users to access to your plex server by [PHPMailer](https://github.com/PHPMailer/PHPMailer);
 Uses JWT to auth in localstorage. [JWT-Decode](https://github.com/auth0/jwt-decode)
 
__Important:__ The login currently assumes the option 'Allow users to login without a password' is on inside your Ombi installation, later functionality will support without that option enabled.
## Installation
Simply download the files and place them on your webserver and change the values inside of config.php
## Usage
~~~PHP
    'domain' => 'https://example.com',
    // URL to your Ombi installation
    'request_url' => 'https://examples.com/requests/',
    // Ombi API Url
    'api_url' => 'https://example.com/requests/api/v1',
    // Email Purposes
    // host (gmail), name, email, password
    'host' => 'smtp.gmail.com',
    'name' => 'John',
    'full_name' => 'John Doe',
    'email' => '@gmail.com',
    'password' => 'your email password',
~~~~
## Example Website
Check out [Plex-Requests](https://plex-requests.tk) to see the design/functionality (Uikit + Semantic Ui).
