<style type="text/css">
ul.subopt {
	display:inline;
}
ul.subopt li {
	display:inline;
	margin-left:20px;
}
ul.subopt li label{
	font-size:14px;
	color:#257000;
	font-weight:bold;
}
</style>
<div class="title" style="float:left">
	<img src="../../../images/newspaper.gif" alt="" />
	<p>Submissions : <?php echo link_to($assignment->getTitle(), 'assignment/show?id='.$assignment->getId()) ?></p>
</div>

<div class="spacer"></div>

<?php $submissions = $assignment->getSubmissions(); ?>
<?php foreach ($submissions as $submission): ?>
<div class="entry" style="margin-bottom:11px;">
	<div class="top"></div>
	<div class="content">
		<div style="border:1px solid #fff">
			<div class="titles" style="margin:0;">
				<a href="#" class="title02" style="float:left;">
					<?php
            echo $submission->getUser()->getUsername();
					?>
				</a>
			</div>

			<div style="float: right; font-size: 12px;">
				<div class="format" style="display: inline;">Format: <strong>HTML</strong></div>
				<div class="date-due" style="display: inline; padding-left: 15px;">Due: <strong>2009-07-31</strong></div>
			</div>
			<div class="clear-both"></div>
		</div>

		<div class="paragraph" style="margin:0;">
			<div id="bordersplitter"></div>
			<div class="text" style="border-bottom:0;">
			<?php echo substr($submission->getData(),0,100)?>
			       	<a href="<?php echo url_for('submission/show?id='.$submission->getId());?>" style="font-size:12px; font-weight:bold; color:#257000; text-decoration:none; margin-left:10px;">Read more <img src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/classroom_greenarrowright.gif" alt="" style="margin:0 auto;" /></a>
			<br />
			<br />
				<ul class="subopt">
					<?php if($submission->getGrade()): ?>
						<li><label>Grade :</label>
							<?php echo ($submission->getGrade() == "-")?"Not Assigned":$submission->getGrade() ?>
						</li>
				    <?php endif;?>
						<li><label>Comments :</label>
						<?php echo ($submission->getComment()=="NULL")?"No Comments":$submission->getComment() ?>
						</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="bottom"></div>
</div>
<?php endforeach; ?>
