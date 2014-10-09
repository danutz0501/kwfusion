			<section class="container">

				<div class="row">

					<div class="col-md-9">
						<h2>
							<strong>Oops</strong>, This Page Could Not Be Found!<br /><br />
							<?php
							$route = new System\Core\Router;
							if( DEBUG )
								echo '<div class="console">
								<h3 class="text-center"><< DEBUG Mode Enabled >></h3>
								<span>Developer note: Invalid class declaration for the <code>'.$route->controller.'</code> controller. 
								Controller class names (and the files they are contained in) must have _Controller appended to the end of the name. 
								In addition, controllers must also extend the SystemController class:<br><code>Fusion\System\SystemController</code></div>';
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