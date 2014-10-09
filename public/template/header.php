<?php 
ob_start("ob_gzhandler");
Application::run('Session')->start();
header("Expires: Sat, 26 Jul 2015 05:00:00 GMT");
?>
<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<title>Tech Blog | PHP Tutorials | Free Software Downloads</title>
		<meta name="keywords" content="Tech Blog | PHP Tutorials | Free Software Downloads" />
		<meta name="description" content="Tech Blog | PHP Tutorials | Free Software Downloads" />
		<meta name="Author" content="Andrew Rout" />

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

		<!-- WEB FONTS
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet" type="text/css" />
        -->
		<!-- CORE CSS -->
		<link href="<?= TEMPLATE_URL; ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?= TEMPLATE_URL; ?>assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
		<link href="<?= TEMPLATE_URL; ?>assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
		<link href="<?= TEMPLATE_URL; ?>assets/plugins/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css" />
		<link href="<?= TEMPLATE_URL; ?>assets/plugins/owl-carousel/owl.transitions.css" rel="stylesheet" type="text/css" />
		<link href="<?= TEMPLATE_URL; ?>assets/plugins/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />
		<link href="<?= TEMPLATE_URL; ?>assets/css/animate.css" rel="stylesheet" type="text/css" />
		<link href="<?= TEMPLATE_URL; ?>assets/css/superslides.css" rel="stylesheet" type="text/css" />

		<!-- REVOLUTION SLIDER -->
		<link href="<?= TEMPLATE_URL; ?>assets/plugins/revolution-slider/css/captions.css" rel="stylesheet" type="text/css" />
		<link href="<?= TEMPLATE_URL; ?>assets/plugins/revolution-slider/css/settings.css" rel="stylesheet" type="text/css" />

		<!-- THEME CSS -->
		<link href="<?= TEMPLATE_URL; ?>assets/css/essentials.css" rel="stylesheet" type="text/css" />
		<link href="<?= TEMPLATE_URL; ?>assets/css/layout.css" rel="stylesheet" type="text/css" />
		<link href="<?= TEMPLATE_URL; ?>assets/css/layout-responsive.css" rel="stylesheet" type="text/css" />
		<link href="<?= TEMPLATE_URL; ?>assets/css/color_scheme/darkblue.css" rel="stylesheet" type="text/css" />
		<link href="<?= TEMPLATE_URL; ?>assets/css/custom.css" rel="stylesheet" type="text/css" />

		<!-- Morenizr -->
		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/plugins/modernizr.min.js"></script>
		
		<!-- Jquery ver 2.0.3-->
		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/plugins/jquery-2.0.3.min.js"></script>
	</head>
	<body>
    <!-- Top Bar -->
		<header id="topHead" class="color">
			<div class="container">

				<!-- PHONE/EMAIL -->
				<span class="quick-contact pull-left">
					<i class="fa fa-film"></i> &nbsp;<a href="<?= BASEURL; ?>"><?= $this->config->setting['site_slogan']; ?> </a>
					
				</span>
				<!-- /PHONE/EMAIL -->

                <?php 
					if( Application::run('Session')->fetch('email') == FALSE ) {
						$data['a'] = rand(1, 5);
						$data['b'] = rand(1, 5);
						$data['answer'] = $data['a'] * $data['b'];
				?>
				<!-- SIGN IN -->
				<div class="pull-right nav signin-dd">
					<a id="quick_sign_in" href="<?= BASEURL; ?>member/login" data-toggle="dropdown"><i class="fa fa-users"></i><span class="hidden-xs"> Sign In</span></a>
					<div class="dropdown-menu" role="menu" aria-labelledby="quick_sign_in">

						<h4>Sign In</h4>
						<form action="<?= BASEURL; ?>member/login_validate" method="post" role="form">

							<div class="form-group"><!-- email -->
								<input required type="email" name="email" class="form-control" placeholder="Email">
							</div>

							<div class="form-group">

								<!-- password -->
								<input required type="password" name="password" class="form-control" placeholder="Password">
							</div>
                            
							<div class="input-group">
                                      <input type="text" class="form-control" required=required name="math" placeholder="<?= $data['a']; ?> x <?= $data['b']; ?> =">
                                      <!-- submit button -->
								<span class="input-group-btn">
									<button class="btn btn-primary">Sign In</button>
								</span>
                            </div>
							<div class="checkbox"><!-- remember -->
								<label>
									<input type="checkbox"> Remember me &bull; <a href="<?= BASEURL; ?>">Forgot password?</a>
								</label>
							</div>
							<input type="hidden" name="math_answer" value="<?= $data['answer']; ?>">
						</form>

						<hr />
						
						<a href="#" class="btn-facebook fullwidth radius3"><i class="fa fa-facebook"></i> Connect With Facebook</a>
						<!-- <a href="#" class="btn-twitter fullwidth radius3"><i class="fa fa-twitter"></i> Connect With Twitter</a> -->
						<!--<a href="#" class="btn-google-plus fullwidth radius3"><i class="fa fa-google-plus"></i> Connect With Google</a>-->

						<p class="bottom-create-account">
							<a href="<?= BASEURL; ?>member/signup">Create an Account</a>
						</p>
					</div>
				</div>
				<!-- /SIGN IN -->
                <?php } else { ?>

                <div class="pull-right nav">
                	
                    <a href="<?= BASEURL; ?>dashboard/logout"><i class="fa fa-power-off"></i> Logout</a>
                    <a id="quick_sign_in" href="<?= BASEURL;?>member/profile/edit"><i class="fa fa-user"></i><span class="hidden-xs"> Logged in as 
                    <?= Application::run('Session')->fetch('first_name'); ?> <?= Application::run('Session')->fetch('last_name'); ?></span></a></div>

                <?php } ?>

				<!-- CART MOBILE BUTTON
				<a class="pull-right" id="btn-mobile-quick-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
				<!-- CART MOBILE BUTTON -->

				<!-- LINKS -->
				<div class="pull-right nav">
					<a href="<?= BASEURL; ?>downloads">Free Downloads</a>
				</div>
				<!-- /LINKS -->

			</div>
		</header>
		<!-- /Top Bar -->

        <?php $this->load->view('../template/navigation'); ?>
        <!-- WRAPPER -->
		<div id="wrapper">
				
			<div class="container">
			<p><br></p>
			<!-- Facebook login
			<div class="fb-login-button" data-max-rows="1" data-size="large" data-show-faces="true" data-auto-logout-link="false"></div>
			-->
        <!-- tinymce
        <script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/js/tinymce/jquery.tinymce.min.js"></script>
        <script>
		tinymce.init({
			selector: "textarea#elm1",
			theme: "modern",
			width: 1200,
			height: 700,
			plugins: [
				 "advlist autolink bbcode link image lists charmap print preview hr anchor pagebreak spellchecker",
				 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
				 "save table contextmenu directionality emoticons template paste textcolor"
		   ],
		   content_css: "<?= TEMPLATE_URL; ?>assets/js/tinymce/skins/lightgray/content.min.css",
		   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l ink image | print preview media fullpage | forecolor backcolor emoticons",
		   theme_advanced_fonts : "Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n",
		   theme_advanced_font_sizes : "10px,12px,14px,16px,18px,21px,24px,28px,36px,48px",
		   theme_advanced_layout_manager : "RowLayout",
		   style_formats: [
		   		{title: 'Headline', block: 'h1', styles: {color: '#000000'}},
				{title: 'Sub title', block: 'h3', styles: {color: '#7a7a7a'}},
				{title: 'Bold text', inline: 'b'},
				{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
				{title: 'Example 1', inline: 'span', classes: 'example1'},
				{title: 'Example 2', inline: 'span', classes: 'example2'},
				{title: 'Table styles'},
				{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
			]
		 }); 
		</script>
		-->
		
		<!-- CKEditor
		<script type="text/javascript" src="<?= PLUGINS_URL; ?>ckeditor/ckeditor.js"></script>
        -->
