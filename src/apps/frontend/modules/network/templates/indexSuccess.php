<div class="body-main">

	  <div id="what-is">
		<div style="width: 30px; float: left;">
		  <img height="25" width="42" alt="" src="/images/green_arrow.jpg"/>
		</div>
		<p style="font-size: 16px; color: rgb(28, 81, 124); font-weight: bold; margin-left: 55px;">
		 Rayku.com Networks
		</p>
	  </div>


		<div class="left-bg">
		  <div class="left-top"></div>
			<div class="content">
			
			  <?php
					if( count($networks) < 1 )
					{
					  echo ' <div class="title"> Currently there are no networks </div>';
					}
					else
					{
					  foreach( $networks as $network )
					  {
						echo ' <div class="title">'.link_to( $network->getName(), 'network/show?id=' . $network->getId() ).'</div>';
						echo ' <div class="spacer"></div>';
					  }
					}
					?>
			 
			
			</div>
		  <div class="left-bottom"></div>
		</div>




<?php if($mynetworks != NULL) : ?>


    <div id="what-is">
		<div style="width: 30px; float: left;">
		  <img height="25" width="42" alt="" src="/images/green_arrow.jpg"/>
		</div>
		<p style="font-size: 16px; color: rgb(28, 81, 124); font-weight: bold; margin-left: 55px;">
		Your Networks
		</p>
	  </div>
  
  
		<div class="left-bg">
		  <div class="left-top"></div>
			<div class="content">
			
			  		<?php foreach( $mynetworks as $network ): ?> 
  
  
  					<?php 
				
							$c = new Criteria(); 
							$c->add(NetworkPeer::ID,$network->getNetworkId());
							$networkagain = NetworkPeer::doSelectOne($c);  
							
							
						echo ' <div class="title">'.link_to( $networkagain->getName(), 'network/show?id=' . $networkagain->getId() ).'</div>';
						echo ' <div class="spacer"></div>';
					?> 
					
					<?php endforeach ; ?>		

					
					
			 
			
			</div>
		  <div class="left-bottom"></div>
		</div>
	
		

<?php endif; ?> 


</div>