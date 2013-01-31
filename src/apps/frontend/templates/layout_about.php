<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/start.css"/>
<link rel="stylesheet" media="screen" type="text/css" href="/css/about-jobs.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $baseRootPath; ?>/css/navigation.css"/>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/add-event.js"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/popup.js"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/jquerynav.js"></script>
<script type="text/javascript" src="<?php echo $baseRootPath; ?>/js/jquery.notifier.js"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=3&amp;key=AIzaSyBOReKIo4WmHb31oExpafuJyZmE_rIMu1c" type="text/javascript"></script>
<script type="text/javascript" src="/js/maps.js"></script>
<?php templateGoogleAnalytics(); ?>
</head>



<body onload="initialize()" onunload="GUnload()">

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
    <div id="about-header">
    	<div class="about-headercontent">
    	<p>Whether you need help at 1am before a big test, or you're looking to touch up some math skills that you learned 2 years ago, we're here to help! Rayku is bringing accessible education to the world, backed by an awesome team motivated by your success.</p>
        </div>
    	<div class="btn-applynow"><img src="/images/btn-aboutpage.png" alt="" /></div>
    </div> <!-- header -->
    <div class="header-bg">
        <ul id="about-nav">
            <li id="timeline"><a href="#about-nav">Timeline</a></li>
            <li><a href="#applybox">Key People</a></li>
            <li><a href="#map_canvas">Map</a></li>
            <li><a href="mailto:cs@mail.rayku.com">Contact Us</a></li>
        </ul>
    </div><!-- header-bg -->    
    <div id="aboutcontainer">
    <div id="aboutcontent">
    	<div class="aboutcontent-left">
        	<div class="icon-bulb"><img src="/images/icon-bulb.png" alt="" /></div>
        	<div class="left-arrowboxcontainer">
                    <div class="left-arrowbox">
                        <div class="leftarrow"></div>
                        <img src="/images/img1.jpg" alt="" />  
                    
                    </div> <!-- left-arrowbox --> 
                    <div class="left-arrowboxcontent">              
                    <h3 class="gray">Rayku graduates from Launchpad Ignition</h3>
                    <span class="date">May 2011</span>
            		</div> <!-- left-arrowboxcontent -->
            
            </div> <!-- left-arrowboxcontainer -->
            <div class="icon-bullet2"><img src="/images/bullet1.png" alt="" /></div>
            <div class="left-arrowboxcontainer">
                    <div class="left-arrowbox">
                        <div class="leftarrow"></div>
                        <img src="/images/img2.jpg" alt="" />  
                    
                    </div> <!-- left-arrowbox --> 
                    <div class="left-arrowboxcontent">                
                    <h3 class="gray">Beta version is launched to North America</h3>
                    <span class="date">April 2012</span>
            
            		</div><!-- left-arrowboxcontent -->
            
            </div> <!-- left-arrowboxcontainer -->
        
        	
        	
        
        </div> <!-- aboutcontent-left -->
        <div class="aboutcontent-right">
        	<br /><br /><br /><br />
            <div class="icon-bullet1"><img src="/images/bullet1.png" alt="" /></div>
        	<div class="right-arrowboxcontainer">
                    <div class="right-arrowbox">
                        <div class="rightarrow"></div>
                        <img src="/images/img3.jpg" alt="" />  
                    
                    </div> <!-- right-arrowbox --> 
                      <div class="right-arrowboxcontent">              
                    <h3 class="gray">Rayku impresses on BNN's “The Pitch”</h3>
                    <span class="date">December 2011</span>
                    </div> <!-- right-arrowboxcontent -->
            
            
            </div> <!-- right-arrowboxcontainer -->
             <div class="icon-bullet3"><img src="/images/bullet1.png" alt="" /></div>
            <div class="right-arrowboxcontainer">
                    <div class="right-arrowbox">
                        <div class="rightarrow"></div>
                        <div class="commentbox-img"><img src="/images/rksmall.png" alt="" /></div> <!-- commentbox-img -->
                        <div class="commentbox-comment"><strong>Rayku</strong> @rayuedu<br />
                      Super excited to announce that we've finally finished our raise! Ok now back to work. <a href="#"><br />
                      Details</a></div> <!-- commentbox-comment -->
                        <div class="clear"></div>
                    
                    </div> <!-- right-arrowbox -->
                    <div class="right-arrowboxcontent">                
                    <h3 class="gray">Funding!</h3>
                    <span class="date">November 2012</span>
                    </div><!-- right-arrowboxcontent -->
            
            
            </div> <!-- right-arrowboxcontainer -->
            <div class="icon-flag"><img src="/images/icon-flag.png" alt="" /></div>
            <div class="right-arrowboxcontainer">
                    <div class="right-arrowbox">
                        <div class="rightarrow"></div>
                        <img src="/images/img4.jpg" alt="" />  
                    
                    </div> <!-- right-arrowbox -->
                    <div class="right-arrowboxcontent">                
                    <h3 class="gray">Rayku helps new users each day</h3>
                    <span class="date">Today</span>
                    </div><!-- right-arrowboxcontent -->
            
            
            </div> <!-- right-arrowboxcontainer -->
        </div> <!-- aboutcontent-right -->
        <div class="clear"></div>
    
    
    
    
    </div> <!-- aboutcontent -->
    </div> <!-- aboutcontainer -->
    <div id="applybox">
    	<div class="applybox-content">
        	<div class="btn-applyhere"><a href=""><img src="/images/btn-applyhere.png" alt="" /></a></div> <!-- btn-applyhere -->
            <div class="board-of-advisor-left">

                <div id="current"></div> <!-- current -->

                <div id="previous"></div> <!-- previous -->                   
            
            	<div id="profile-ouyang" class="board-of-advisor-profile">
                	<div class="board-of-advisor-profile-img"><img src="/images/prf1.png"  alt="" /></div>
                    <div class="board-of-advisor-profile-content">
                    	<h1>Donny Ouyang, President</h1>
                        <p>Donny founded Rayku to address his own struggles with math, having tried alternative solutions with no success. Before Rayku, Donny was the founder of Kinkarso Tech, an award-winning Internet consulting company. With entrepreneurship as his life, Donny has spoken at M.I.T. on the subject, was named a 'Top 10 Under 20' by Vancouver Magazine, and is the global recipient of the 2010 Student Entrepreneur of the Year award. Donny is currently a part time student at the University of Toronto.</p>
                        <a href="https://twitter.com/donnyouyang" target="_blank"><img src="/images/btn-follow.jpg" alt="Follow @donnyouyang" /></a>
                    
                    </div> <!-- board-of-advisor-profile-content -->
                
                	<div class="clear"></div>
                
                </div> 


                <div id="profile-solomon" class="board-of-advisor-profile">
                    <div class="board-of-advisor-profile-img"><img src="/images/prf3.png"  alt="" /></div>
                    <div class="board-of-advisor-profile-content">
                        <h1>Aron Solomon, Advisor</h1>
                        <p>Aron is a global strategist, entrepreneur, and advisor, having done everything one can do in education - from teaching and coaching sports to fundraising, student recruitment, setting institutional strategy, and actually running schools. He was previously Chief Operating Officer of an early global e.learning initiative, and CEO of THINK Global School. Aron studied at the University of Toronto, Stanford, McGill, and Kellogg Graduate School of Management, where he was taught leadership under Dr. Deepak Chopra.</p>
                        <a href="https://twitter.com/aronsolomon" target="_blank"><img src="/images/btn-follow.jpg" alt="Follow @aronsolomon" /></a>                        

                    
                    </div> <!-- board-of-advisor-profile-content -->
                
                    <div class="clear"></div>
                
                </div> <!-- board-of-advisor-profile-->

                <!-- board-of-advisor-profile-->
                
                <div id="profile-voutsinas" class="board-of-advisor-profile">
                    <div class="board-of-advisor-profile-img"><img src="/images/prf2.png"  alt="" /></div>
                    <div class="board-of-advisor-profile-content">
                        <h1>Christopher Voutsinas, Advisor</h1>
                        <p>Christopher is President at Capital Value & Income Corp. Christopher has held senior strategic roles at leading institutions, including Goldman Sachs (Executive Director), Deutsche Bank (Managing Director), and OMERS (Global Head of Investment). He has also advised numerous public and private companies, including TELUS and Wave Accounting. Christopher received an M.B.A. from the Wharton School of Business, an M.S. from M.I.T., and a Bachelor of Architecture from McGill University. </p>
                    
                    </div> <!-- board-of-advisor-profile-content -->
                
                    <div class="clear"></div>
                
                </div> <!-- board-of-advisor-profile-->

                <!-- board-of-advisor-profile-->
                
                <div id="profile-jackson" class="board-of-advisor-profile">
                    <div class="board-of-advisor-profile-img"><img src="/images/prf5.png"  alt="" /></div>
                    <div class="board-of-advisor-profile-content">
                        <h1>Paul Jackson, Advisor</h1>
                        <p>Paul is CEO and founder of <a href="http://methodcrm.com" target="_blank">Method CRM</a>, with a focus on product development, user experience and data integration between SaaS applications.  Previously, he founded LM Software and QXpress, which were acquired by Marathon Data Systems.  Paul is also an angel investor and advisor to several local tech start-ups. Paul holds a BComm from Queen’s University.</p>
                        <a href="https://twitter.com/PaulAlexJackson" target="_blank"><img src="/images/btn-follow.jpg" alt="Follow @PaulAlexJackson" /></a>  

                    </div> <!-- board-of-advisor-profile-content -->
                
                    <div class="clear"></div>
                
                </div> <!-- board-of-advisor-profile-->

                <!-- board-of-advisor-profile-->
                
                <div id="profile-simonett" class="board-of-advisor-profile">
                    <div class="board-of-advisor-profile-img"><img src="/images/prf6.png"  alt="" /></div>
                    <div class="board-of-advisor-profile-content">
                        <h1>Geoff Simonett, Advisor</h1>
                        <p>Geoff is the founder and President of GreenSky Capital in Toronto, a boutique corporate financial advisory firm and Exempt Market Dealer. Geoff is an accomplished entrepreneur with two decades of experience starting, operating and successfully exiting multiple companies acting as a principal, advisor, investor, board member, mentor and/or consultant. He has participated in the growth and success of many early stage companies both in Canada and the United States. Geoff received a Commerce degree from Queen's University.</p>
                    
                    </div> <!-- board-of-advisor-profile-content -->
                
                    <div class="clear"></div>
                
                </div> <!-- board-of-advisor-profile-->  

                <!-- board-of-advisor-profile-->
                
                <div id="profile-brooke" class="board-of-advisor-profile">
                    <div class="board-of-advisor-profile-img"><img src="/images/prf7.png"  alt="" /></div>
                    <div class="board-of-advisor-profile-content">
                        <h1>Justin Brooke, Advisor</h1>
                        <p>Justin Brooke is an author, international speaker, and blogger. Justin has a software business, e-learning business, and service business all centered around the topic of helping companies get more website traffic. His online marketing strategies are responsible for tens of millions of dollars in revenue. Justin pioneered SEO strategies that became standard in the industry. He has consulted for millionaires including Trump University and spoken on stages from California to London. </p>
                        <a href="https://twitter.com/justinbrooke" target="_blank"><img src="/images/btn-follow.jpg" alt="Follow @justinbrooke" /></a>  
                    
                    </div> <!-- board-of-advisor-profile-content -->
                
                    <div class="clear"></div>
                
                </div> <!-- board-of-advisor-profile-->
                
                <!-- board-of-advisor-profile-->
                
                <div id="profile-carrescia" class="board-of-advisor-profile">
                    <div class="board-of-advisor-profile-img"><img src="/images/prf4.png"  alt="" /></div>
                    <div class="board-of-advisor-profile-content">
                        <h1>Peter Carrescia, Advisor</h1>
                        <p>Peter is a seasoned technologist and investor. Previously, in his role as Managing Director at OMERS Ventures, Peter  invested in high-growth companies in the technology, media, and telecommunications sectors, including Wave Accounting and Extreme Startups. Peter previously held roles at VG Partners (General Partner), Microsoft Corp. (North America technology evangelist), and IBM (National Technology Manager). Peter received an M.B.A. from Schulich School of Business and a Joint Honours B.Math in Computer Science and Business Administration from the University of Waterloo.</p>
                        <a href="https://twitter.com/pcarrescia" target="_blank"><img src="/images/btn-follow.jpg" alt="Follow @pcarrescia" /></a>  
                    
                    </div> <!-- board-of-advisor-profile-content -->
                
                    <div class="clear"></div>
                
                </div> <!-- board-of-advisor-profile-->              
            
            
            </div> <!-- board-of-advisor-left -->
            <div class="board-of-advisor-right">
            	<h2>Board of Advisors</h2>  

                <div id="link-solomon" class="board-of-advisor-right-profile" style="margin-top:20px;">
                	<a href="#solomon"><img src="/images/prf3.png" width="75px" alt="" /><br />
               	  <strong>Aron Solomon</strong></a><br />
                    UNFINISHED              
                </div> <!-- board-of-advisor-right-profile -->

                <div id="link-voutsinas" class="board-of-advisor-right-profile" style="margin-top:20px;">
                    <a href="#voutsinas"><img src="/images/prf2.png" width="75px" alt="" /><br />
                    <strong style="font-size:12px;">Chris Voutsinas</strong></a><br />
                    Capital Value &#38; Income    
                </div> <!-- board-of-advisor-right-profile -->  
                
                <div id="link-jackson" class="board-of-advisor-right-profile">
                	<a href="#jackson"><img src="/images/prf5.png" width="75px" alt="" /><br />
                    <strong>Paul Jackson</strong></a><br />
                    Method Integration              
                </div> <!-- board-of-advisor-right-profile -->
                
                <div id="link-simonett" class="board-of-advisor-right-profile">
                	<a href="#simonett"><img src="/images/prf6.png" width="75px" alt="" /><br />
                    <strong>Geoff Simonett</strong></a><br />
                    GreenSky Capital          
                </div> <!-- board-of-advisor-right-profile -->
                
                <div id="link-brooke" class="board-of-advisor-right-profile" style="margin-bottom:20px;">
                    <a href="#brooke"><img src="/images/prf7.png" width="75px" alt="" /><br />
                  <strong>Justin Brooke</strong></a><br />
                    Strategic Profits             
                </div> <!-- board-of-advisor-right-profile -->

                <div id="link-carrescia" class="board-of-advisor-right-profile" style="margin-bottom:20px;">
                    <a href="#carrescia"><img src="/images/prf4.png" width="75px" alt="" /><br />
                  <strong>Peter Carrescia</strong></a><br />
                    Advisor             
                </div> <!-- board-of-advisor-right-profile -->
             
            
            </div> <!-- board-of-advisor-right -->
            <div class="clear"></div>
        
        
        </div> <!-- applybox-content -->
    
    </div> <!-- applybox -->

    <div id="map_canvas" class="googlemap"></div>


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
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/profiles.js?version=101"></script>
<script type="text/javascript" src="/js/about-nav.js"></script>
<script type="text/javascript" src="/js/landing/functions.js"></script>
<script type="text/javascript" src="/js/landing/jquery.easing.1.3.js"></script>
</body>
</html>
