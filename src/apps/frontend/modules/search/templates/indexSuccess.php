<?php use_helper('Javascript') ?>
                	<div id="top">
                    	<div class="title">
                            <img src="/images/arrow-right.gif" alt="" />
                            <p>Search Results</p>
                        </div>
                        <div class="spacer"></div>
                    </div>


<div class="body-main">
  
  <div id="results">
    Displaying <?php echo $search->nrOfObjects(); ?> results for "<?php echo $sf_request->getParameter('criteria', ''); ?>"
  </div>

  <div style="width: 926px; height: 38px; float:left">
    <div id="tabs">
      <ul>
        <li id="profile-details-tabs01">
            <?php echo link_to_remote(content_tag('span', 'All'), array(
                  'url'      => 'search/index?criteria='.$sf_request->getParameter('criteria', ''),
                  'update'   => 'tcontent',
                  'complete' => 'switchTab(\'profile-details-tabs01\');'
                ),
                array(
                  'class'  => 'tabmenu'
                ));
            ?>
        </li>
        <li id="profile-details-tabs03">
            <?php echo link_to_remote(content_tag('span', 'Threads/Posts '), array(
                  'url'      => 'search/index?findfrom=posts&criteria='.$sf_request->getParameter('criteria', ''),
                  'update'   => 'tcontent',
                  'complete' => 'switchTab(\'profile-details-tabs03\');'
                ),
                array(
                  'class'  => 'tabmenu'
                ));
            ?>
        </li>
        <li id="profile-details-tabs04">
            <?php echo link_to_remote(content_tag('span', 'Memberbase'), array(
                  'url'      => 'search/index?findfrom=people&criteria='.$sf_request->getParameter('criteria' ,''),
                  'update'   => 'tcontent',
                  'complete' => 'switchTab(\'profile-details-tabs04\');'
                ),
                array(
                  'class'  => 'tabmenu'
                ));
            ?>
        </li>
      </ul>
    </div>
  </div>


 <div class="box" style="float:left;">
    <div class="top"></div>
    <div class="content" id="tcontent">
    	<?php include_partial('allList',array('raykuPager' => $raykuPager)) ?>
    </div>
 </div>
</div>

  <script type="text/javascript">
			//<![CDATA[

				var selectedProfileDetailsTab =  'profile-details-tabs01';
				<?php if($sf_request->getParameter('findfrom') && $sf_request->getParameter('findfrom')!="ALL"): ?>
					<?php if($sf_request->getParameter('findfrom')=="people"): ?>
						selectedProfileDetailsTab='profile-details-tabs02';
					<?php elseif($sf_request->getParameter('findfrom')=="groups"): ?>
						selectedProfileDetailsTab='profile-details-tabs03';
					<?php elseif($sf_request->getParameter('findfrom')=="forums"): ?>
						selectedProfileDetailsTab='profile-details-tabs04';
					<?php endif; ?>
				<?php endif; ?>
				var switchTab = function(element){
					var element = $(element);
					$(selectedProfileDetailsTab).removeClassName('active');

					element.addClassName('active');
					selectedProfileDetailsTab = element;
				}

				switchTab(selectedProfileDetailsTab);

			//]]>
			</script>