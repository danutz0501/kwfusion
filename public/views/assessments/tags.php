<div class="row white-row">
	
    <div class="col-md-9">
    
        <h4>Create New Template Tags</h4>
        
        <form action="" method="post" role="form">
        
          <div class="form-group">
            <label for="tag">Tag (without brackets)</label>
            <input type="text" class="form-control" id="tag" name="tag" required=required>
          </div>
          
          <div class="form-group">
            <label for="value">Value of tag</label>
            <input type="text" class="form-control" id="value" name="value" required=required>
          </div>
          
          <div class="form-group">
            <label for="descr">Description (what is tag used for)</label>
            <input type="text" class="form-control" id="descr" name="descr" required=required>
          </div>
		  
          <div class="form-group">
          <label for="document">Assessment to apply this tag to</label><br>
          <select id="document" name="document">
		  	<?php foreach( $data['filename'] as $file): ?>
            <option value="<?= $file['filename']; ?>"><?= $file['filename']; ?></option>
            <?php endforeach; ?>  
          </select>
          </div>
          <br><br>
          <button type="submit" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Save</button>
          
        </form>
        
    </div>
    
    <div class="col-md-3">
    
        <h4>Available Template Tags</h4>
        
        <?php foreach( $data['tags'] as $tag): ?>
        
        <ul style="list-style: none; padding-bottom: 10px">
            <li><i class="fa fa-tag"></i> <strong><?= $tag['string']; ?></strong><br><small><?= $tag['description']; ?></small></li>
        </ul>
        
        <?php endforeach; ?>
    
    </div>
	
</div>