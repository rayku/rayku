<script type="text/javascript" src="/scripts/landing.js"></script>
<script type="text/javascript" src="/video/flowplayer-3.2.2.min.js"></script>
<div id="slider" style="margin-bottom:30px">
  <div style="margin-top:30px"></div>  
  <!--pages-->
  
  <ul class="tabNav">
    <li id="side_menu_tab11" class="current"><a href="javascript:side_menu('side_menu_tab1')" class="tab">Overview</a></li>
    <li id="side_menu_tab21" class=""><a href="javascript:side_menu('side_menu_tab2')" class="tab">Help Now!</a></li>
    <li id="side_menu_tab31" class="" ><a href="javascript:side_menu('side_menu_tab3')" class="tab">Live Whiteboard</a></li>
    <li id="side_menu_tab41"  class="" ><a href="javascript:side_menu('side_menu_tab4')" class="tab">Earn Cash</a></li>
    <div class="clear"></div>
  </ul>
  <div class="tabContainer">
    <div id="side_menu_tab1" class="tab current"> <img src="images/overview-screen.jpg" alt="img" />
      <h1>&quot;Have 24/7 Access to Experts, with a Click of the Mouse&quot;</h1>
      <p><strong>Rayku.com</strong> is a p2p micro-tutoring platform that lets students <strong>share</strong> and <strong>ask</strong> for academic help on demand, in real time. With Rayku, you can...</p>
      <ul class="features">
        <li>Connect with a <em>live</em> expert for <a href="javascript:side_menu('side_menu_tab2')" style="color:#00790A"><strong>Help Now!</strong></a></li>
        <li><a href="javascript:side_menu('side_menu_tab4')" style="color:#00790A"><strong>Earn Rayku Points</strong></a> redeemable as cash.</li>
        <li>Use a <a href="javascript:side_menu('side_menu_tab3')" style="color:#00790A"><strong>Live Whiteboard</strong></a> for limitless comm.</li>
        <div class="clear"></div>
      </ul>
      <p style="margin:20px 0 0 0"><strong><a href="javascript:side_menu('side_menu_tab2')" style="color:#1c517c">Start the Tour</a></strong></p>
    </div>
    
    <!--tab-->
    
    <div id="side_menu_tab2" class="tab"> <img src="images/livehelp-screen.jpg" alt="img" />
      <h1>Chat with the right expert whenever, wherever, online!</h1>
      <p>Rayku takes a algorithmic and systmatic approach to connect you to a peer expert that is specifically qualified to assist YOU. No, you don't have to wait in line!</p>
      <p><strong><u>What this means for you</u>:</strong> Whenever, Wherever. If you have any question or need any advice, right at this moment, Rayku has you covered.</p>
      <p style="margin-bottom:0"><a href="javascript:side_menu('side_menu_tab3')" style="color:#1c517c"><strong>NEXT: Live Whiteboard &gt;&gt;</strong></a></p>
    </div>
    
    <!--tab-->
    
    <div id="side_menu_tab3" class="tab"> <img src="images/whiteboard-screen.jpg" alt="img" />
      <h1>Rayku works because we show, not tell.</h1>
      <p>We've invested thousands in putting together a fast, compact, and easy-to-use whiteboard app, so you can connect with your online expert immediately for speedy <u>results</u>. </p>
      <p><strong><u>What this means for you</u>:</strong> Bypass the 'joy' of flipping through that 5kg sleeping pill. Give Rayku a try and a real person will <em>show</em> you the solution.</p>
      <p style="margin-bottom:0"><a href="javascript:side_menu('side_menu_tab4')" style="color:#1c517c"><strong>NEXT: Earn Cash&gt;&gt;</strong></a></p>
    </div>
    
    <!--tab-->
    
    <div id="side_menu_tab4" class="tab"> <img src="images/shop-screen.jpg" alt="img" />
      <h1>Add to your resume, earn cool stuff, be part of the revolution!</h1>
      <p>Our smart system lets you join in on the conversation, and be rewarded in the process. Give back your expertise by helping peers that have questions that you can answer.</p>
      <p>By participating, you can earn Rayku Points - currently on par with the Canadian dollar (1RP = C$1).</p>
      <p><strong><u>What this means for you</u>:</strong> Build a stronger resume that you can show, win certification, and get cool stuff - all while contributing back to your community.</p>
      <p style="margin-bottom:0"><a href="http://www.rayku.com/register" style="color:#1c517c"><strong>Register for Free</strong></a></p>
    </div>
    
    <!--tab-->

    <div class="tr"></div>
    <div class="br"></div>
  </div>
  
  <!--tabcontainer-->
  
  <div class="clear"></div>
  
  
  <!--
  
  <div class="description">
    <div class="text">
      <h1 style="font-size:22px; margin:12px 0">Create your free account in 59 seconds...</h1>
      <p>Get started right now with your free account, and gain access to all of Rayku's features immediately!</p>
      <p>Register now and we will get you started with <strong>C$10.00</strong> worth of Rayku Points <em>(limited, while supplies last)</em>. Use coupon code <strong>'launch11'</strong>.</p>
      <a class="start" href="http://www.rayku.com/register">Get started for free!</a> </div>
    
    
    <div class="video"> <a href="http://www.rayku.com/landing/video.flv" id="player" style="display:block;width:430px;height:242px;color:#FFF"> <img src="/images/prescreen.jpg" alt="Rayku Introduction Video" /> </a> 
    <script language="JavaScript">
			flowplayer("player", "http://www.rayku.com/video/flowplayer-3.2.2.swf", {
				    clip : {
						autoBuffering: true,
					},
					onLoad: function() {	// called when player has finished loading
						this.setVolume(100);	// set volume property
					}
			});
            </script>  </div>
    
    
    <div class="clear"></div>
  </div>
  -->
  
</div>
<script type="text/javascript">

var menu_array=["side_menu_tab1","side_menu_tab2","side_menu_tab3","side_menu_tab4"]; 

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

	tableftarrow_ele.href="javascript:side_menu('side_menu_tab4');";

	}

	

	else if(tag_id=="side_menu_tab2")

	{

	tabnextarrow_ele.href="javascript:side_menu('side_menu_tab3');";

	tableftarrow_ele.href="javascript:side_menu('side_menu_tab1');";

	}

	

	else if(tag_id=="side_menu_tab3")

	{

	tabnextarrow_ele.href="javascript:side_menu('side_menu_tab4');";

	tableftarrow_ele.href="javascript:side_menu('side_menu_tab2');";

	}

	

	else if(tag_id=="side_menu_tab4")

	{

	tabnextarrow_ele.href="http://www.rayku.com/register";

	tableftarrow_ele.href="javascript:side_menu('side_menu_tab3');";

	}


}

function selected_tab(tag_id)

{	

	/*$("#"+tag_id).fadeIn();	*/

  	document.getElementById(tag_id).className="tab current";

	document.getElementById(tag_id+"1").className="current";



}

</script> 
