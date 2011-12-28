<link href="http://<?php echo RaykuCommon::getCurrentHttpDomain(); ?>/styles/classroom.css" type="text/css" rel="stylesheet" />

<div class="body-main">

<div class="entry" style="margin-bottom:11px;margin-top:50px;">

    <div class="top"></div>

       <div class="content">

       	<div class="hand-in">

        	<div class="email-st">

						
									
									<table>
									
									<tr>
									<th><label>Category:</label> </th>
									<td><label>
									<?php 
									
									$category = CategoryPeer::retrieveByPk($classroom->getCategoryId());
									
									echo $category->getName(); 
									
									?></label>
									</td>
									</tr>
									
									<tr>
									<th><label>Fullname:</label> </th>
									<td><label><?php echo $classroom->getFullname() ?></label></td>
									</tr>
									
									
									<tr>
									<th><label>Shortname:</label></th>
									<td><label><?php echo $classroom->getShortname() ?></label></td>
									</tr>
									
									<tr>
									<th><label>Summary:</label> </th>
									<td><label><?php echo $classroom->getSummary() ?></label></td>
									</tr>
									
									
									
									<tr>
									<th><label>Created at: </label></th>
									<td><label><?php echo $classroom->getCreatedAt() ?></label></td>
									</tr>
									
									
									
									<tr>
									<th><label>Updated at: </label></th>
									<td><label><?php echo $classroom->getUpdatedAt() ?></label></td>
									</tr>
									
									</table>
									
									
									<?php echo link_to('edit', 'classmanager/edit?id='.$classroom->getId(), array('class' => 'blue', 'style' => 'margin-right: 10px; line-height: 38px;')) ?>
									
									
									
									&nbsp;<?php echo link_to('list', 'classmanager/list',array('class' => 'blue', 'style' => 'margin-right: 10px; line-height: 38px;')) ?>


				  </div>
				  
				  

                </div>

            </div>

            <div class="bottom"></div>

        </div>

</div><!-- end of body-main -->