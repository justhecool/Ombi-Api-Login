# Ombi Api Login
 Simple, alternative login page for Ombi. With added ability to ask users to access to your plex server by [PHPMailer](https://github.com/PHPMailer/PHPMailer);
 Uses JWT to auth in junction with localstorage. [JWT-Decode](https://github.com/auth0/jwt-decode)
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
   
