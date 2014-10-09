<!--
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1429084537339062&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
-->
		</div>
		<!-- /CONTAINER -->		

		</div>
		<!-- /WRAPPER -->

		<!-- FOOTER -->
		<footer>

			<!-- FB Like , scrollTo Top 
			<div class="footer-bar">
				<div class="container">
					<span class="copyright">
					<div class="fb-like" data-href="http://kwfusion.com/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
					
					</span>
					<a class="toTop" href="#topNav">BACK TO TOP <i class="fa fa-arrow-circle-up"></i></a>
				</div>
			</div>
			<!-- copyright , scrollTo Top -->


			<!-- footer content -->
			<div class="footer-content">
				<div class="container">

					<div class="row">


						<!-- FOOTER CONTACT INFO -->
						<div class="column col-md-4">
							<h3>Current Software Version <br><small>Release version <?= $config->setting['software_version']; ?></h3>
							<p class="contact-desc"><i class="fa fa-download"></i>  
								<a>Download kW Fusion</a>
							</p>
							<address class="font-opensans">
								<ul>
									<i class="fa fa-cloud"></i> 
										<strong>Previous versions</strong>
									</li>
									<li>
										N/A
									</li>
								</ul>
							</address>

						</div>
						<!-- /FOOTER CONTACT INFO -->


						<!-- FOOTER LOGO -->
						<div class="column logo col-md-4 text-center">
							<div class="logo-content">
								<h3>Follow</h3>
								<img class="animate_fade_in" src="<?= TEMPLATE_URL; ?>assets/images/logo/logo.png" width="200" alt="" />
								<h4 style="font-family: Audiowide">FRAMEWORK</h4>
								<a href="https://www.facebook.com/kwfusion" class="social fa fa-facebook"></a>
								<a href="https://twitter.com/kw_fusion" class="social fa fa-twitter"></a>
								<a href="#" class="social fa fa-google-plus"></a>
							</div>											
						</div>
						<!-- /FOOTER LOGO -->


						<!-- FOOTER LATEST POSTS -->
						<div class="column col-md-4 text-right">
							<h3>NEWS</h3>

							<div class="post-item">
								<small>STAY TUNED</small>
								<h3><a href="">We will update you as soon as possible!</a></h3>
							</div>

							<a href="" class="view-more pull-right">View Blog <i class="fa fa-arrow-right"></i></a>

						</div>
						<!-- /FOOTER LATEST POSTS -->

					</div>
				</div>
				
			</div>
			<!-- footer content -->
					<div class="footer-bar">
                        <div class="container text-center">
                            Script execution time: <code class="terminal"><?php echo $config->setting['execution_time']; ?></code> seconds. Memory usage: 
                            <code class="terminal">
                            <?php
                            function convert($size)
                             {
                                $unit=array('b','kb','mb','gb','tb','pb');
                                return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
                             }
                            
                            echo convert(memory_get_usage(true)); // 123 kb
                            ?>
                            </code>
                            <br />
                            <small>kW Fusion is licensed and distributed under GNU GENERAL PUBLIC LICENSE v3 by <a href="https://twitter.com/arout77">Andrew Rout</a><br />
                            <a class="terminal" href="<?= BASEURL; ?>support/license">Learn more</a></small>
                       </div>
                    </div>
		</footer>
		<!-- /FOOTER -->



		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/plugins/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/plugins/jquery.cookie.js"></script>
		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/plugins/jquery.appear.js"></script>
		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/plugins/jquery.isotope.js"></script>
		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/plugins/masonry.js"></script>

		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/plugins/owl-carousel/owl.carousel.min.js"></script>
		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/plugins/stellar/jquery.stellar.min.js"></script>
		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/plugins/knob/js/jquery.knob.js"></script>
		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/plugins/jquery.backstretch.min.js"></script>
		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/plugins/superslides/dist/jquery.superslides.min.js"></script>
		<!-- STYLESWITCHER - REMOVE ON PRODUCTION/DEVELOPMENT <script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/plugins/styleswitcher/styleswitcher.js"></script> -->
		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/plugins/mediaelement/build/mediaelement-and-player.min.js"></script>

		<!-- REVOLUTION SLIDER -->
		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/plugins/revolution-slider/js/jquery.themepunch.plugins.min.js"></script>
		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/plugins/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>
		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/js/slider_revolution.js"></script>


		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/js/scripts.js"></script>
		<script type="text/javascript" src="<?= TEMPLATE_URL; ?>assets/js/zebra_datepicker.js"></script>
		<link rel="stylesheet" href="<?= TEMPLATE_URL; ?>assets/css/datepicker.css" type="text/css">
		<script type="text/javascript">
		    $(document).ready(function() {

		    // assuming the controls you want to attach the plugin to
		    // have the "datepicker" class set
		    $('input.datepicker').Zebra_DatePicker({
			  view: 'years'
			});

		});
		</script>

        
		<!-- Google Analytics: -->
		<!--<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-XXXXX-X', 'domainname.com');
			ga('send', 'pageview');
		</script>
		-->
	</body>
</html>
<?php ob_end_flush(); ?>