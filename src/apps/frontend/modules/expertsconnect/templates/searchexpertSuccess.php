<style type="text/css">
@import '/css/custom/pplsrch-results.css' ;
@import '/styles/donny.css';
@import '/css/pager.css';
</style>

<?php use_helper('MyAvatar', 'Javascript') ?>
<?php $raykuUser = $sf_user->getRaykuUser(); ?>

<?php use_helper('Javascript') ?>

<?php  $searchresults = $raykuPager->getPager()->getResults(); ?>

<?php if($searchresults != NULL) : ?>

<div id="top">
	<div class="title">
		<img src="/images/arrow-right.gif" alt="" />
		<p>Search Results</p>
	</div>
	<div class="spacer"></div>
</div>

<div class="body-main">
  
  <div id="results">
    Displaying <?php echo count($searchresults); ?> results 
  </div>


 <div class="box" style="float:left;">
    <div class="top"></div>
    <div class="content" id="tcontent">
    	
	 <?php include_partial( 'global/pager', array( 'raykuPager' => $raykuPager ) ); ?>
	 
	 <?php foreach($searchresults as $searchresult):?>
		
		<div class="entry">
			  <?php if($searchresult->getPicture()!=''): ?>
				  <?php echo avatar_tag_for_user($searchresult); ?>
			  <?php else: ?>
				<img src="/images/dev/emptyprofile.gif" alt="" />
			  <?php endif; ?>
												
			  <div class="container">
				  <div>
					<?php echo link_to($searchresult->getName(), '/expertmanager/portfolio/'.$searchresult->getUsername(),array('class'=>'name')); ?>                                            
				  <div class="username">(<?php echo $searchresult->getUsername(); ?>)</div>
				   <div class="actions" style="background:none !important;border:0px !important ;float:none;width:auto;padding:20px;"> &nbsp;</div>
				</div>
			</div>
		</div>
		
		<?php endforeach; ?>	
		
		
		<?php include_partial( 'global/pager', array( 'raykuPager' => $raykuPager ) ); ?>

		
		
    </div>
 </div>
 
 </div>
 
 <?php else: ?>
				
	<h3>No Search results found, search for an Expert.</h3>

<?php endif; ?> 

