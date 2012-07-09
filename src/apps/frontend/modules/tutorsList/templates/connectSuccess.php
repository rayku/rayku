<link rel="stylesheet" type="text/css" href="/css/global.css" />
<link rel="stylesheet" type="text/css" href="/styles/classroom.css" />

<div align="center" style="margin-top:40px;">
	<div class="entry" style="margin-bottom:10px;">
		<div class="top"></div>
		<div class="content">
			<div class="title">
			Notifying Tutors Now
			</div>
			<div class="hand-in" style="line-height:20px;font-size:14px;color:#333;margin-top:10px;">
				<center><img src="/images/loading1.gif" alt="loading.." />
				<br />You will be automatically redirected. <br /><strong>Wait time:</strong> <span id="countdown"></span>
				<div id="notifier"></div><br />
				<em>Pro Tip: Sessions don't start until the 'start session' button is clicked.</em></center></div>
			</div>
			<div class="bottom"></div>
			<input type="hidden" name="connected_tutors" id="connected_tutors" value="<?php echo $count; ?>" />
		</div>
	</div>
<script type="text/javascript">
  /* Countdown Timer */	
  function display( notifier, str ) {
    document.getElementById(notifier).innerHTML = str;
  }
        
  function toMinuteAndSecond( x ) {
    return Math.floor(x/60) + " Minute : " + x%60+" Seconds";
  }
        
  function setTimer( remain, actions ) {
    (function countdown() {
       display("countdown", toMinuteAndSecond(remain));         
       actions[remain] && actions[remain]();
       (remain -= 1) >= 0 && setTimeout(arguments.callee, 1000);
    })();
  }
  var counter = <?php echo $count; ?>;
  if(counter==4)
  {
  	var timer = (4*45)+30;  	
  }
  else if(counter==3)
  {
  	var timer = (3*45)+30;  	
  }
  else if(counter==2)
  {
  	var timer = (2*60)+30;
  }
  else if(counter==1)
  {
  	var timer = 60;  	
  }
  	
  setTimer(timer, {    
  });   

</script>	
