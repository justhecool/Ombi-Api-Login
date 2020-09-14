<?php
require_once __DIR__ . '/functions.php';
$api = new Api();
	{?>
	<div class="ui info-panel terms tiny modal">
  <div class="header">
    Welcome
  </div>
  <div class="scrolling content">
    <div class="description" style="font-size:1.4em;">
      <p>To begin simply enter your plex username this may be a email or a unique name.</p><p>If you ever run into problems, don't hesitate to contact me :)</p><p><i>~Your Friend, <?php echo $api->getConfig('name');?></i></p><p style="font-size: small"></p>    </div>
  </div>
</div>

<div class="ui success-msg terms tiny modal">
  <div class="header">
    Success
  </div>
  <div class="scrolling content">
    <div class="description" style="font-size:1.4em;">
      <p>I have successfully received your request, please allow me up to a day to add you to my server.</p><p>Be on the lookout for an email from Plex about an Invitation.</p><p>Be sure to check your spam box in the meantime.</p><p>Once accepted, feel free to request movies with your Plex Username (no password necessary) by using this website!</p><p><i>~Your Friend, <?php echo $api->getConfig('name');?></i></p><p style="font-size: small">If you mistyped your email, please wait a day to re-enter it. thanks!</p>    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" ></script>
<script src="js/semantic.min.js"></script>
<script src="js/uikit.min.js"></script>
<script src="js/uikit-icons.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="js/jwt-decode.min.js"></script>
<script src="js/api.min.js"></script>
<?php }?>
