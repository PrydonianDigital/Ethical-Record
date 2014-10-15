<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"<?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"<?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"<?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/img/favicon.ico">
<link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('template_url'); ?>/img/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_url'); ?>/img/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_url'); ?>/img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_url'); ?>/img/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php bloginfo('template_url'); ?>/img/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_url'); ?>/img/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_url'); ?>/img/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_url'); ?>/img/apple-touch-icon-152x152.png">
<link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/img/favicon-196x196.png" sizes="196x196">
<link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/img/favicon-160x160.png" sizes="160x160">
<link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/img/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/img/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/img/favicon-32x32.png" sizes="32x32">
<meta name="msapplication-TileColor" content="#ebf3f4">
<meta name="msapplication-TileImage" content="/img/mstile-144x144.png">
<meta name="msapplication-config" content="/img/browserconfig.xml">
<link rel="search" href="http://ethicalrecord.org.uk/wp-content/themes/ethicalrecord/opensearch.xml" type="application/opensearchdescription+xml" title="<?php bloginfo('name'); ?>" />
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
<?php wp_head(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<?php
$background_color = get_background_color();
$background_image = get_background_image();
?>
<style type="text/css" id="custom-css">
.header { background: #<?php echo $background_color; ?> url("<?php header_image(); ?>") no-repeat center center; background-size: cover;}
</style>
<meta property="twitter:account_id" content="4503599627937764" />
</head>

<body <?php body_class(); ?>>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54512965-1', 'auto');
  ga('send', 'pageview');

</script>

<div class="secondary alert" id="cookie">This site uses cookies to improve user experience. <a href="#" id="cookieOK">Click here</a> to dismiss this warning.</div>
<div class="navbar" id="nav1">
	<div class="row">
		<a class="toggle" gumby-trigger="#nav1 ul.menu" href="#"><i class="icon-menu"></i></a>
		<?php wp_nav_menu( array( 'theme_location' => 'chmenu', 'container' => '' ) ); ?>
	</div>
</div>
<div class="header">
	<div class="row">
		<div class="twelve columns">
			<a href="<?php bloginfo( 'url' ); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/img/header/logo.png"></a>
		</div>
	</div>
</div>
<div class="navbar" id="nav2" gumby-fixed="top">
	<div class="row">
		<a class="toggle" gumby-trigger="#nav2 ul.menu" href="#"><i class="icon-menu"></i></a>
		<?php wp_nav_menu( array( 'theme_location' => 'ermenu', 'container' => '' ) ); ?>
	</div>
</div>