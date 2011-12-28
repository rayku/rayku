<?php use_helper('Validation', 'MyForm') ?>
<div class="title" style="float:left">
	<img src="images/arrow-right.gif" alt="" />
	<p>Viewing Class Album</p>
</div>

<div class="spacer"></div>

<div class="entry picvidgal">
	<div class="top"></div>
	<div class="content">
		<div class="info-box">
			<h3>Add to Gallery - <?php echo htmlentities($gallery->getTitle()) ?></h3>
				<p>
					Here you can upload images or videos.
				</p>
				
				<p>
					Valid image types are: JPG, GIF and PNG. Valid video tyes are MPEG, MOV and AVI.
				</p>
			
				<p>
					Maximum file size is <?php echo $maximum_upload_size ?>
				</p>
				<?php echo form_tag('classroom_gallery/upload?id=' . $gallery->getId(), 'multipart=true') ?>
	
					<?php echo form_row('file', input_file_tag('file')) ?>
				
					<?php echo form_row_no_label(submit_tag('Upload')) ?>
				</form>
		</div>		
		<div class="clear-both"></div>
	</div>
	<div class="bottom"></div>
</div>
