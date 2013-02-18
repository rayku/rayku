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
       <li><a href="/register">Register</a></li>
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
                <p>Are you an enthusiastic student in the Downtown Toronto area with a passion for changing education? We're looking for you!
                <p>Rayku employees are generally amazing. They love what they do, and their work is second to none. We strive to provide our people with the opportunities to learn at a fast pace, impact the company in a big way, and develop great products - all while having an amazing time each and every day.</p>
                <p>Our offices are located in the heart of downtown Toronto - right outside Dundas Square. We champion a fun and open work culture that focuses on results, and encourages curious exploration. Join us.</p>
        </div>
            </div> <!-- content -->
            
            <div class="clear"></div>
            
            
            <div id="idcontainer" style="display:none"></div>
          <div class="plus-sign"><a href="#"><img src="/images/plus-sign.png" alt="" /></a></div> <!-- plus-sign -->
            <div class="content">
              <h1><a href="#">Business Development Interns (paid)</a></h1>
              <div id="content1">
                <p>Rayku is looking for a challenge-seeking business development intern that is searching for an opportunity to play a big role within a fast-moving organization, and shares a passion for bringing accessible education to the world. </p>
                <p>The ideal candidate is assertive, results-focused, and always understands the big problems that we are trying to solve, with the mindset that no strategy is too out-of-the-box to try. </p>
                <p>You will be expected to identify the biggest opportunities for growth on an International scale, close deals with strategic partners, run marketing campaigns, and optimize existing initiatives to maximize scalability within the company. </p>
                <p><strong>Requirements:</strong></p>
                <ul>
                  <li>- Available to work on a part-time basis</li>
                  <li>- Passion for solving the world's biggest problem: Education</li>
                  <li>- Results-oriented</li>
                  <li>- Elite research and analytical skills</li>
                  <li>- Attention-to-detail</li>
                  <li>- Strong communication and interpersonal skills</li>
                  <li>- Ability to work individually and in a group environment</li>
                </ul>
                <p><strong>Responsibilities:</strong></p>
                <ul>
                  <li>- Identify external opportunities to engage and/or grow Rayku's user base</li>
                  <li>- Build, negotiate, and close deals with strategic partners</li>
                  <li>- Recommend R&D priorities based on market feedback</li>
                  <li>- Execute on day-to-day tasks to help Rayku stay afloat</li>
                </ul>

              </div>
                <div class="content-links"><a href="mailto:jobs@rayku.com" style="color:#069">Apply Now</a></div>
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
                <p>Full billing system to deliver payments directly to your paypal or bank account.</p>
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
    <div style="width:300px;float:left;">Copyright 2012 Rayku Corp. All rights reserved.</div>
    <div style="width:500px;float:right;" align="right">Get in touch! 1-888-98RAYKU // <a href="mailto:cs[at]mail.rayku.com">email us</a> // <a href="http://rayku.com/tos.html" target="_blank" title="[Opens in pop-up window]">legal</a></div>
  </div>
  <!--container-->

</div>
<!--footer-->   
</div> <!-- outer-container -->
</body>
</html>
