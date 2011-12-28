<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
.content {
	padding: 60px 80px;
	font-size:16px;
	line-height:20px;
	color:#666;
}
.content h1 {
	font-size:40px;
	font-family: "Myriad Pro", "Lucida Grande", "Verdana", sans-serif;
	line-height:56px;
	color:#069;
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
	margin-top:15px;
}
a {
	color: #069;
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
		background:#069;
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
<h1><strong>FREE</strong><sup style="font-size:16px;">*</sup> MAT133 Prep Package, Including:</h1>
<div style="float:left;width:290px;margin-top:40px;"><strong>1) Interactive prep session</strong>, live streamed online with <span onmouseover="this.style.color='#0055bb';this.style.cursor='pointer'" onmouseout="this.style.color='#333333';this.style.cursor='default'" onclick="return hotwordOneClick(this);">veteran</span> lecturer (Min, president of MGL Learning, 10 years experience, 100% in calculus).
  <p><strong><br />
    2) Videos explaining each test 1 topic</strong> with step-by-step explainations, all tailored specifically for MAT133.</p>
<p><strong><br />
  3) Two hours of private online tutoring</strong>, on demand, with  upper years who has taken MAT133 before. </p>
</div>
<div style="float:left;width:490px;margin:40px 0 0 20px;">
<div id="slider" style="border:2px solid #069;">
			<ul>				
				<li><img src="../mat/01.jpg" alt="Test prep session, live streamed"/></li>
				<li><img src="../mat/02.jpg" alt="Videos explaining every test 1 topic" /></li>
				<li><img src="../mat/03.jpg" alt="2 hours of private online tutoring" /></li>	
			</ul>
		</div>
        </div>

<div style="clear:both"></div>
<div style="margin-top:20px;color:#069;font-size:12px;">*free for first 300 students to apply</div>
  <!-- Begin MailChimp Signup Form -->
<link href="http://cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff;clear:left;font:14px Helvetica,Arial,sans-serif;}
	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup" style="width:620px;margin-top:10px;padding:10px 0 10px 180px;border-top:2px solid #069;border-bottom:2px solid #069;background:#E8FAFF">
<form action="http://rayku.us2.list-manage.com/subscribe/post?u=eecba72f64b760137fde73e0c&amp;id=f161fddb57" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
	<label for="mce-EMAIL" style="color:#003853">Send my prep package to this email address:</label>
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
<h3><strong>So, why are we doing this?</strong></h3>
<p><a href="http://www.youtube.com/watch?v=eHN78jqeEb8" target="_blank">Rayku is</a> a new startup by UofT students - a  p2p tutoring website for help on the fly. We're the new kids on the block! Even though we are still in <em>private beta</em>, we wanted to announce ourselves to the world. </p>
<p>What better way to do so than to straight up give high-quality stuff away for free? So, we've partnered with our friends at <a href="http://www.prepanywhere.com" target="_blank">PrepAnywhere</a> to get you prepared for your first term test, free, with no strings attached. Enjoy!</p>

  <!-- Begin MailChimp Signup Form -->
<link href="http://cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff;clear:left;font:14px Helvetica,Arial,sans-serif;}
	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup" style="width:800px;margin-top:40px;padding:10px 0;border-top:2px solid #069;border-bottom:2px solid #069;background:#E8FAFF">
<form action="http://rayku.us2.list-manage.com/subscribe/post?u=eecba72f64b760137fde73e0c&amp;id=f161fddb57" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
	<label for="mce-EMAIL" style="color:#003853">Send my prep package to this email address:</label>
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
