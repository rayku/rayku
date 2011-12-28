<?php use_helper('Enum', 'MyForm', 'MyAclView', 'Javascript') ?>

<?php echo acl_javascript() ?>
<div class="title" style="float:left">
	<img src="images/arrow-right.gif" alt="" />
	<p>Viewing Class Album</p>
</div>

<div class="spacer"></div>

<div class="entry picvidgal">
	<div class="top"></div>
	<div class="content">
		<div class="info-box">
			<h3>Create Gallery</h3>
			<p>	
			<?php echo form_tag('classroom_gallery/create') ?>
	
				<?php echo form_row('title', input_tag('title')) ?>
				
				<?php echo form_row(
                'gallery[type]',
                select_tag(
                        'gallery[type]',
                        options_for_select( Gallery::getTypes() ),
                        array('style' => 'width: 125px') ),
                'Visible by') ?>
		
				<?php echo acl_select_friends($friends) ?>
			
				<?php echo form_row_no_label(submit_tag('Create')) ?>
			</form>
			</p>
		</div>
		<div style="clear:both"></div>		
	</div>
	<div class="bottom"></div>
</div>
