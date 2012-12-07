<script type="text/javascript" src="/scripts/landing.js"></script>
<script type="text/javascript" src="/video/flowplayer-3.2.2.min.js"></script>
<div id="slider" style="margin-bottom:30px">
  <div style="margin-top:30px"></div>  
  <!--pages-->
  
  <ul class="tabNav">
    <li id="side_menu_tab11" class="current"><a href="javascript:side_menu('side_menu_tab1')" class="tab">Overview</a></li>
    <li id="side_menu_tab21" class=""><a href="javascript:side_menu('side_menu_tab2')" class="tab">Expert Tutors</a></li>
    <li id="side_menu_tab31" class="" ><a href="javascript:side_menu('side_menu_tab3')" class="tab">Live Whiteboard</a></li>
    <div class="clear"></div>
  </ul>
  <div class="tabContainer">
    <div id="side_menu_tab1" class="tab current"> <img src="<?php echo image_path('overview-screen.jpg', false); ?>" alt="img" />
      <h1>&quot;24/7 Access to the Best Tutors, with a Click of the Mouse&quot;</h1>
      <p> <strong>Rayku</strong> lets students get tutoring help online. With the most relevant tutors. Over a beautiful online whiteboard. In under 60 seconds. </p>
      <p>Check out what we're all about in this introductory video:<br />
      <iframe src="http://fast.wistia.com/embed/iframe/6311e77c10?videoWidth=640&videoHeight=360&playerColor=313131" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" width="640" height="360"></iframe>
      </p>
      <ul class="features">
        <div class="clear"></div>
      </ul>
      <p style="margin:20px 0 0 0"><strong><a href="javascript:side_menu('side_menu_tab2')" style="color:#1c517c">NEXT: Expert Tutors &gt;&gt;</a></strong></p>
    </div>
    
    <!--tab-->
    
    <div id="side_menu_tab2" class="tab"> <img src="<?php echo image_path('livehelp-screen.jpg', false); ?>" alt="img" />
      <h1>Connect with the tutor best suited to help you!</h1>
      <p>Rayku takes an algorithmic and systematic approach to connect you to an online expert who is specifically qualified to assist YOU.</p>
      <p><strong>What this means for you:</strong> Whenever, Wherever. If you have a question or need advice, right at this moment, Rayku has you covered!</p>
      <p style="margin-bottom:0"><a href="javascript:side_menu('side_menu_tab3')" style="color:#1c517c"><strong>NEXT: Live Whiteboard &gt;&gt;</strong></a></p>
    </div>
    
    <!--tab-->
    
    <div id="side_menu_tab3" class="tab"> <img src="<?php echo image_path('whiteboard-screen.jpg', false); ?>" alt="img" />
      <h1>Rayku works because we show, not tell.</h1>
      <p>We've put together a fast and easy-to-use whiteboard app, with everything from audio/video to a sleek math equation writer. Connect with your online tutor immediately for a painless experience. </p>
      <p><strong>What this means for you:</strong> Bypass the 'joy' of flipping through that 5kg sleeping pill. Give Rayku a try and a real person will <em>show</em> you how to solve your problem.</p>
      <p style="margin-bottom:0"><a href="http://www.rayku.com/register" style="color:#1c517c"><strong>Register for Free</strong></a></p>
    </div>

    <!--tab-->

    <div class="tr"></div>
    <div class="br"></div>
  </div>
  
  <!--tabcontainer-->  
  <div class="clear"></div>

</div>

<script type="text/javascript">
var menu_array=["side_menu_tab1","side_menu_tab2","side_menu_tab3"]; 
function side_menu(tag_id)
{
//alert(tag_id);
var tabnextarrow_ele=document.getElementById('tab_rightarrow');
var tableftarrow_ele=document.getElementById('tab_leftarrow');
 if(document.getElementById(tag_id).className=="tab")
 {
  for(var i=0; i<menu_array.length;i++)
  {
  	document.getElementById(menu_array[i]).className="tab";
	document.getElementById(menu_array[i]+"1").className="";
  }
   selected_tab(tag_id);
 }
 	if(tag_id=="side_menu_tab1")
	{
	tabnextarrow_ele.href="javascript:side_menu('side_menu_tab2');";
	tableftarrow_ele.href="javascript:side_menu('side_menu_tab3');";
	}
	
	else if(tag_id=="side_menu_tab2")
	{
	tabnextarrow_ele.href="javascript:side_menu('side_menu_tab3');";
	tableftarrow_ele.href="javascript:side_menu('side_menu_tab1');";
	}
	
	else if(tag_id=="side_menu_tab3")
	{
	tabnextarrow_ele.href="javascript:side_menu('side_menu_tab1');";
	tableftarrow_ele.href="javascript:side_menu('side_menu_tab2');";
	}
}
function selected_tab(tag_id)
{	
	/*$("#"+tag_id).fadeIn();	*/
  	document.getElementById(tag_id).className="tab current";
	document.getElementById(tag_id+"1").className="current";

}
</script> 
