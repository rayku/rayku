<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="/css/tutorjoin.css" />
<link rel="stylesheet" type="text/css" href="/css/custom/button.css"/>
</head>

<body>

<?php setcookie('wherefind','', null, '/', sfConfig::get('app_cookies_domain')); ?>

<div class="body-main" style="width:600px">
  <div id="want" style="height:240px">
    <h3>Tutor Math Online, Get Paid!</h3>
    <p>Rayku lets you teach math students online. Start today, and charge by-the-minute rates of your choice (recommended $0.40/min. or $24/hour).<br />
      <br />
      Sessions are carried out through a live shared whiteboard, where students can interact with video, audio, and math equation writer tools. With passive notifications, you can log in and tutor at your own self-determined schedule.<br />
      <br />
      Although you are allowed to set your own rates, our system automatically caps the highest you can charge depending on your past ratings on the site. Your first few sessions will be capped at $0/minute to build experience.
    </p>
  </div>
  <!--want-->
  
  <div id="table"> 
    <!-- Table goes in the document BODY -->
    <a name="benefits" id="benefits"></a>
    <table width="560" align="left" class="hovertable">
      <tr>
        <th colspan="2" align="left" style="border-left:1px solid #1C517B;"><span style="font-size:16px;color:#F9F9F9;padding:5px 0 20px 0;"><strong>Benefits</strong></span></th>
      </tr>
      <tr onmouseover="this.style.backgroundColor='#E2EDF3';" onmouseout="this.style.backgroundColor='#EEF7FB';">
        <td width="350">Teach online via a live shared whiteboard</td>
        <td><strong>Yes</strong> (<a href="<?php echo sfConfig::get('app_whiteboard_url') ?>/standalone" target="_blank">demo</a>)</td>
      </tr>
      <tr onmouseover="this.style.backgroundColor='#E2EDF3';" onmouseout="this.style.backgroundColor='#EEF7FB';">
        <td>Instant chat / desktop tutoring request notifications</td>
        <td><strong>Yes</strong></td>
      </tr>
      <tr onmouseover="this.style.backgroundColor='#E2EDF3';" onmouseout="this.style.backgroundColor='#EEF7FB';">
        <td>100% flexible schedules (log on to tutor whenever)</td>
        <td><strong>Yes</strong></td>
      </tr>
      <tr onmouseover="this.style.backgroundColor='#E2EDF3';" onmouseout="this.style.backgroundColor='#EEF7FB';">
        <td>Set your own rates</td>
        <td><strong>Yes</strong></td>
      </tr>
      <tr onmouseover="this.style.backgroundColor='#E2EDF3';" onmouseout="this.style.backgroundColor='#EEF7FB';">
        <td>Full billing system with on-demand payments</td>
        <td><strong>Yes</strong></td>
      </tr>
      <tr onmouseover="this.style.backgroundColor='#E2EDF3';" onmouseout="this.style.backgroundColor='#EEF7FB';">
        <td>15 minute walkthrough video to get started immediately</td>
        <td><strong>Yes</strong></td>
      </tr>
      <tr onmouseover="this.style.backgroundColor='#E2EDF3';" onmouseout="this.style.backgroundColor='#EEF7FB';">
        <td>We pay for advertising to get you clients</td>
        <td><strong>Yes</strong></td>
      </tr>
      <tr onmouseover="this.style.backgroundColor='#E2EDF3';" onmouseout="this.style.backgroundColor='#EEF7FB';">
        <td>Amount you are paid per session</td>
        <td><strong>75%<sup>1</sup> (avg. $18/hr)</strong></td>
      </tr>
      <tr onmouseover="this.style.backgroundColor='#E2EDF3';" onmouseout="this.style.backgroundColor='#EEF7FB';">
        <td>Price</td>
        <td>Free</td>
      </tr>
    </table>
  </div>
  <div style="clear:both"></div>
  <div id="bottom">
  	<!--<div id="notice">Are you a full-time tutor with 10+ students? <a href="/privatetutors">Click Here</a></div>-->
    <p class="content">Tutor when you want, wherever you want. Your salary and work hours are yours to decide. <a href="<?php echo sfConfig::get('app_rayku_url') ?>/regtutor">Register today</a>, it's free!</p>
    <p class="footnote"><br /><br /><br /><br />
      <sup>1</sup>Dependent on the quality of the tutoring session. The higher the quality, the more you earn.</p>
  </div>
</div>
<div id="sidebar" style="height:auto">
  <h1 class="fb">Get Started</h1>
  <div style="padding:15px;font-size:14px;color:#666;line-height:20px">
    <p>Start tutoring on Rayku in 5 minutes.
      <input type="button" value="Register as a Tutor" class="myButton" style="font-size:14px;margin-top:15px;" onClick="parent.location='<?php echo sfConfig::get('app_rayku_url') ?>/regtutor'">
    </p>
    <img src="<?php echo sfConfig::get('app_rayku_url') ?>/images/tutor-how-it-works.jpg" style="padding-top:20px;" /><br />
    <input type="button" value="Register Now" class="myButton" style="font-size:14px;margin-top:15px;" onClick="parent.location='<?php echo sfConfig::get('app_rayku_url') ?>/regtutor'">
  </div>
</div>
<div class="clear-both"></div>
</body>
