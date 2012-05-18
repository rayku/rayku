
<script type="text/javascript">
			
			
			function DeltetAll(count_msgs)
			{
			
				//document.getElementById('checkbox').checked=true;
			//field[i].checked = true ;
			//document.myform.checkbox.checked=true;
					var i=0;
					var j=0;
					
					var deletemessages=Array();
				
				
					for (i = 0; i < count_msgs; i++)
					{
							if(document.getElementById('PM_Check['+i+']').checked)
							{
								//alert(document.getElementById('PM_Check['+i+']').value);
								deletemessages[j++]=document.getElementById('PM_Check['+i+']').value
							}
							else
							{
								//alert("not checked");
							}
					}
					if(j==0)
					{
					alert("Please select messages to delete ");
					return false;
					}
					if(!confirm("Do you really want to delete seleted messages"))
					{
						return false;
					}
					document.getElementById('loadingdelete').innerHTML='<h2 style=" font-size:bold;">Deleting Seleted messages....</h2>';
				var xmlHttp;
				try
				  {
				  // Firefox, Opera 8.0+, Safari
				  xmlHttp=new XMLHttpRequest();
				  
				  }
				catch (e)
				  {
				  // Internet Explorer
				  try
					{
					xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
					
					}
				  catch (e)
					{
					try
					  {
					  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
					  
					  }
					catch (e)
					  {
					  alert("Your browser does not support AJAX!");
					  return false;
					  }
					}
				  }
				  xmlHttp.onreadystatechange=function()
					{
					
					if(xmlHttp.readyState==4)
					  {
						
						//var response=xmlHttp.responseText;
						
							window.location.reload();
							
						//document.getElementById('popuplogin').innerHTML=suggestform;
							//document.getElementById('popuplogin').style.display= 'none';
							
                       }
					}
					//document.getElementById('popuplogin').innerHTML="<p align='center'><img src='images/Send-Mail.gif' /></p>";
					var url = "http://www.rayku.com/js/delete_pms.php?deletemessages="+deletemessages;
					
					//document.getElementById('popuplogin').innerHTML="<b>Sending Mail.........</b>";
					xmlHttp.open("GET",url,true);
					xmlHttp.send(null);
						/*if(document.getElementById('checkall').checked==true)
						{
						
						for (i = 0; i < field.length; i++)
							field[i].checked = true ;
						}
						else
						{	
							for (i = 0; i < field.length; i++)
							field[i].checked = false ;
						}*/
			}
			function checkAll(cond,count)
			{
			var bool;
			if(cond==1)
			{
			bool=true;
				
			}
			else
			{
				bool=false;
			}
					for (i = 0; i <count; i++)
					{
						document.getElementById('PM_Check['+i+']').checked=bool;
							
					}
			}
</script>	
<div class="body-main">
  <div id="what-is">
    <div style="width:30px;float:left;"> <img height="25" width="42" alt="" src="<?php echo image_path('green_arrow.jpg', false); ?>"/> </div>
    <p style="font-size:16px;color:rgb(28, 81, 124);font-weight:bold;margin:0 0 32px 55px;"> Private Messages </p>
  </div>
  <div id="msgnav">
    <?php
	
      if($messageRowPartialName == 'message_row_inbox')
      {
        echo link_to('Inbox', '@inbox',array('id'=>'inbox','class'=>"active"));
        echo link_to('Sent Messages', '@outbox',array('id'=>'sent'));
      }
      else
      {
        echo link_to('Inbox', '@inbox',array('id'=>'inbox'));
        echo link_to('Sent Messages', '@outbox',array('id'=>'sent','class'=>"active"));
      }
   
      echo link_to('Compose New Message', 'message/compose',array('id'=>'new'));
    ?>
    <div class="clear-both"></div>
  </div>
  <?php
    $messages = $raykuPager->getPager()->getResults();
	$count_msgs=0;
    if( count( $messages ) > 0 )
    { 
		echo "<div id='loadingdelete' >";
      foreach($messages as $message)
      {
        include_partial($messageRowPartialName, array('message' => $message,'count_msgs'=>$count_msgs));
		$count_msgs++;
      }
	  echo "</div>";
	  echo "<div style='margin:5px 0;font-size:14px;color:#006699'><a onclick='checkAll(1,".$count_msgs.")'  href='javascript:void(0)'>CheckAll</a> / <a onclick='checkAll(0,".$count_msgs.")' href='javascript:void(0)'>UncheckAll</a></div><br>";
	  echo  '<input type="button" id="submit" name="submit" value="Delete Now" onclick="DeltetAll('.$count_msgs.')" style="padding:4px;font-size:14px;">';
    }
    else
      echo '<div align="center" style="font-size:18px;padding:25px">You have no messages</div>';
  ?>

  <div class="spacer" style="margin-bottom: 15px;"></div>
  <?php include_partial('global/pager', array('raykuPager' => $raykuPager)); ?>
</div>
<?php include_partial('message/rightSideBlock', array('friends' => !isset( $friends ) ? array() : $friends ) ); ?>
