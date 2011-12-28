<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />

<?php 
$temp1=0;
$temp2=0;
$temp3=0;

$raykuUser = $sf_user->getRaykuUser();
?>

<div class="body-main">

<div class="title" style="float:left; margin-left:20px; margin-top:20px;">
        	<img src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/newspaper.gif" alt="" />
            <p>Edit notifications</p>
</div>

 <div class="spacer" style="margin-top:60px;"></div>

<?php foreach($classroom as $class) : ?>

<?php 	
			$c=new Criteria();
			$c->addJoin(UserPeer::ID,ClassroomPeer::USER_ID,Criteria::JOIN);
			$c->add(ClassroomPeer::ID,$class->getId());
			$classuser=UserPeer::doSelectOne($c);
?>	
	
	 <div class="entry" style="margin-bottom:11px;">
        	<div class="top"></div>
            <div class="content">
            	<div style="border:1px solid #fff">
                	<div class="titles" style="margin:0;">
						<a href="#" class="title02" style="float:left; color: #2b5d85;"><?php echo $classuser->getName();?>'s <?php echo $class->getFullname(); ?> Class :</a>
                    </div>
	
			<?php foreach($subscription as $subscibe) :
		
			if( ($subscibe->getClassroomId()==$class->getId()) && ($subscibe->getUserId()==$raykuUser->getId()) && ($subscibe->getNotificationType()== '1')) :
						
						$temp1=1;
						$currentclassid=$subscibe->getClassroomId();
						
										
			elseif(($subscibe->getClassroomId()==$class->getId()) && ($subscibe->getUserId()==$raykuUser->getId()) && ($subscibe->getNotificationType()=='2'))	:
			
						$temp2=2;
						$currentclassid=$subscibe->getClassroomId();
						
			elseif(($subscibe->getClassroomId()==$class->getId()) && ($subscibe->getUserId()==$raykuUser->getId()) && ($subscibe->getNotificationType()=='3'))	:
			
						 $temp3=3;
						 $currentclassid=$subscibe->getClassroomId();
					
			endif;
					
			endforeach ;
		?>
		
		
				<div class="clear-both"></div>
                </div>

                <div class="paragraph" style="margin:0;">
                	<div id="bordersplitter"></div>
                    <div class="text" style="border-bottom:0;">
                    	
					
		<?php if( ($temp2 == '2') && ($currentclassid== $class->getId()) ) : ?>
					
					
					<div class="subscribed">
					<?php echo link_to('Subscribed to news','studentaccess/subscribe?userid='.$raykuUser->getId().'&classid='.$class->getId().'&stype=2', array('class'=>'notpg')); ?>
					</div>
					
		<?php  else: ?>
					
					 <div class="notsub">					
					<?php echo link_to('NOT subscribed to news','studentaccess/subscribe?userid='.$raykuUser->getId().'&classid='.$class->getId().'&stype=2', array('class' => 'strong')); ?>
					</div>
					 
		<?php  endif;  ?> 
		
		<?php if( ($temp3== '3' ) && ($currentclassid == $class->getId()) ) : ?>
		
				 <div class="subscribed">
				 <?php echo link_to('Subscribed to due-dates','studentaccess/subscribe?userid='.$raykuUser->getId().'&classid='.$class->getId().'&stype=3', array('class'=>'notpg')); ?>
				</div>
		<?php else: ?>
		
				  <div class="notsub"> 
				 <?php echo link_to('NOT subscribed to due-dates','studentaccess/subscribe?userid='.$raykuUser->getId().'&classid='.$class->getId().'&stype=3', array('class' => 'strong')); ?>
				 </div>
		<?php  endif;  ?> 
		
		
		<?php if( ($temp1== '1') && ($currentclassid == $class->getId()) ) : ?>
					
					<div class="subscribed">
					<?php echo link_to('Subscribed to assignments','studentaccess/subscribe?userid='.$raykuUser->getId().'&classid='.$class->getId().'&stype=1', array('class'=>'notpg')); ?>
					</div>
		 
		 <?php  else: ?>
		 
		 			<div class="notsub">
					<?php echo link_to('NOT subscribed to assignments','studentaccess/subscribe?userid='.$raykuUser->getId().'&classid='.$class->getId().'&stype=1', array('class' => 'strong')); ?>
					</div>
			<?php  endif;  ?> 													 
					    <div class="clear-both"></div>
                    </div>
                </div>

            </div>
            <div class="bottom"></div>
        </div>
		
		<?php 
		$temp1=0;
		$temp2=0;
		$temp3=0;
	 	?>
<?php endforeach; ?>

</div><!-- end of body-main -->
