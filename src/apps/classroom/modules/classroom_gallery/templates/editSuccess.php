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
			<h3>Edit Gallery</h3>
			<?php echo form_tag('classroom_gallery/edit?id=' . $gallery->getId()) ?>
	
				<?php echo form_row('title', input_tag('title', $gallery->getTitle())) ?>
				<?php echo form_row(
                'gallery[type]',
                select_tag(
                        'gallery[type]',
                        options_for_select( Gallery::getTypes(), $gallery->getShowEntity() ),
                        array('style' => 'width: 125px') ),
                'Visible by') ?>
		
				<?php echo acl_select_friends($friends, $selectedFriends, !$gallery->isSpecifiedList()) ?>
			
				<?php echo form_row_no_label(submit_tag('Save')) ?>
			</form>
		</div>		
		<div class="clear-both"></div>
	</div>
	<div class="bottom"></div>
</div>