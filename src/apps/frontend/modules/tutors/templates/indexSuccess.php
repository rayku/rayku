<script src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/jquery.livequery.js" type="text/javascript"></script>
<div id="tutorlist" style="padding-left:0px !important;">
  <?php 
include_partial( 'member_list', array( 'expert_cats' => $expert_cats, 'cat' => $cat, 'tutorsCount' => $tutorsCount, 'userId' => $userId, 'newOnlineUser' => $newOnlineUser, 'newOfflineUser' => $newOfflineUser, '_checkOnlineUsers' => $_checkOnlineUsers, 'course_id' => $course_id, 'rankCheckUsers' => $rankCheckUsers) ); ?>
</div>

<?php




 $tutcourse = !empty($_POST['course']) ? $_POST['course']: 1;
 $_SESSION['tutcourse'] = $tutcourse;
?>
<script type="text/javascript">
var rayku_tutor_pag = jQuery.noConflict();

//	rayku_tutor_pag("#ratesort").click(function () {
	rayku_tutor_pag('span#ratesort').livequery("click", function(e){
		rayku_tutor_pag('#resultpage').hide();
		rayku_tutor_pag("#loadingimage").show();
		var rate_get = rayku_tutor_pag("#ratesort").attr("class");
		rayku_tutor_pag.post("http://"+getHostname()+"/tutors/append?show_more_post=15&rate="+rate_get, {

		}, function(response){
			if(rate_get == 1)
			{
				rayku_tutor_pag("#ratesort").attr('class', 2);
				rayku_tutor_pag("#ratesymbol").hide();	
			}
			else if(rate_get == 2)
			{
				rayku_tutor_pag("#ratesort").attr('class', 1);
				rayku_tutor_pag("#ratesymbol").show();
			}
			rayku_tutor_pag("#loadingimage").hide();
			rayku_tutor_pag('#resultpage').show();
			rayku_tutor_pag('#resultpage').html(response);
			
		});
		
	});
</script>
<script type="text/javascript">
var rayku_tutor_pag = jQuery.noConflict();
rayku_tutor_pag(document).ready(function(){	
	
	
	rayku_tutor_pag.post("http://"+getHostname()+"/tutors/append?show_more_post=15", {

	}, function(response){
		rayku_tutor_pag("#loadingimage").hide();
		rayku_tutor_pag('.cn-content').append(response);
	});
	
		
	});		


	 rayku_tutor_pag('a.more_records').livequery("click", function(e) {

		  rayku_tutor_pag('#bottomMoreButton .spinner').show();
		
			var next =  rayku_tutor_pag(this).attr('id').replace('more_','');
			//alert(next);
			var name =  rayku_tutor_pag(this).attr('name');
			var file = 'http://'+getHostname()+'/tutors/append';
			
			var keepID = 1;//$('#keepID').val();
			var posted_on = 1;//$('#posted_on').val();
			
			rayku_tutor_pag.post(file+"?show_more_post="+next+'&x='+keepID+'&p='+posted_on, { }, 
				function(response){
				
				//rayku_tutor_pag('#bottomMoreButton').remove();
				rayku_tutor_pag('#resultpage').html(rayku_tutor_pag(response));
			});
		});	
</script>
