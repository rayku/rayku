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
    <div id="header">
      <div class="btn-applynow"><a href="#apply"><img src="/images/btn-applynow.png" alt="" /></a></div>
    </div> <!-- header -->
    <div class="header-bg"></div><!-- header-bg -->
    <div id="content">
      <div class="content-left">
        
          <div id="idcontainer" style="display:none"></div>
      <div class="content">
              <h1><a name="apply" id="apply"></a>About Rayku</h1>
              <div id="content0">
                <p>Rayku employees are generally amazing. They love what they do, and their work is second to none. We strive to provide our people with the opportunities to learn at a fast pace, impact the company in a big way, and develop great products - all while having an amazing time each and every day.</p>
                <p>Our offices are located in the heart of downtown Toronto - right outside Dundas Square. We champion a fun and open work culture that focuses on results, and encourages curious exploration. Join us.</p>
        </div>
            </div> <!-- content -->
            
            <div class="clear"></div>
            
            
            <div id="idcontainer" style="display:none"></div>
          <div class="plus-sign"><a href="javascript:showcontent('content1')"><img src="/images/plus-sign.png" alt="" /></a></div> <!-- plus-sign -->
            <div class="content">
              <h1><a href="javascript:showcontent('content1')">Business Development Manager</a></h1>
              <div id="content1" style="height:75px; overflow:hidden; flag:0">
                <p>Rayku is looking for a challenge-seeking business development manger that is searching for an opportunity to play a big role within a fast-moving organization, and shares a passion for bringing accessible education to the world. </p>
                <p>The ideal candidate is assertive, results-focused, and always understands the big problems that we are trying to solve, with the mindset that no strategy is too out-of-the-box to try. </p>
                <p>You will be expected to identify the biggest opportunities for growth on an International scale, close deals with strategic partners, run marketing campaigns, and optimize existing initiatives to maximize scalability within the company.           </p>
                <p><strong>Requirements:</strong></p>
                <ul>
                  <li>- Passion for solving the world’s biggest problem: Education</li>
                  <li>- Results-oriented</li>
                  <li>- Elite research and analytical skills</li>
                  <li>- Attention-to-detail</li>
                  <li>- Strong communication and interpersonal skills</li>
                  <li>- Ability to work individually and in a group environment</li>
                </ul>

                <p><strong>Responsibilities:</strong></p>
                <ul>
                  <li>- Identify external opportunities to engage and/or grow Rayku’s user base</li>
                  <li>- Build, negotiate, and close deals with strategic partners</li>
                </ul>
              </div>
                <div class="content-links"><a href="#">Toronto, Ontario</a>&bull;<a href="#">Full Time</a>&bull;<a href="#">Experience Required</a>&bull;<a href="mailto:jobs@rayku.com" style="color:#069">Apply Now</a></div>
            </div> <!-- content -->
            
            <div class="clear"></div>
            
            
            <div class="plus-sign"><a href="javascript:showcontent('content2')"><img src="/images/plus-sign.png" alt="" /></a></div> <!-- plus-sign -->
            <div class="content">
              <h1><a href="javascript:showcontent('content2')">Senior Software Engineer (PHP)</a></h1>
            
           <div id="content2" style="height:40px; overflow:hidden">
                <p>Job description coming soon.</p>
            </div>
            <div class="content-links"><a href="#">Toronto, Ontario</a>&bull;<a href="#">Full Time</a>&bull;<a href="#">Experience Required</a>&bull;<a href="mailto:jobs@rayku.com" style="color:#069">Apply Now</a></div>
            </div> <!-- content -->
            
            <div class="clear"></div>
            
            
           <div class="plus-sign"><a href="javascript:showcontent('content3')"><img src="/images/plus-sign.png" alt="" /></a></div> <!-- plus-sign --> 
            <div class="content">
              <h1><a href="javascript:showcontent('content3')">Software Engineer (NodeJS / HTML5)</a></h1>
            
           <div id="content3" style="height:40px; overflow:hidden">
                <p>Job description coming soon.</p>
              </div>
            <div class="content-links"><a href="#">Anywhere</a>&bull;<a href="#">Part Time</a>&bull;<a href="#">Experience Required</a>&bull;<a href="mailto:jobs@rayku.com" style="color:#069">Apply Now</a></div>
            </div> <!-- content -->
            
            <div class="clear"></div>
          
        
        </div> <!-- content-left -->
        <div class="content-right">
          <div class="content">
                <h2><img src="/images/r1.png" align="absmiddle" />Flexible Hours</h2>
                <p>Going to work shouldn't mean that you'll be locked up from 9 to 5.</p>
          </div> <!-- class="content" -->
            
          <div class="content">
                <h2><img src="/images/r2.png" align="absmiddle" />Stock Options</h2>
                <p>Our people are family. High-potential employees can earn shares in Rayku.</p>
            </div> <!-- class="content" -->
            
            <div class="content">
                <h2><img src="/images/r3.png" align="absmiddle" />Downtown Office</h2>
                <p>Conveniently located at the heart of downtown Toronto, right outside of Dundas Square.</p>
            </div> <!-- class="content" -->
            
            <div class="content">
                <h2><img src="/images/r4.png" align="absmiddle" />Perks</h2>
                <p>Free coffee, branded apparel, tickets to cool events, and more!</p>
          </div> <!-- class="content" -->
        
          <div class="hr"></div>
          <div class="question">Questions? <a href="mailto:jobs@rayku.com">jobs@rayku.com</a></div> <!-- question -->
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
