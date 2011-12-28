	<?php use_helper('Text'); ?>
	<div class="title" style="float:left">
		<img src="images/newspaper.gif" alt="" />
		<p>Student Voice</p>
	</div>
	<div class="spacer"></div>
	<script type="text/javascript" src="http://jqueryui.com/latest/jquery-1.3.2.js"></script>
	<script type="text/javascript" src="http://jqueryui.com/latest/ui/ui.core.js"></script>
	<style type="text/css">
		div.tab-contents-active {
			display: block;
		}

		div.tab-contents {
			display: none;
		}
		a.voice-title {
			text-decoration: none;
			color:#257000;
			float:left;
			font-size:16px;
			font-weight:bold;
			margin-top:7px;
			text-transform:uppercase;
			width:368px;
		}
	</style>
	<script type="text/javascript">
	$(document).ready(function(){

	 $('.tab').click(function (event) {
    event.preventDefault();
	  $('.entry > .top-tabs > li.active')
		  .removeClass('active').addClass('popular');
	  $(this).parent().removeClass('popular').addClass('active');
	  $('.entry > .tab-content-container > div.tab-contents-active')
		  .removeClass('tab-contents-active').addClass('tab-contents');
	  $(this.rel).removeClass('tab-contents').addClass('tab-contents-active');
	 });
	});
	</script>



	<div class="entry" style="text-align: left;">
		<ul class="top-tabs">
			<li class="active">
				<div class="tab-left"></div>
				<a href="#" class="tab" rel="#fragment-1">Popular</a>
				<div class="tab-right"></div>
			</li>
			<li class="popular">
			<div class="tab-left"></div>
				<a href="#" class="tab" rel="#fragment-2">Latest</a>
				<div class="tab-right"></div>
			</li>
			<li class="popular">
			<div class="tab-left"></div>
				<a href="#" class="tab" rel="#fragment-3">Accepted</a>
				<div class="tab-right"></div>
			</li>
		</ul>
	<div class="clear-both" style="background-image: url(/images/tab-top.png); height: 10px;"></div>
		<div id="tab-content-container" class="tab-content-container">
			<div id="fragment-1" class="tab-contents-active">
        <?php include_partial( 'list', array( 'voices' => $popular_student_voices ) ); ?>
      </div>
			<div id="fragment-2" class="tab-contents">
        <?php include_partial( 'list', array( 'voices' => $latest_student_voices ) ); ?>
      </div>
			<div id="fragment-3" class="tab-contents">
        <?php include_partial( 'list', array( 'voices' => $accepted_student_voices ) ); ?>
      </div>
		</div>
		<div class="bottom"></div>
	</div>
<?php echo link_to ('create', 'student_voice/create',array('style'=>'float: left; line-height: 35px;', 'class' => 'blue')) ?>