<SCRIPT language="JavaScript">
<!--
window.location="http://www.rayku.com/expertmanager/portfolio/<?php echo $expertusr ?>";
//-->
</SCRIPT>

	<div class="body-main">	
			<div class="box">
				<div class="top"></div>
				<div class="content3">


					<?php if(!empty($promotext)) {

						$content = $promotext->getContent();

					}  ?>



					<?php echo form_tag('expertmanager/promotext') ?>
						  <h1>Enter promotional text here: </h1>
							
														
						
			<?php echo textarea_tag('content',$content,array('size' => '54x40', 'rich' => 'fck')); ?>							
							<br />
							
						  <?php echo submit_tag('Add') ?>
						</form>
				</div>

			<div class="bottom"></div>
			</div>
</div>
