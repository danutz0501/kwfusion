			<section class="container">

				<div class="row">

					<div class="col-md-9">
						<h2>
							<strong>Oops</strong>, This Page Could Not Be Found!<br /><br />
							<?php
							if( DEBUG )
								echo '
							<div class="console">
								<h3 class="text-center"><< DEBUG Mode Enabled >></h3>

								<span>Developer note: Invalid controller <code>'.$this->route->controller.'</code> requested. This will trigger a 404 Not Found error.<br>
								If this was intentional (error testing), everything is working as it should. However, if you were expecting output, there is a program error. 
								<br><br><strong>Troubleshooting tips</strong><br>
								If the url segment named <strong>'.str_replace('_Controller', '', $this->route->controller).'</strong> is correct, 
								you should have a controller file named <strong>'.$this->route->controller.'.php</strong> inside of your /public/controllers directory, 
								and the class name inside of that file should be named the same. Check your spelling, and make sure that the 
								controller complies with the <a target="_blank" href="http://kwfusion.com/support/docs/controllers">naming conventions</a>.</span></div>';
							else
								echo '<span class="subtitle">We\'re sorry, but the page you were looking for doesn\'t exist.</span>';
							?>
						</h2>
						
						<div class="e404">404</div>
					</div>

					<aside class="col-md-3">

						<h3>SEARCH THE WEBSITE!</h3>
						<div class="row">
							<div class="col-md-12">
								<form method="post" action="<?= BASEURL; ?>search/site" class="input-group">
									<input type="text" class="form-control" name="s" id="s" value="" placeholder="search..." />
									<span class="input-group-btn">
										<button class="btn btn-primary"><i class="fa fa-search"></i></button>
									</span>
								</form>
							</div>
						</div>

						<h4>USEFUL LINKS</h4>
						<ul class="nav nav-list">
							<li><a href="<?= BASEURL; ?>"><i class="fa fa-circle-o"></i> Home</a></li>
							<li><a href="<?= BASEURL; ?>"><i class="fa fa-circle-o"></i> About Us</a></li>
							<li><a href="#"><i class="fa fa-circle-o"></i> Contact</a></li>
						</ul>



					</aside>

				</div>


			</section>