<html>
<head>
<meta charset="UTF-8">
<title>Rayku.com - Rate your Expert</title>
<head>
<link rel="stylesheet" type="text/css" href="http://www.rayku.com/css/global.css" />

<style>
.option {
	font-size:18px;
	font-weight:bold;
	color:#666;
	line-height:28px;
}
</style>
</head>

<body>
<div id="first" style="display:block">
  <div style="width:750px;margin:40px auto 0 auto;">
    <p style="font-size:18px; color: rgb(28, 81, 124); font-weight: bold; margin-top:25px;">Rate Tutoring Session</p>
    <p style="font-size:14px; color:#333;margin-top:10px;line-height:20px;">Please rate this tutoring session. Your tutor will be compensated in RP depending on your rating.</p>
  </div>
  <br>
  <br>
  <form action="" method="post">
    <table width="750" align="center">
      <tr>
        <td colspan="3">&nbsp;</td>
        <td width="400" rowspan="7" class="option"><table width="400" align="center">
          <tr>
            <td width="253"><font  class="option">Describe the Experience (optional):</font>
              <p>
                <textarea class="comment-content" style="width:365px;padding:5px;font-size:14px;font-weight:normal" id="txtbox" rows="5" cols="45" name="content"></textarea>
              </p></td>
            </tr>
          <tr>
            <td><input name="chkIsPublic" type="checkbox" id="chkIsPublic" checked />
              <font style="font-size: 14px; color:#333; margin-left: 3px;">Allow session to be public</font><br />
              <label>
                <input type="checkbox" id="checkbox" name="checkbox" />
                <font style="font-size: 14px; color:#333; margin-left: 3px;">Follow this Expert</font></label>
              <br />
              <input type="submit" name="submit" id="submit" style="padding: 6px; font-size: 14px; margin: 15px 0; font-weight: bold;" value="Submit Rating" /></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td width="35"><input type="radio" name="rating" value="5" /></td>
        <td class="option">Excellent</td>
        <td width="180" class="option"><span class="option1"><img src="../images/star.png" width="25" height="25" ><img src="../images/star.png" width="25" height="25" ></span><span class="option1"><img src="../images/star.png" width="25" height="25" ></span><span class="option1"><img src="../images/star.png" width="25" height="25" ></span><span class="option1"><img src="../images/star.png" width="25" height="25" ></span></td>
      </tr>
      <tr>
        <td><input type="radio" name="rating"  value="4" /></td>
        <td class="option">Very good</td>
        <td class="option"><span class="option1"><img src="../images/star.png" width="25" height="25" ></span><span class="option1"><img src="../images/star.png" width="25" height="25" ></span><span class="option1"><img src="../images/star.png" width="25" height="25" ></span><span class="option1"><img src="../images/star.png" width="25" height="25" ></span></td>
      </tr>
      <tr>
        <td><input type="radio" name="rating"  value="3" /></td>
        <td class="option">Average</td>
        <td class="option"><span class="option1"><img src="../images/star.png" width="25" height="25" ></span><span class="option1"><img src="../images/star.png" width="25" height="25" ></span><span class="option1"><img src="../images/star.png" width="25" height="25" ></span></td>
      </tr>
      <tr>
        <td><input type="radio" name="rating" value="2"  /></td>
        <td class="option">Not good</td>
        <td class="option"><span class="option1"><img src="../images/star.png" width="25" height="25" ></span><span class="option1"><img src="../images/star.png" width="25" height="25" ></span></td>
      </tr>
      <tr>
        <td><input type="radio" name="rating" value="1"  /></td>
        <td class="option">Awful</td>
        <td class="option"><span class="option1"><img src="../images/star.png" width="25" height="25" ></span></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
    </table>
  </form>
</div>
</body>
</html>
