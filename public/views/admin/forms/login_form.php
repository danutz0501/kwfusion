<?php
/**
 * Password reset form was submitted and successfully completed
 */
if( strpos( $_SERVER['REQUEST_URI'], 'dashboard/login/password_reset_complete' ) ) {
?>

<section class="container">
  <div class="row"> 
    <?php echo '<h1>Password successfully reset</h1>'; ?>
    <!-- LOGIN -->

    <div>
      <form class="white-row" method="post" action="<?= BASEURL.'dashboard/login_validate'; ?>">
      <h2><small>You may now login with your new password</small></h2>
        <div class="row">
          <div class="form-group">
            <div class="col-md-12">
              <label>Email</label>
              <input type="email" name="email" placeholder="Email Address" class="form-control">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <div class="col-md-12">
              <label>Password</label>
              <input type="password" name="password" class="form-control">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6"> <span class="remember-box checkbox">
            <label for="rememberme">
              <input type="checkbox" id="rememberme" name="rememberme">
              Remember Me </label>
            </span> </div>
          <div class="col-md-6">
            <input type="submit" value="Sign In" class="btn btn-primary pull-right" data-loading-text="Loading...">
          </div>
        </div>
      </form>
    </div>

<?php
} else {
	// Previous login attempt failed
?>

<section class="container">
  <div class="row"> 
    
    <!-- LOGIN -->
    <div class="col-md-12">
      <h2 style="color: #1980B6"><strong>DAGI</strong> Administration Login</h2>
      <form class="white-row" method="post" action="<?= BASEURL.'dashboard/login_validate'; ?>">
<?php
if( strpos($_SERVER['REQUEST_URI'], 'dashboard/login/error') || strpos($_SERVER['REQUEST_URI'], 'dashboard/login/error/security') ) {
	
  if( strpos($_SERVER['REQUEST_URI'], '/security') ) {
	echo '<div class="alert alert-danger text-center"><button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Error: </strong>Security question is incorrect</div>';
  }
  else {
  echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4>Login Error <br><small style="color: #146794">One of the following errors have occured:</small></h4>1. Your email or password is incorrect. <br>2. Your account may not have been manually verified yet. Contact Jared or AR.</div>';
  }

	/**
	 * Since the login attempt failed, we want to protect ourselves against brute force hacking attempts.
	 * We don't want to annoy users with CAPTCHA forms, and we don't want to resort to locking members out or 
	 * not letting them attempt to login again for X-amount of time either, which not only also annoys users, but also
	 * uses up system resources.
	 * The best solution for protecting ourselves while keeping our users happy is to simply delay the execution of the script
	 * when a failed login attempt occurs. By delaying the processing of the request, the time it takes to successfully
	 * crack an account is enormous and unattainable for all intents and purposes.
	 * We don't want to delay the processing too long either, else the user may get frustrated with high page load times.
	 * We can modify how long this delay occurs in the sleep() function below. The value of the number is in seconds, so by
	 * default we delay failed login attempts for 2 seconds. The higher we set this number, the more secure we are, however,
	 * it also means the user has to wait that much longer for the page to reload. Keep in mind that a delay of just 10 milliseconds 
	 * greatly lengthens any brute force or dictionary attack. A value of 2 seconds should be a good compromise, as it gives
	 * terrific protection while being practically unnoticeable to users, but any value between 1 - 5 should be reasonable.
	 * Any more than that starts using up resources, as well as annoying people!
	 */
	sleep(2);
}
?>
<audio autoplay>
  <source src="http://upload.wikimedia.org/wikipedia/en/b/bf/X-Files_Theme.ogg" type="audio/ogg">
Your browser does not support the audio element.
</audio> 

        <div class="row">
          <div class="form-group">
            <div class="col-md-12">
              <label>Email</label>
              <input type="email" name="email" placeholder="Email Address" class="form-control">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="form-group">
            <div class="col-md-12">
              <label>Password</label>
              <input type="password" name="password" class="form-control">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="form-group">
            <div class="col-md-12">
              <label>Do some math</label><br>
              <strong><?= $data['a']; ?> x <?= $data['b']; ?> =</strong> <input type="number" name="math">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
          <a href="http://www.dynamicartisans.com/area51/dashboard/signup" class="btn btn-danger"><i class="fa fa-user"></i> Create Account</a>
          </div>
          <div class="col-md-6">
            <button class="btn btn-primary pull-right" data-loading-text="Loading..."><i class="fa fa-lock"></i> Sign In</button>
          </div>
        </div>
        <input type="hidden" name="math_answer" value="<?= $data['answer']; ?>">
      </form>
    </div>
    <!-- /LOGIN --> 
    
    <!-- PASSWORD -->
    <div class="col-md-12">
      <h2>Forgot <strong>Password</strong>?</h2>
      <div class="white-row">
        <p> Enter your email address below and follow the instructions to reset your password </p>
        <label>Email Address</label>
        <form class="input-group" method="post" action="<?= BASEURL; ?>member/forgot_password">
          <input type="text" class="form-control" name="email" id="email" placeholder="Email Address" />
          <span class="input-group-btn">
          <button class="btn btn-primary">Reset Password</button>
          </span>
        </form>
      </div>
    </div>
    <!-- /PASSWORD --> 
    
  </div>
</section>
<?php }