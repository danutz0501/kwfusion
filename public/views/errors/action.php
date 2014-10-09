			<section class="container">

				<div class="row">

					<div class="col-md-9">
					<div class="e404">404</div>
						<h2><strong>Oops</strong>, This Page Could Not Be Found!</h2>
							<?php
							$route = Application::run('Router');
							if( DEBUG )
								echo '<div class="console">
								<h3 class="text-center"><< DEBUG Mode Enabled >></h3>
								<span>Developer note: Invalid action <code>'.$route->action.'</code> requested. This will trigger a 404 Not Found error.<br>
								If this was intentional (error testing), everything is working as it should. However, if you were expecting output, there is a program error. Either 
								the method named <code>'.$route->action.'</code> does not exist inside of your <code>'.
								$route->controller.'</code> class, or you mistyped the URL.</span></div>';
							else
								echo '<span class="subtitle">We\'re sorry, but the page you were looking for doesn\'t exist.</span>';
							?>

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