<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
include __DIR__ . '/functions.php';
include __DIR__ .'/mail.php';
$ip = $_SERVER['REMOTE_ADDR'] . PHP_EOL;
 $iplog = __DIR__ . '/ip.txt';
 $file = file_get_contents($iplog);
$api = new Api();
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	    //join
	     if (isset($_POST['remail'])) {
        $username = $_POST['rusername'];
        $email = $_POST['remail'];
        if (email($username, $email) == true) {
            file_put_contents("ip.txt", "$ip", FILE_APPEND);
            $response['success'] = true;
        } else {
            //failed to send email
            $response['msg'] = 'There was an issue, please try again..';
            $response['success'] = false;
        }
        echo json_encode($response);
    	}
	    //login

	    $uname = $_POST['username'];
	    $pw = $_POST["pwd"];
        if (isset($uname)) {
            $token = $api->getToken($uname, $pw);
            $json = json_decode($token, true);
            if ($token !== null && $json['access_token'] !== null) {
                $response['token'] = $json['access_token'];
                //WIP
                //TODO use API
                if ($uname == 'justhecool' xor $uname == 'Justhecool'){
	                $response['url'] = '/admin';}
	            else
	            {$response['url'] ='/requests/discover';}
                $response['success'] = true;
                echo json_encode($response);

            } else {
                $errors = $api->getLastErrors();
                $error = json_encode($errors);
                if ($uname == 'justhecool' xor $uname == 'Justhecool'){
	                $response['g_auth'] = true;
                } elseif ($errors == false) {
                    $response['success'] = false;
                    $response['msg'] = 'Incorrect username. Please try again.';
                }
               // var_dump($errors);
                echo json_encode($response);
            }
        }
    } else
    {$api->get('header', 1);?>
        <body>
        <div class=" uk-text-center uk-flex uk-flex-center  uk-grid-margin-large" >
	        	            <div style="margin-top:5em;">
            <div class="uk-container uk-flex-middle ">
          <div class="ui active inverted  dimmer" style="display:none">
              <div class="ui loader"></div>
          </div>
                <div class="uk-card uk-card-default uk-card-body login-box">
	                <img src="images/plex-requests.png"/>
                    <form id="appLogin" method="post">
                        <div class="uk-margin">
                            <div class="uk-inline ui icon input">
                            <span class="uk-form-icon" uk-icon="icon: user"></span>
                            <input class="uk-input" name="username" type="text" id="username" autocomplete="user-name" placeholder="Plex Username">
                            </div><i class="circular info link icon"></i>
                        </div>
                        <div class="uk-margin">
                        </div>
                      <input name="pwd" value="" id="password" type="hidden">
                    </form>
            <div class="uk-width-expand@m">
	            <button class="ui blue basic button join">
                <i class="icon user plus"></i>
                    Join
                </button>
                <button onclick="login()" class="ui green basic button">
                <i class="icon sign-in"></i>
                    Sign In
                </button>
            </div>
        </div>
        <div class="uk-card uk-card-default uk-card-body join-box" style="display:none;">
                    <h3 class="mdl-dialog__title">Join<br/> <?php echo $api->getConfig('name');?>'s Plex Server</h3>
                    <form id="appJoin" action="" method="post">
	                    <div class="uk-margin">
                            <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: user"></span>
                            <input class="uk-input" name="rusername" type="text" id="name" autocomplete="given-name" placeholder="Name">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: info"></span>
                            <input class="uk-input" type="email" name="remail" autocomplete="email" placeholder="Email">
                            </div>
                        </div>
                    </form>
            <div class="uk-width-expand@m">
	            <button  class="ui blue  basic button login">
                <i class="icon sign-in"></i>
                    Sign In
                </button>
                <button type="submit" form="appJoin" class="ui green basic button join">
                <i class="icon user plus"></i>
                    Join
                </button>
            </div>
        </div>
        <div class="uk-card uk-card-default uk-card-body forgot-box" style="display:none;">
                    <h3 class="mdl-dialog__title">Forgot Password</h3>
                    <h3 class="mdl-dialog__sub_title">Simply enter your username or email.</h3>
                    <form id="appForgot" method="post">
                        <div class="uk-margin">
                            <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: info"></span>
                            <input class="uk-input" type="email" name="forgot" autocomplete="email" placeholder="Email or Username">
                            </div>
                        </div>
                    </form>
            <div class="uk-width-expand@m">
                <button  class="ui blue basic button login">
                <i class="icon sign-in"></i>
                    Sign In
                </button>
                <button onclick="forgot()" class="ui green basic button ">
                <i class="icon send"></i>
                    Submit
                </button>
            </div>
        </div>
                  </div>
        </div>
        </body>
        <?php  $api->get('footer', 1);
	         if ( preg_match("/$ip/", $file )) { ?><script type="text/javascript">msg();</script><?php }
	} // end else
?>
