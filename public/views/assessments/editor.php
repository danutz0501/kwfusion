<form action="<?= BASEURL; ?>documents/process" method="post" role="form">

<h3>Create Document</h3>

<div class="input-group">
  <span class="input-group-addon"><span style="font-size: 21px; font-weight: bold; letter-spacing: 1px;">Title >> </span></span>
 <input type="text" class="form-control" id="document_title" name="document_title" placeholder="Give this document a title">
</div>
<br>

<textarea name="document" id="document" rows="10" cols="80">
	<?php 
		
		function kv_read_word($input_file){    
			 $kv_strip_texts = '';
				 $kv_texts = '';     
			if(!$input_file || !file_exists($input_file)) return false;
				
			$zip = zip_open($input_file);
				
			if (!$zip || is_numeric($zip)) return false;
			
			
			while ($zip_entry = zip_read($zip)) {
					
				if (zip_entry_open($zip, $zip_entry) == FALSE) continue;
					
				if (zip_entry_name($zip_entry) != "word/document.xml") continue;
		 
				$kv_texts .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
					
				zip_entry_close($zip_entry);
			}
			
			zip_close($zip);
				
		 
			$kv_texts = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $kv_texts);
			$kv_texts = str_replace('</w:r></w:p>', "\r\n", $kv_texts);
			$kv_strip_texts = strip_tags($kv_texts);
		 
			return $kv_strip_texts;
		}
		// echo '<img src="http://www.dynamicartisans.com/images/site/dynamicartisans-logo-mobi.png">';
		echo kv_read_word( $data['content'] );
		
		// echo file_get_contents( $data['content'], false ); 
	?>
</textarea>
<script>
	// Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
	CKEDITOR.replace( 'document' );
</script>
<br><br>

<div class="btn-group" data-toggle="buttons">
  <label class="btn btn-primary">
    <input type="radio" name="options" id="option1"> Save as draft
  </label>
  <label class="btn btn-primary">
    <input type="radio" name="options" id="option3"> Publish
  </label>
</div>

<button class="btn btn-success pull-right" data-loading-text="Saving..."><i class="fa fa-pencil-square-o"></i> Publish</button>
            
</form>