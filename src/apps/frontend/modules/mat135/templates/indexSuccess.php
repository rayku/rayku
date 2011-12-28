<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
.content {
	padding: 40px 80px;
	font-size:16px;
	line-height:20px;
	color:#666;
}
.content h1 {
	font-size:40px;
	font-family: "Myriad Pro", "Lucida Grande", "Verdana", sans-serif;
	line-height:56px;
	color:#006699;
}
.content h2 {
	font-size:20px;
	line-height:30px;
	color:#333333;
}
.content h3 {
	font-size:18px;
	line-height:24px;
	color:#666;
	margin-top:20px;
}
.content p {
	margin-top:10px;
}
/* Easy Slider */

	#slider ul, #slider li,
	#slider2 ul, #slider2 li{
		margin:0;
		padding:0;
		list-style:none;
		}
	#slider2{margin-top:1em;}
	#slider li, #slider2 li{ 
		/* 
			define width and height of list item (slide)
			entire slider area will adjust according to the parameters provided here
		*/ 
		width:487px;
		height:241px;
		overflow:hidden;
		}	
	#prevBtn, #nextBtn,
	#slider1next, #slider1prev{ 
		display:block;
		width:30px;
		height:77px;
		position:absolute;
		left:-30px;
		top:71px;
		z-index:1000;
		}	
	#nextBtn, #slider1next{ 
		left:696px;
		}														
	#prevBtn a, #nextBtn a,
	#slider1next a, #slider1prev a{  
		display:block;
		position:relative;
		width:30px;
		height:77px;
		background:url(../images/btn_prev.gif) no-repeat 0 0;	
		}	
	#nextBtn a, #slider1next a{ 
		background:url(../images/btn_next.gif) no-repeat 0 0;	
		}	
		
	/* numeric controls */	

	ol#controls{
		margin:1em 0;
		padding:0;
		height:28px;	
		}
	ol#controls li{
		margin:0 10px 0 0; 
		padding:0;
		float:left;
		list-style:none;
		height:28px;
		line-height:28px;
		}
	ol#controls li a{
		float:left;
		height:28px;
		line-height:28px;
		border:1px solid #ccc;
		background:#FFF;
		color:#555;
		padding:0 10px;
		text-decoration:none;
		}
	ol#controls li.current a{
		background:#05699A;
		color:#fff;
		}
	ol#controls li a:focus, #prevBtn a:focus, #nextBtn a:focus{outline:none;}

</style>
<link rel="stylesheet" type="text/css" href="/css/custom/button.css"/>
<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/easySlider1.7.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				auto: true, 
				continuous: true,
				numeric: true
			});
		});	
	</script>
</head>
<body>
<div class="content">
<h1>Prep Package for MAT135 Students</h1>
<h2>We're giving away 500  free prep packages ($230 value). Here's what's included:</h2>
<div style="float:left;width:510px;margin-top:40px;">
<div id="slider" style="border:2px solid #09C;">
			<ul>				
				<li><img src="../mat/01.jpg" alt="Test prep session, live streamed"/></li>
				<li><img src="../mat/02.jpg" alt="Videos explaining every test 1 topic" /></li>
				<li><img src="../mat/03.jpg" alt="2 hours of private online tutoring" /></li>	
			</ul>
		</div>
        </div>
        <div style="float:left;width:290px;margin-top:40px;"><strong>1) Interactive prep session</strong>, live streamed online with an experienced MAT135 lecturer.
          <p><strong><br />
          2) Videos explaining every test 1 topic</strong> with complete step-by-step explainations.</p>
<p><strong><br />
  3) Two hours of private online tutoring</strong>, on demand, with an upper year who has taken MAT135 before. </p>
        </div>

<div style="clear:both"></div>

  <!-- Begin MailChimp Signup Form -->
<link href="http://cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff;clear:left;font:14px Helvetica,Arial,sans-serif;}
	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup" style="width:800px;margin-top:35px;padding:10px 0;border-top:2px solid #08B;border-bottom:2px solid #08B;background:#EAF3FF">
<form action="http://rayku.us2.list-manage.com/subscribe/post?u=eecba72f64b760137fde73e0c&amp;id=755e93b1fe" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
	<label for="mce-EMAIL">Send my prep package to this email address:</label>
	<div style="float:left;width:300px">
    <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required style="width:280px"> </div>
    <div style="float:left;width:200px">
    <input type="submit" class="myButton" value="Submit" name="subscribe" id="mc-embedded-subscribe" /> </div>
</form>
<div style="clear:both"></div>
</div>
<!--End mc_embed_signup-->
<div style="clear:both"></div>

<p>&nbsp;</p>
<p>&nbsp;</p>
<h3>Interactive prep session, live streamed</h3>
<p>Taught by Min founder of MGL Learning academy, 10 years teaching experience, 100% in calculus and MAT135 alumni. Ask Min questions live, online, as he delivers the prep session to your computer.</p>
<h3>Videos explaining every test 1 topic</h3>
<p>Don’t understand inverse functions of infinite limits? We have step by step videos explaining each of these individual topics so you can gain a deeper understanding. It’s all tailored for MAT135.</p>
<h3>2 hours of private online tutoring</h3>
<p>Connect with an upper-year tutor who had taken MAT135 before, even if it’s 2am in the morning. Get immediate, on-demand tutoring over Rayku’s live shared whiteboard. It all happens online.</p>
<p>&nbsp;</p>
<h3><strong>Why are we doing this?</strong></h3>
<p><a href="http://www.youtube.com/watch?v=eHN78jqeEb8" target="_blank">Rayku is</a> a new startup by UofT students - an  p2p tutoring website for help on the fly. We're the new kids on the block! Even though we are still in <em>private beta</em>, we wanted to announce ourselves to the world. </p>
<p>What better way to do so than to straight up give high-quality stuff away for free? So, we've partnered with our friends at <a href="http://www.prepanywhere.com" target="_blank">PrepAnywhere</a> to get you prepared for your first term test, free, with no strings attached. Enjoy!</p>

  <!-- Begin MailChimp Signup Form -->
<link href="http://cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff;clear:left;font:14px Helvetica,Arial,sans-serif;}
	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup" style="width:800px;margin-top:50px;padding:10px 0;border-top:2px solid #08B;border-bottom:2px solid #08B;background:#EAF3FF">
<form action="http://rayku.us2.list-manage.com/subscribe/post?u=eecba72f64b760137fde73e0c&amp;id=755e93b1fe" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
	<label for="mce-EMAIL">Send my prep package to this email address:</label>
	<div style="float:left;width:300px">
    <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required style="width:280px"> </div>
    <div style="float:left;width:200px">
    <input type="submit" class="myButton" value="Submit" name="subscribe" id="mc-embedded-subscribe" /> </div>
</form>
<div style="clear:both"></div>
</div>
<!--End mc_embed_signup-->
<div style="clear:both"></div>


</div>
</body>
