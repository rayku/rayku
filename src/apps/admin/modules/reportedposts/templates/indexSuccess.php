<style type="text/css">

	@import '/sf/sf_admin/css/main.css' ;

	@import '/sf/sf_admin/css/pagination.css' ;


</style> 
<link rel="stylesheet" type="text/css" media="screen" href="/css/pagination.css" />



<div id="sf_admin_container">  

<h1>Reported Threads</h1>

<div id="sf_admin_content"> 
<table class="sf_admin_list" cellspacing="0">
  <thead>
    <tr>
      <th>Id</th>
      <th>UserId</th>
      <th>title</th>
      <th>Date of repoted</th>
       <th>Delete</th>
        <th>Un-Report</th>
          <th>View Thread</th> 
    </tr>
  </thead>
  <tbody>

<?php
  
$tbl_name = "thread"; $adjacents = 1;


	$query = "SELECT COUNT(*) as num FROM $tbl_name where reported=1";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages['num'];

	$targetpage = "/admin.php/threads"; 	
	$limit = 10; 

								
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			
	else
		$start = 0;	

	$sql = "SELECT * FROM $tbl_name where reported=1 ORDER BY reported_date DESC LIMIT $start, $limit";
	$result = mysql_query($sql);
	

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
	
<?php foreach($repthreads as $_row)
	 {
			
    
$row = $i%2 ; ?>
	
	<tr class="sf_admin_row_<?=$row?>">


      <td><?php echo $_row['id']; ?></td>
     <td><?php echo $_row['poster_id']; ?></td>
      <td><?php echo $_row['title']; ?></td>
      <td><?php echo $_row['date']; ?></td>
      <td><?php echo $_row['delete']; ?></td>
       <td><?php echo $_row['un_report']; ?></td>
         <td><?php echo $_row['viewthread']; ?></td>
       

	
	<?php $i++; ?>


	<?php } ?>




  </tbody>

<tfoot>

<tr><div class="float-right">
<th colspan="9"><?php echo $pagination; ?> </th></div></tr>
</tfoot>
</table>














<h1>Reported Posts</h1>
<table class="sf_admin_list" cellspacing="0">
  <thead>
    <tr>
      <th>Id</th>
      <th>UserId</th>
      <th>Part of Conent</th>
      <th>Date of reported_date</th>
       <th>Delete</th>
        <th>Un-Report</th>
        <th>View Thread</th> 
        
    </tr>
  </thead>
  <tbody>

<?php
  
$tbl_name = "post"; $adjacents = 1;


	$query = "SELECT COUNT(*) as num FROM $tbl_name where reported=1";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages['num'];

	$targetpage = "/admin.php/threads"; 	
	$limit = 10; 

								
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			
	else
		$start = 0;	

	$sql = "SELECT * FROM $tbl_name where reported=1 ORDER BY reported_date DESC LIMIT $start, $limit";
	$result = mysql_query($sql);
	

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
	
<?php foreach($repposts as $_row)
	 {
			
    
$row = $i%2 ; ?>
	
	<tr class="sf_admin_row_<?=$row?>">


      <td><?php echo $_row['id']; ?></td>
     <td><?php echo $_row['poster_id']; ?></td>
      <td><?php echo $_row['title']; ?></td>
      <td><?php echo $_row['date']; ?></td>
      <td><?php echo $_row['delete']; ?></td>
       <td><?php echo $_row['un_report']; ?></td>
		  <td><?php echo $_row['viewthread']; ?></td>
	
	<?php $i++; ?>


	<?php } ?>




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


