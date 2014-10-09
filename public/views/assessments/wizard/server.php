<h4 class="text-center btn btn-primary btn-block wiz-header">Website Assessment Wizard - Server Parameters For
    <?= $data['company']; ?>
</h4>
<div class="white-row">
    <div class="row text-left">
        <div class="col-md-12">
            <div class="text-center"><em><span class="green">green</span> = excellent, <span class="yellow">yellow</span> = average, <span class="red">red</span> = poor</em></div>
            <br>
            <br>
            <div class="progress-bars">
                <div class="progress-label"> <span><strong>Network Latency</strong> <small><em>(Lower is better)</em></small></span> </div>
                <div class="progress">
                    <?= $data['latency']; ?>
                </div>
                <div class="progress-label"> <span><strong>Download Speed</strong> <small><em>(Higher is better)</em></small></span> </div>
                <div class="progress">
                    <div class="progress">
                        <?= $data['download_speed']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    
    <span class="alert alert-info text-center">The above measurements will be stored, but we do not want to place too much emphasis on these results, 
    since they can vary significantly depending on traffic.</span>
    
    <div class="divider styleColor"><!-- divider --> 
        <i class="fa fa-code"></i> </div>
    <br>
    <legend>Please provide the following information for <code><?= $data['company']; ?></code></legend>
    <form method="post" action="<?= BASEURL; ?>assessments/process_wizard_form_two" role="form">
        <div class="form-group">
            <label for="platform">Platform (Scripting language)</label>
            <input type="text" class="form-control" id="platform" name="platform" placeholder="PHP / Python / Ruby / MEAN" required=required>
        </div>
        <br>
        <div class="form-group">
            <label class="checkbox-inline">
                <input type="checkbox" name="permalinks" id="inlineRadio1" value="yes">
                Contains SEO friendly URLs </label>
        </div>
        <div class="form-group">
            <label class="checkbox-inline">
                <input type="checkbox" name="yslow" id="inlineRadio1" value="yes">
                Yslow score is 85 or better </label>
        </div>
        
        <button type="submit" class="btn btn-primary"><i class="fa fa-forward"></i> Continue</button>
        <button type="submit" formaction="<?= BASEURL; ?>assessments/save_draft" class="btn btn-warning pull-right" name="draft"><i class="fa fa-save"></i> Save as draft</button>
    </form>
</div>
