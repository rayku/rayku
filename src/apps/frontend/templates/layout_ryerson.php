<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/start.css"/>
<link rel="stylesheet" media="screen" type="text/css" href="/css/about-jobs.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/navigation.css"/>

</head>
<script type="text/javascript">
  function showcontent(contentid)
  {
    //alert(contentid);
    if(this.document.getElementById('idcontainer').innerHTML == '')
    {
    this.document.getElementById(contentid).style.height='auto';
    this.document.getElementById('idcontainer').innerHTML=contentid;
    }   
    
    else if(this.document.getElementById('idcontainer').innerHTML != contentid)
    {
      var idcontainervalue = this.document.getElementById('idcontainer').innerHTML;
      this.document.getElementById(idcontainervalue).style.height = '75px';
      this.document.getElementById(contentid).style.height='auto';
      this.document.getElementById('idcontainer').innerHTML=contentid;
    }
    
    
    
  }

</script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/add-event.js"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/popup.js"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/jquerynav.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/jquery.notifier.js"></script>
<body>
<div id="outer-container">
  <div class="navigation-top">
   <div class="container clearfix">
     <h1><a href="/"><img src="<?php echo $baseRootPath; ?>/images/landing/topnav/rayku.jpg" alt="Rayku"/></a></h1>
     <!--navigation-->
     <ul id="navigation">
       <li><a href="/login">Login</a></li>
       <li><strong><a href="/register">Register</a></strong></li>
       <li><a href="/about">About</a></li>
       <li><a href="/jobs">Jobs</a></li>
       <li><a href="/joinus">Become a Tutor</a></li>
       <!--<li><a href="/tourpage">Tour</a></li>-->
     </ul>
     <!--navigation-->
     <div class="clear"></div>
    </div>
  </div>

    <!-- top-nav -->
    <div id="about-header" style="background-image:url(/images/header-ryerson.png);">
      <div class="btn-applynow"><img src="/images/btn-ryerson.png" alt="" /></div>
    </div> <!-- header -->
    <div class="header-bg"></div><!-- header-bg -->
    <div id="content">
      <div class="content-left">
        
          <div id="idcontainer" style="display:none"></div>
      <div class="content">
              <h1><a name="apply" id="apply"></a>Join Us!</h1>
              <div id="content0">
                <p>Tutor high school students math, online, whenever you're free, and earn money! As seen on the Toronto Star, BNN, and the Globe and Mail, Rayku is the first market driven online tutoring platform, making it simple for students to get on-demand help anytime, anywhere.</p>
                <p>We're looking to recruit smart and energetic Ryerson students as online math tutors.</p>
        </div>
            </div> <!-- content -->
            
            <div class="clear"></div>
            
            
            <div id="idcontainer" style="display:none"></div>
          <div class="plus-sign"><a href="#"><img src="/images/plus-sign.png" alt="" /></a></div> <!-- plus-sign -->
            <div class="content">
              <h1><a href="#">Ryerson Math Tutors</a></h1>
              <div id="content1">
                <p>Rayku lets you teach math students online. Start today, and charge by-the-minute rates of your choice (recommended $0.40/min. or $24/hour).</p>
                <p>Sessions are carried out through a live shared whiteboard, where students can interact with video, audio, and math equation writer tools. With passive notifications, you can log in and tutor at your own self-determined schedule.</p>
                <p>Although you are allowed to set your own rates, our system automatically caps the highest you can charge depending on your past ratings on the site. Your first few sessions will be capped at $0/minute to build experience.</p>
                <p>Tutor when you want, wherever you want. Your salary and work hours are yours to decide. Register today and get started immediately, it's free!</p>
              </div>
                <div class="content-links"><a href="http://rayku.com/regtutor" style="color:#069">Apply Now</a></div>
            </div> <!-- content -->
            
            <div class="clear"></div>
            
        
        </div> <!-- content-left -->
        <div class="content-right">
            <div class="content">
                <h2><img src="/images/r4.png" align="absmiddle" />Whiteboard</h2>
                <p>Teach online via a live shared whiteboard <a href="http://whiteboard.rayku.com/standalone" target="_blank">(demo)</a>.</p>
          </div> <!-- class="content" -->

          <div class="content">
                <h2><img src="/images/r4.png" align="absmiddle" />Passive Notifications</h2>
                <p>Instant facebook chat / google talk tutoring request notifications.</p>
          </div> <!-- class="content" -->

          <div class="content">
                <h2><img src="/images/r4.png" align="absmiddle" />Flexible Schedules</h2>
                <p>100% flexible schedules - log on to tutor whenever you're free!</p>
          </div> <!-- class="content" -->

          <div class="content">
                <h2><img src="/images/r4.png" align="absmiddle" />Set Prices</h2>
                <p>Set your own tutoring rates.</p>
          </div> <!-- class="content" -->

          <div class="content">
                <h2><img src="/images/r4.png" align="absmiddle" />75% Commission</h2>
                <p>Get paid an average of 75% per session (average $18/hour) after fees.</p>
          </div> <!-- class="content" -->

          <div class="content">
                <h2><img src="/images/r4.png" align="absmiddle" />Get Paid</h2>
                <p>Full billing system with on-demand payments.</p>
          </div> <!-- class="content" -->

          <div class="content">
                <h2><img src="/images/r4.png" align="absmiddle" />Clients</h2>
                <p>We pay for advertising to get you clients - that's our job.</p>
          </div> <!-- class="content" -->

          <div class="content">
                <h2><img src="/images/r4.png" align="absmiddle" />Start Today</h2>
                <p>15 minute walkthrough video to get started immediately.</p>
          </div> <!-- class="content" -->   

          <div class="hr"></div>
          <div class="question">It's free! <a href="http://rayku.com/regtutor">Get Started Now</a></div> <!-- question -->
        </div> <!-- content-right -->
        <div class="clear"></div>
    
    
    
    
    </div> <!-- content -->

<div class="footer">

  <!--container-->
  <div class="container">
    <div style="width:300px;float:left;">Copyright 2012 Rayku, Inc. All rights reserved.</div>
    <div style="width:500px;float:right;" align="right">Get in touch! 1-888-98RAYKU // <a href="mailto:cs[at]mail.rayku.com">email us</a> // <a href="http://rayku.com/tos.html" target="_blank" title="[Opens in pop-up window]">legal</a></div>
  </div>
  <!--container-->

</div>
<!--footer-->   
</div> <!-- outer-container -->
</body>
</html>
