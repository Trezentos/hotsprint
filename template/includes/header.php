<?php

$pg = $_SEO["permalink"];

?>
<!doctype html>
	<html class="no-js" lang="pt-BR">
	<head>
		<?php if(!LOCALHOST && !IS_LIGHTHOUSE) { // ANALYTICS ?>

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo GOOGLE_ANALYTICS; ?>"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', '<?php echo GOOGLE_ANALYTICS; ?>');
		</script>

		<?php } ?>

		<title><?php echo $_SEO["title"]; ?></title>

		<!-- METATAGS -->
		<meta charset="utf-8" />
		<meta name="title" content="<?php echo $_SEO["title"]; ?>">
		<meta name="description" content="<?php echo $_SEO["description"]; ?>" />

		<link rel="canonical" href="<?php echo PageCanomical(); ?>" />



		<!-- FONTS -->
		<link rel="stylesheet" href="https://use.typekit.net/kvt7uyl.css">




		<!-- MOBILE -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
		<meta name="mobile-web-app-capable" content="yes" />
		<meta name="format-detection" content="telephone=no">
		<meta name="Author" content="Quax - Sites & Sistemas (quax.com.br)" />

		<!-- ICONS -->
		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo IMG ?>favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo IMG ?>favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo IMG ?>favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo IMG ?>favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo IMG ?>favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo IMG ?>favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo IMG ?>favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo IMG ?>favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo IMG ?>favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo IMG ?>favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMG ?>favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo IMG ?>favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo IMG ?>favicon/favicon-16x16.png">
		<link rel="manifest" href="<?php echo HTTP ?>/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="<?php echo IMG ?>favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">


		<meta property="og:site_name" 		content="<?php echo EMPRESA ?>">
		<meta property="og:type" 			content="website">

		<?php if($_SEO["ativarTag"]){ ?>
		<meta property="og:title" 			content="<?php echo $_SEO["title_share"]; ?>">
		<meta property="og:image" 			content="<?php echo $_SEO["imgDestaque"]; ?>">
		<meta property="og:image:type"   	content="image/jpeg">
		<meta property="og:image:width"  	content="150">
		<meta property="og:image:height" 	content="150">
		<meta property="og:description"  	content="<?php echo $_SEO["desc_share"]; ?>">
		<?php }else{ ?>
		<meta property="og:title" 			content="<?php echo $_SEO["title"]; ?>">
		<meta property="og:description"  	content="<?php echo $_SEO["description"]; ?>">
		<meta property="og:image" 			content="<?php echo IMG; ?>logo.png">
		<meta property="og:image:type" 		content="image/png">
		<meta property="og:image:width"  	content="250">
		<meta property="og:image:height" 	content="250">
		<?php } ?>

		<script>
			const HTTP 		= "<?php echo HTTP; ?>";
			const PAGE 		= "<?php echo $pg; ?>";
			const ASSETS 	= "<?php echo ASSETS; ?>";
			const IS_TABLET = "<?php echo $TABLET; ?>";
			const IS_MOBILE = "<?php echo $MOBILE; ?>";
		</script>
	
		
  		<?php echo style_enqueue('home','return'); ?>


		<!-- INSERT CODE HEAD -->
		<?php if( !IS_LIGHTHOUSE ) echo $qConfig->incorporar_head; ?>

	</head>

<body id="topo">


	<!-- MAIN -->
	<main class="smooth-scroll-container">
        <div class="smooth-scroll-content">