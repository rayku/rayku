<?php use_helper('Javascript') ?>

<?php if (!isset($linkText) || '' === $linkText): ?>
	<?php $linkText = (empty($threadID) ? 'Add new post' : 'Add Reply') ?>
<?php endif ?>

	<?php echo link_to_function($linkText, visual_effect('toggle_blind', 'postForm') . visual_effect('toggle_blind', 'activate_form'), array('id' => 'postLink','class'=>'blue')) ?>



<div id="postForm" style="display:none;">
	<?php echo form_remote_tag(array('url' => 'classroom_forum/makethread', 'update' => 'status', 'complete' => 'window.location.reload()')) ?>
		
		<?php echo input_hidden_tag('forum_id', $forumID) ?>
		
		<?php if (empty($threadID)): ?>
			<div class="form-block-label-row">
				<label for="thread_title">Topic:</label>
				<?php echo input_tag('thread_title') ?>
			</div>
		<?php else: ?>
			<?php echo input_hidden_tag('thread_id', $threadID) ?>
		<?php endif ?>
		
		<div class="form-block-label-row">
			<label for="post_body">Post:</label>
			<?php echo textarea_tag('post_body', '', array('style' => 'height: 130px; width: 100%;')) ?>
		</div>
		
		<div>
			<?php echo submit_tag('Post') ?>
			or
			<?php echo link_to_function('Cancel', visual_effect('toggle_blind', 'postForm') . visual_effect('toggle_blind', 'activate_form'), array('id' => 'postLink')) ?>
		</div>
	</form>
</div>