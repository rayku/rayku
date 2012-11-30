<style type="text/css">

</style>


<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/global.css" />

<div align="center" style="margin-top:40px;">
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />
	<div class="entry" style="margin-bottom:10px;">


    <div class="container">

        <h2 class="connecting">We're connecting you now</h2>

        <div class="tutor-status" style='display:none' value="">

            <div class="tutor-status-head clearfix">

                <h3 class="tutor">Notifying tutor <span class="tutor-queue-number">0</span> of <span class="tutor-total">4</span></h3>

                <h3 class="status">Status</h3>

            </div><!-- tutor status head -->

            <div class="tutor-status-body clearfix">

                <div class="tutor">

                    <!-- tutor img -->
                    <div class="tutor-img"><img src="" alt="George Clooney"/></div>

                    <!-- tutor name -->
                    <h2 class="tutor-name">George Clooney</h2>

                    <h4 class="tutor-position">Sophomore at University of Toronto
                        studying Astronomy and Astrophysics</h4>

                </div><!-- tutor -->

                <div class="status">

                    <div class="status-img spinner">
                        <img src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/spinner.gif" alt="loading.."/>
                    </div>

                    <div class="waiting-response">
                        Waiting for <strong><span class="tutor-first-name">Tutor</span></strong><br>to respond...</div>

                </div><!-- status -->

            </div><!-- tutor status body -->

            <div class="status-bar">

                <div class="bar-progress"></div>

            </div><!-- status bar -->        

        </div><!-- tutor status -->

    </div><!-- container -->


		<input type="hidden" name="connected_tutors" id="connected_tutors" value="<?php echo $_SESSION['connected_tutors']; ?>" />
	</div>
</div>
<script type="text/javascript">

//maximum time to wait for a tutor 
var tutor_wait_time = 60000 ; 
//polling interval for checking current tutor 
var tutor_poll_time = 4000; 


//handle to the progress bar 
$progress_bar = jQuery(".bar-progress");

//grab the total number of tutors being contacted 
ww_num_tutors = document.getElementById('connected_tutors').value; 

//set the total number of tutors being contacted
jQuery(".tutor-total").text(ww_num_tutors); 


//updates the current tutor markup 
function updateCurrentTutor(tutor_info){

  var $tutor_table = jQuery(".tutor-status");

  // id : current tutor being contacted on the server end 
  var id = tutor_info.id ;

  // active_id : current tutor being displayed on the client side 
  var active_id = $tutor_table.attr("value"); 
  
  if ( id != active_id ){

      console.log("id : " + id + " active id : " + active_id); 

      //set a maximum wait time for the tutor 
  	  clearTimeout(tutor_timeout);
  	  tutor_timeout = setTimeout(clearTutorQueue,tutor_wait_time); 

  		$tutor_table.fadeOut(500, function() {

        //set value for the table 
  			$tutor_table.attr("value", id); 

        //update tutor number 
        var tutor_number = parseInt(jQuery(".tutor-queue-number").text());
        tutor_number++; 
        jQuery(".tutor-queue-number").text(tutor_number); 
  			
        //set the tutor image and name 
  			jQuery(".tutor-img img").attr("src", tutor_info.pic_url);
  			jQuery(".tutor-name").text(tutor_info.full_name); 

        //create the tutor position string 
        var tutor_position = tutor_info.role + " at " + tutor_info.school + " studying " + tutor_info.study ; 
        jQuery(".tutor-position").text(tutor_position); 
        
        //grab tutors first name 
        first_name = tutor_info.full_name.split(" ");
        jQuery(".tutor-first-name").text(first_name[0]); 

        //reset the progress bar 
        $progress_bar.css("width","0%").stop(true); 

  			$tutor_table.fadeIn(500, function(){

          //start the progress bar 
          $progress_bar.animate({
            width : "100%"
          },tutor_wait_time, 'linear');

        }); 

  		});
  	}
}


tutor_timeout = setTimeout(clearTutorQueue,tutor_wait_time);


//polls the server to check which tutor is being contacted 
function checkCurrentTutor() {

	jQuery.ajax({ cache: false,
		type : "POST",
		url: "http://"+getHostname()+"/expertmanager/currenttutor",
		success : function (data)  {
			
      //if response is blank then no more tutors are being contacted - redirect 
			if(data == ""){
			  
				document.location = "http://"+getHostname()+"/expertmanager/studentconfirmation";

			}else{ // check if a different tutor is being contacted 

				var tutor_info = JSON.parse(data);
				updateCurrentTutor(tutor_info); 

			}
		}
	});
	
	setTimeout('checkCurrentTutor()', tutor_poll_time);

}

checkCurrentTutor();

//makes a request to the server to remove a tutor from the queue 
function clearTutorQueue(){

  var tutor_id = jQuery(".tutor-status").attr("value");

        jQuery.ajax({ cache: false,
                type : "POST",
                url: "http://"+getHostname()+"/expertmanager/nexttutor",
                data: {"currenttutor" : tutor_id } ,
                success : function (data)  {

                  console.log("Clear tutor request successful");

                }
        });

}


</script>	
