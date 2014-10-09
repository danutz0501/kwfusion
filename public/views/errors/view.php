<section class="container">
  <div class="row">
    <div class="col-md-9">
        <?php
			if( DEBUG )
				echo '<div class="console">
				<h3 class="text-center"><< DEBUG Mode Enabled >></h3>
				Developer note -- Invalid view file requested: <code>'.$filename.'</code><br><br>
				This will <strong>NOT</strong> trigger a 404 Not Found error; however, the view file you are attempting to load cannot be found.<br>
				<small>** If this was intentional (error testing), everything is working as it should.</small><br><br>
				Please view the <a href="http://kwfusion.com/support/docs/index" target="_blank">documentation</a> if you need further assistance.
				</div>';
			else
				echo '<span class="subtitle">We\'re sorry, but the page you were looking for doesn\'t exist.</span><div class="e404">404</div>';
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
