<div class="row"> 
    
    <!-- REGISTER -->
    <div class="col-md-12">
        <form class="white-row" method="post" action="<?= BASEURL; ?>dashboard/signup_validate">
        
            <legend>Create Administrator Account</legend>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label>First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="<?= $data['first_name'] ?>" placeholder="First Name" required=required >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" value="<?= $data['last_name'] ?>" placeholder="Last Name" required=required >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="<?= $data['password'] ?>" placeholder="Password must be 6 chars minimum" required=required >
                    </div>
                    <div class="col-md-6">
                        <label>Re-enter Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" value="<?= $data['confirm_password'] ?>" placeholder="Confirm Password" required=required >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?= $data['email'] ?>" placeholder="Email address" required=required >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <input type="submit" value="Sign Up" class="btn btn-block btn-primary pull-right push-bottom" data-loading-text="Loading...">
                </div>
            </div>
        </form>
    </div>
    <!-- /REGISTER --> 
    
    <!-- WHY?
    <div class="col-md-6">
        <div class="white-row">
            <legend>Registration is fast, easy, and free.</legend>
            <p>Once you're registered, you can:</p>
            <ul class="list-icon check">
                <li>Recieve email notifications of updates</li>
                <li>Learn about our new software products</li>
                <li>Help us keep track of the awesome websites built with kW Fusion</li>
            </ul>
            <hr class="half-margins" />
            <p> Already have an account? <a href="<?= BASEURL; ?>member/login">Member Login</a> </p>
        </div>
    </div>
    <!-- /WHY? --> 
    
</div>
