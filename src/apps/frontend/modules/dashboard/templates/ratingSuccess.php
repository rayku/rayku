<link rel="stylesheet" type="text/css" href="/css/global.css" />
<link href="/css/validation/validationEngine.jquery.css" rel="stylesheet" media="screen" type="text/css" />
<script src="/js/validation/jquery-1.6.min.js" type="text/javascript"> </script>
<script src="/js/validation/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="/js/validation/jquery.validationEngine.js"></script>
<script>
var frmVal = jQuery.noConflict();
frmVal(document).ready(function(){
    // binds form submission and fields to the validation engine
    frmVal("#rating-form").validationEngine();
});
</script>
<style>
.option {
    font-size:14px;
    color:#666;
    line-height:28px;
}
</style>

<div id="first" style="display:block">
  <div style="width:750px;margin:40px auto 0 auto;">
    <p style="font-size:18px; color: rgb(28, 81, 124); font-weight: bold; margin-top:25px;">Rate Tutor Session</p>
    <p style="font-size:14px; color:#333;margin-top:10px;line-height:20px;">Please give an honest rating for the session that you most recently finished.</p>
  </div>
  <br>
  <br>
<?php
$connection = RaykuCommon::getDatabaseConnection();
if(!empty($_COOKIE['raykuCharge'])) {
    $rate = $_COOKIE['raykuCharge'];
} else {
    $user = UserPeer::retrieveByPK($_COOKIE["ratingExpertId"]);
    if ($user) {
        $rate = $user->getRate();
    } else {
        $rate = 0;
    }
}
$timer = explode(":", $_COOKIE["timer"]);
$newTimer = (($timer[0]*3600)+($timer[1]*60)) / 60;
$raykuPercentage = $newTimer * $rate;
?>
<form action="" id="rating-form" method="post">
    <table width="750" align="center">
      <tr>
        <td colspan="3">&nbsp;</td>
        <td width="400" rowspan="7" class="option"><table width="400" align="center">
          <tr>
            <td width="253"><font  class="option">Describe the Experience (optional):</font>
              <p>
                <textarea class="comment-content" style="width:365px;padding:5px;font-size:14px;font-weight:normal" id="txtbox" rows="5" cols="45" name="content"></textarea>
              </p>
            </td>
            </tr>
             <tr>
            <!--
            <td width="253" style="padding:20px 0"><font  class="option">Tip Tutor (optional):</font>
              <p>
                <font style="font-size: 14px; color:#333; margin-left: 3px;"> Amount:</font>&nbsp;
                <input name="tiptutor" type="textbox" id="tiptutor" maxlength="3" style=" width:40px;" width="30"  class="validate[custom[integer],min[1],max[<?php echo $raykuPercentage;?>]]"  />
              </p></td>
            -->
            </tr>
          <tr>
            <td><label><input name="chkIsPublic" type="checkbox" id="chkIsPublic" checked />
              <font style="font-size: 14px; color:#333; margin-left: 3px;">Allow session to be public</font></label><br />
              <label>
                <input type="checkbox" id="checkbox" name="checkbox" />
                <font style="font-size: 14px; color:#333; margin-left: 3px;">Follow this tutor</font></label>
              <br />
              <input type="submit" name="submit" id="submit" style="padding: 6px; font-size: 14px; margin: 15px 0; font-weight: bold;" value="Submit Rating" /></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td width="35"><input type="radio" name="rating" value="5" /></td>
        <td class="option">No Problems!</td>
        <td width="180" class="option"><span class="option1"><img src="../images/star.png" width="25" height="25" ><img src="../images/star.png" width="25" height="25" ></span><span class="option1"><img src="../images/star.png" width="25" height="25" ></span><span class="option1"><img src="../images/star.png" width="25" height="25" ></span><span class="option1"><img src="../images/star.png" width="25" height="25" ></span></td>
      </tr>
      <tr>
        <td><input type="radio" name="rating"  value="4" /></td>
        <td class="option">Pretty Helpful</td>
        <td class="option"><span class="option1"><img src="../images/star.png" width="25" height="25" ></span><span class="option1"><img src="../images/star.png" width="25" height="25" ></span><span class="option1"><img src="../images/star.png" width="25" height="25" ></span><span class="option1"><img src="../images/star.png" width="25" height="25" ></span></td>
      </tr>
      <tr>
        <td><input type="radio" name="rating"  value="3" /></td>
        <td class="option">Somewhat Helpful</td>
        <td class="option"><span class="option1"><img src="../images/star.png" width="25" height="25" ></span><span class="option1"><img src="../images/star.png" width="25" height="25" ></span><span class="option1"><img src="../images/star.png" width="25" height="25" ></span></td>
      </tr>
      <tr>
        <td><input type="radio" name="rating" value="2"  /></td>
        <td class="option">Not very helpful</td>
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
