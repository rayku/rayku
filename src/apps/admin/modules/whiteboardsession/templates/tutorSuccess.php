<style type="text/css">

	@import '/sf/sf_admin/css/main.css' ;

	@import '/sf/sf_admin/css/pagination.css' ;


</style> 

<style>
.back-image {
padding : 15px 15px 15px 875px;

} 
</style> 
<link rel="stylesheet" type="text/css" media="screen" href="/css/pagination.css" />



<div id="sf_admin_container">  

<h1>Whiteboard Tutor's Experience In Session</h1>


<div id="sf_admin_content"> 

<table class="sf_admin_list" cellspacing="0">
  <thead>
    <tr>
      <th>Whiteboard Chat Id</th>
      <th>Date</th>
      <th>Tutor Name</th>
      <th>Audio/Video Quality</th>
      <th>Whiteboard Usability</th>
      <th>Overall Session Experience</th>
      <th>Feedback</th>
      <th>View</th>

    </tr>
  </thead>
  <tbody>

<?php

    $adjacents = 1;
    $total_pages = WhiteboardTutorFeedbackPeer::doCount(new Criteria);
        
    $targetpage = "/admin.php/whiteboardsession/tutor";  	$limit = 50; 

    $page = @$_GET['page'];
    if($page) 
        $start = ($page - 1) * $limit; 			
    else
        $start = 0;	

    $criteria = new Criteria;
    $criteria->setOffset($start);
    $criteria->setLimit($limit);
    $criteria->addDescendingOrderByColumn(WhiteboardTutorFeedbackPeer::CREATED_AT);
    $wtfS = WhiteboardTutorFeedbackPeer::doSelect($criteria);


	if ($page == 0) $page = 1;					
	$prev = $page - 1;							
	$next = $page + 1;							
	$lastpage = ceil($total_pages/$limit);		
	$lpm1 = $lastpage - 1;	

$pagination = "";

	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev\">« previous</a>";
		else
			$pagination.= "<span class=\"disabled\">« previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\">next »</a>";
		else
			$pagination.= "<span class=\"disabled\">next »</span>";
		$pagination.= "</div>\n";		
	}?>



  	<?php $i=0; ?>
	
<?php
/* @var $wtf WhiteboardTutorFeedback */
foreach ($wtfS as $wtf) {
    $row = $i%2 ;
    $_audio = changeText($wtf->getAudio());
    $_use = changeText($wtf->getUsability());
    $_overall = changeText($wtf->getOverall());
    $_tutor_name = getUsername($wtf->getExpertId());
?>
	
<tr class="sf_admin_row_<?php echo $row; ?>">
    <td><?php echo $wtf->getWhiteboardChatId(); ?></td>
    <td><?php echo $wtf->getCreatedAt(); ?></td>
    <td><b><?php echo $_tutor_name; ?></b></td>
    <td><?php echo $_audio; ?></td>
    <td><?php echo $_use; ?></td>
    <td><?php echo $_overall; ?></td>
    <td><?php echo $wtf->getFeedback(); ?></td>
    <td><a href="/whiteboard/show/id/<?php echo $wtf->getWhiteboardChatId(); ?>">View</a></td>
</tr>    
<?php
	
$i++;
}

?>




  </tbody>

<tfoot>

<tr><div class="float-right">
<th colspan="9"><?php echo $pagination; ?> </th></div></tr>
</tfoot>
</table>

<ul class="sf_admin_actions">

</ul>

</div>

</div>
<?php


function changeText($value) {
$text = 'Not Sure';

        switch ($value) {
            case '1':  $text =  'Not Sure'; break;
            case '2':  $text = 'Excellent'; break;
            case '3':  $text = 'Good';  break;
            case '4':  $text = 'Fair';  break;
            case '5':  $text = 'Poor';  break;
	   case '6':  $text = 'Bad';  break;
	   default :  $text =  'Not Sure'; break;

        }

return $text;
}

function getUsername($id) {
$name = '';

        RaykuCommon::getDatabaseConnection();

	$_query = mysql_query("select * from user where id=".$id) or die("Error1".mysql_error());
	if(mysql_num_rows($_query)) :

		$_row = mysql_fetch_assoc($_query);

		$name = ucfirst($_row['name']);
	endif;

return $name;
}

?>


