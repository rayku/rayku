<div class="title" style="float:left">
        	<img src="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/images/newspaper.gif" alt="" />

			<?php if ($classroom_blog->getId()): ?>
				<p>Edit News Blog page </p>
			<?php else: ?>
				<p>Add News Blog</p>
			<?php endif; ?>
        </div>
<div class="spacer"></div>
<?php use_helper('Object') ?>
<?php echo form_tag('classroom_blog/update','multipart=true') ?>
<?php echo object_input_hidden_tag($classroom_blog, 'getId') ?>
	 <div class="entry" style="margin-bottom:11px;">
        	<div class="top"></div>
            <div class="content">
            	<div class="hand-in">
                    <div class="infleft" style="margin-right: 10px;">
                    <label style="color:#056A9A;">Title</label>
					 <?php echo object_input_tag($classroom_blog, 'getTitle', array (
  'size' => 80,
)) ?>
                    </div>
                    <div class="clear-both"></div>
                </div>
            </div>
            <div class="bottom"></div>
        </div>

 	<div class="entry" style="margin-bottom:11px;">
        	<div class="top"></div>
            <div class="content">
            	<div class="hand-in">
                	<div class="email-st">
                    <label>Page Content:</label>
                    <?php /*echo object_textarea_tag($classroom_blog, 'getMessage', array (
  'size' => '60x3','rich' => true ,'tinymce_options' => 'width:590'
)) */

				echo object_textarea_tag($classroom_blog, 'getMessage', array('size' => '54x40', 'rich' => 'fck')) 

				?>
                    </div>
                </div>
            </div>
            <div class="bottom"></div>
        </div>


		<div class="entry">
        	<div class="top"></div>
            <div class="content">
            	<div class="hand-in">
				
						<h3 style="margin-bottom:15px;">Attachment(s)</h3>
	
						<?php foreach($blog_attach as $attachment) : ?>
	
						<?php  echo $attachment->getFile(); ?>
	
						&nbsp;&nbsp;&nbsp;<?php  echo link_to('delete', 'classroom_blog/deleteAttachment?id='.$attachment->getId().'&blogid='.$classroom_blog->getId(),'post=true&confirm=Are you sure?') ; ?>
	
						<br />
	
					   <?php endforeach ; ?>
			
					<h3 style="margin-bottom:15px; margin-top:15px;">Upload attachment(s)</h3>

					<?php echo input_file_tag('file') ?>

				    <!-- <input name="" type="text" id="uploadasss" />
                    <input name="" type="button" class="blue" value="Browse" style="margin-top:12px;" />-->
                    <div class="clear-both"></div>
                </div>
            </div>
            <div class="bottom"></div>

        </div>

<?php echo submit_tag('save', array('class' => 'blue')) ?>
<?php if ($classroom_blog->getId()): ?>


  <a href="<?php echo url_for('classroom_blog/delete?id='.$classroom_blog->getId());?>" class="blue" style="line-height:30px; float:left;"><span>Delete</span></a>


  <a href="<?php echo url_for('classroom_blog/show?id='.$classroom_blog->getId());?>" class="blue" style="line-height:30px; float:left;"><span>Cancel</span></a>
 <?php else: ?>
<a href="<?php echo url_for('classroom_blog/list');?>" class="blue" style="line-height:30px; float:left;"><span>Cancel</span></a>

<?php endif; ?>
</form>
