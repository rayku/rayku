<script type="text/javascript">

	setTimeout('confirmation_display()', 100);

	function confirmation_display()
	{
		var cc = jQuery.noConflict();
		cc('#confirmation_connect').load('/quickreg/confirmpopup', '', function(response) 
		{
			cc("#confirmation_content").html(response);

		});
	}
</script>
<link rel="stylesheet" type="text/css" href="/css/global.css" />

<div id="body">
<div id="confirmation_connect"></div> 
<div id="tutorlist" style="padding-left:0px !important;">
  <div id="tutorlist_ajax">
    <div class="body" >
      <div id="cn-body">
        <div class="body-connect-left">
          <div class="cn-left-bg" style="margin-top: 25px;">
            <div class="cn-left-top"></div>
            <h3 style="margin-bottom:8px;">Subject:</h3>
            <label>
            <form name="form1" id="form1" method="post">
              <select name="course" onchange="this.form.submit();">
                <option value="">--- SELECT ---</option>
                <option value="1" selected="selected"> General Math </option>
                <option value="2"> Prealgebra </option>
                <option value="3"> Geometry </option>
                <option value="4"> Algebra </option>
                <option value="5"> Trigonometry </option>
                <option value="6"> Calculus </option>
                <option value="7"> Stat and Probability </option>
                <option value="8"> Advanced Math </option>
              </select>
            </form>
            </label>
            <div class="cn-spacer"></div>
            <h3>Filtering Options:</h3>
            <h4>Expert Status: <img src="../images/greyarrow-down.jpg" width="10" height="11" alt="" /></h4>
            <p><a href="" onClick="return setStatus(1)">Online</a></p>
            <p><a href="" onClick="return setStatus(2)">Offline</a></p>
            <h4>School: <img src="../images/greyarrow-down.jpg" width="10" height="11" alt="" /></h4>
            <select name="school" onchange="return setSchool(this.value)" style="background:none;padding:4px;height:auto;border:1px solid #CCC">
              <option value="">---- SELECT ----</option>
              <option value="utoronto"  >University of Toronto</option>
              <option value="ubc"  >University of British Columbia</option>
            </select>
            <br/>
            <br />
            <p><a href="" onClick="return reSet(0)" style="color:darkred">Reset All Filter Settings</a></p>
          </div>
          <div class="cn-left-bottom"></div>
          <div id="popup_connect"> </div>
        </div>
        <div class="body-connect-right" style="margin-top:25px;">
          <form name='listform' id='listform' method='post' action="">
            <div style="width:700px;font-size:21px;color:#333;line-height:30px;margin-bottom:20px;font-weight:bold">Select the tutors that are relevant to your question:</div>
            <input type="hidden" name="hidden" value="hidden" />
            <div class="cn-content">
            <div class="cn-right-top">
              <div class="cn-column-one" style="width:50px">Ranking</div>
              <div class="cn-column-one" style="width:445px">Rayku Experts</div>
              <div class="cn-column-two" align="center"> <span id="ratesort" class="1" style="cursor:pointer;color:blue;">Rate /min. <span id="ratesymbol" style="display:none;">^</span> </span> </div>
              <div class="cn-column-four" align="center">Connect</div>
              <div class="clear-both"></div>
            </div>
            <div style="width:100%;text-align:center;margin-top:50px;display:none;" id="loadingimage"><img src="<?php echo image_path('loading1.gif', false); ?>"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!--memberlist-->
<div class="clear-both"></div>
