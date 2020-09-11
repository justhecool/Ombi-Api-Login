<?php
	ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	if ($_SERVER["REMOTE_ADDR"]!='x.x.x.x'){
	header("Location: /");
die();
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1, user-scalable=yes">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="mobile-web-app-capable" content="yes">
<!-- Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#99cc00">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#99cc00"><!-- Favicon -->
<link rel="shortcut icon" type="image/png" href="/favicon.ico">
<!-- iOS Safari -->
<title>Plex Command Central</title>
<link rel='stylesheet' id='splotus-style-css'  href="/css/plex.css" type='text/css' media='all' />
</head>
<body ng-controller="Main" data-no-instant>
<div class="signal"></div>
<div id="top"></div>
                  <div class="mdl-layout__obfuscator-right-login"></div>
      <div class="mdl-layout__obfuscator-right"></div>
      <div class="splotus-content mdl-layout__content" id="main">
 <div class="article_scroll_bg">
<div class="article_bg"></div>
      <main class="mdl_main mdl-layout__content">
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
          <div class="mdl_content mdl_color--white mdl-shadow--4dp content mdl_color-text--grey-800 mdl-cell mdl-cell--8-col" >
<article id="post-45" class="post-45 page type-page status-publish hentry">
	<div class="entry-content">
		<p><div class="box alt">
					<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--4-col photo-grid">
										<span class="image fit"></div>
										<div class="mdl-cell mdl-cell--4-col photo-grid">
										<span class="image fit"><figure><img src="/images/plex-logo" rel="" alt="" /></span><a href="https://app.plex.tv/desktop"><figcaption><p>Plex</p>
										</figcaption></a></figure></div></div>
										<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--4-col photo-grid">
										<span class="image fit"><figure><img src="/images/plex-requests" rel="" alt="" /></span><a href="/requests"><figcaption><p>Requests</p>
										</figcaption></a></figure></div>
										<div class="mdl-cell mdl-cell--4-col photo-grid">
										<span class="image fit"><figure><img src="/images/sonarr" rel="" alt="" /></span><a href="/tv"><figcaption><p>TV</p>
										</figcaption></a></figure></div>											<div class="mdl-cell mdl-cell--4-col photo-grid">
										<span class="image fit"><figure><img src="/images/radarr" rel="" alt="" /></span><a href="/movies"><figcaption><p>Movies</p>
										</figcaption></a></figure></div></div>
										<div class="mdl-grid">
											<div class="mdl-cell mdl-cell--4-col photo-grid">
										<span class="image fit"><figure><img src="/images/lidarr" rel="" alt="" /></span><a href="/music"><figcaption><p>Music</p>
										</figcaption></a></figure></div>
												<div class="mdl-cell mdl-cell--4-col photo-grid">
										<span class="image fit"><figure><img src="/images/jackett" rel="" alt="" /></span><a href="/jackett"><figcaption><p>Indexers</p>
										</figcaption></a></figure></div>
										<div class="mdl-cell mdl-cell--4-col photo-grid">
										<span class="image fit"><figure><img src="/images/transmission" rel="" alt="" /></span><a href="/transmission/"><figcaption><p>Torrents</p>
										</figcaption></a></figure></div></div>
	</div>
</article>
		</div>
	</div>
</div>
<script src="/js/jquery.min.js"></script>
<script type="text/javascript">
	$(window).load(function() {
		// Animate loader off screen
		$(".signal").fadeOut("slow");
	});
	</script>
</body>
</html>
