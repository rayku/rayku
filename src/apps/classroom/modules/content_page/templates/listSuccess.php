<div class="title" style="float:left">

	<img src="../../../images/newspaper.gif" alt="" />

	<p>Content Pages</p>

</div>



<div class="spacer"></div>



<?php foreach ($content_pages as $content_page): ?>

<div class="entry" style="margin-bottom:11px;">

	<div class="top"></div>

	<div class="content">

		<div style="border:1px solid #fff">

			<div class="titles" style="margin:0;">

				<?php echo link_to($content_page->getTitle(),

				'content_page/edit?id='.$content_page->getId(), 

				array('class'=>'title02', 'style'=>'float:left;'));?>

			</div>



			<div style="float: right; font-size: 12px;">

				<div class="format" style="display: inline;">

					Created On : <strong><?php echo $content_page->getCreatedAt() ?></strong>

				</div>				

			</div>

			<div class="clear-both"></div>

		</div>



		<div class="paragraph" style="margin:0;">

			<div id="bordersplitter"></div>

			<div class="text" style="border-bottom:0;">

			<?php echo $content_page->getContent() ?>

			</div>

		</div>



	</div>

	<div class="bottom"></div>

</div>

<?php endforeach;?>



<?php echo link_to ('create', 'content_page/create', array('class'=>'blue', 'style'=>'line-height:38px; float:left;')) ?>
