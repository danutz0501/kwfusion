<h4 class="text-center btn btn-primary btn-block wiz-header">Website Assessment Wizard</h4>
<div class="white-row">
<form method="post" action="<?= BASEURL; ?>assessments/process_wizard_form_one" role="form">
  <div class="form-group">
    <label for="company">Company Name</label>
    <input type="text" class="form-control" id="company" name="company" placeholder="Ex:  Acme Plumbing, Inc." required=required>
  </div>
  
  <div class="form-group">
    <label for="url">Website URL</label>
    <input type="url" class="form-control" id="url" name="url" placeholder="Website URL" required=required>
  </div>
  
  <div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" >
  </div>
  
  <div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" >
  </div>
  
  <div class="form-group">
    <label for="consultant">Consultant</label>
    <input type="text" class="form-control" id="text" name="consultant" placeholder="Name of consultant" required=required>
  </div>
  <button type="submit" class="btn btn-primary">Continue >></button>
</form>
</div>