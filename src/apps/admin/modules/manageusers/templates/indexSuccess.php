<style type="text/css">

	@import '/sf/sf_admin/css/main.css' ;

	@import '/sf/sf_admin/css/pagination.css' ;


</style> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" media="screen" href="http://www.rayku.com/css/pagination.css" />



<div id="sf_admin_container">  

<h1>Users List</h1>


<div id="sf_admin_content"> 
<table class="sf_admin_list" cellspacing="0">
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Category</th>
      <th></th>
    </tr>
  </thead>
  <tbody>

<?php
  
$tbl_name = "user"; $adjacents = 1;


	$query = "SELECT COUNT(*) as num FROM $tbl_name";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages['num'];

	$targetpage = "/admin.php/manageusers"; 	
	$limit = 50; 

								
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			
	else
		$start = 0;	

	$sql = "SELECT * FROM $tbl_name ORDER BY id ASC LIMIT $start, $limit";


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



  	<?php $i=0; $j =1;?>
	
<?php while($_row = mysql_fetch_array($result))
		{
	
$ID = $_row['id'];

$row = $i%2 ; ?>
	
	<tr class="sf_admin_row_<?=$row?>">
<td><!--<input type="checkbox" value="<?php echo $_row['id']; ?>">--> <?php echo $_row['id']; ?>
     <td><?php echo $_row['name']; ?></td>

<?php 

		$_queryCategory = mysql_query("select * from expert_category where user_id = ".$_row['id']."") or die(mysql_error());
echo "<td>";
		if(mysql_num_rows($_queryCategory) > 0) : 

			echo "<table>";

			while($_rowCategory = mysql_fetch_assoc($_queryCategory)) {

			$_Category = mysql_query("select * from category where id = ".$_rowCategory['category_id']."") or die(mysql_error());

			if(mysql_num_rows($_Category) > 0) : 
	
				$_rowcategory = mysql_fetch_assoc($_Category);

				$id = ''; $_id = $_rowCategory['id'];
				echo "<tr><td>"; echo $_rowcategory['name'];echo "</td>";

				echo "<td> <a href='http://www.rayku.com/admin.php/manageusers/category?id=$_id&page=$page'>Delete</a>"; echo "</td></tr>";	

			endif;

			}

			echo "</table>";

		endif;

echo "</td>";

?>

	  <td><?php echo "<a href='http://www.rayku.com/admin.php/manageusers/users?id=$ID&page=$page'>Delete</a>"; ?></td>

	<?php $i++; $j++;?>


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

<script type='text/javascript'>
function Delete(id) {

var vd = jQuery.noConflict();

"sf_admin_container"

   vd.ajax({ cache: false,
	    type : "GET",
	    url: "http://www.rayku.com/admin.php/manageusers/category?id="+id	

	});

//vd.ajax('#loaddiv').fadeOut('slow').load('http://www.rayku.com/admin.php/manageusers/index.php').fadeIn("slow");


}
</script>

