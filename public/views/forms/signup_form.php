<script src="<?= TEMPLATE_URL; ?>assets/js/city_states.js"></script>


<div class="row"> 
    
    <!-- REGISTER -->
    <div class="col-md-6">
        <form class="white-row" method="post" action="<?= BASEURL; ?>member/signup_validate">
        
            <legend>Create Account</legend>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label>First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="<?= $data['first_name'] ?>" placeholder="First Name" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" value="<?= $data['last_name'] ?>" placeholder="Last Name" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?= $data['username'] ?>" placeholder="Username" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="<?= $data['password'] ?>" placeholder="Password" >
                    </div>
                    <div class="col-md-6">
                        <label>Re-enter Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" value="<?= $data['confirm_password'] ?>" placeholder="Confirm Password" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?= $data['email'] ?>" placeholder="Email address" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Date of birth</label>
                        <input type="text" name="dob" id="dob" class="form-control datepicker" value="<?= $data['dob'] ?>" placeholder="Enter DOB YYYY-MM-DD" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option>-- Gender --</option>
                            <option value="male">Man</option>
                            <option value="female">Woman</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label class="optional">Mobile Phone Number</label>
                        <input type="tel" name="phone" id="phone" class="form-control" value="<?= $data['phone'] ?>" placeholder="Include area code" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Zip Code</label>
                        <input type="number" name="zip" id="zip" class="form-control" maxlength="5" value="<?= $data['zip'] ?>" placeholder="Zip Code" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label>City</label>
                        <br>
                        <select name="city" id="city" class="form-control">
                            <option>-- Zip code needed --</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label>State</label>
                        <br>
                        <select name="state" id="state" class="form-control">
                            <option>-- Zip Code Needed --</option>
                        </select>
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
    
    <!-- WHY? -->
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
