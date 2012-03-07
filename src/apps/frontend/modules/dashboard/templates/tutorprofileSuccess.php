<?php
$connection = RaykuCommon::getDatabaseConnection();
?>
<div id="profile_edit_content">
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/tutor_profile/tprofile-style.css" />
<!--filter popup-->
<div class="filter-popup">

  <!--filter popup inner-->
  <div class="filter-popup-inner">

    <!--close button-->
    <a class="filter-popup-close" href="#"><img src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/tutor_profile/cross.png" alt="Close"/></a>
    <form name="tutor_profile_data" action="/dashboard/tutorprofile" method="post">
      <!--row-2-->
      <div class="row-2 clearfix">
        <h3>Edit your tutor profile</h3>

        <p style="color:#000000">Please fill out as much as possible for best results.</p>
        <p>&nbsp;</p>

        <!--categories-->
        <p>What subjects are you comfortable teaching?</p>
        <br />
        <?php
        $usrid = $sf_user->getRaykuUser()->getId();
        $usrdataq = mysql_query("SELECT * FROM tutor_profile WHERE user_id='".$usrid."'", $connection) or die(mysql_error());
	$usrdata = mysql_fetch_array($usrdataq);

	?>
        <input type="hidden" name="usrid" id="usrid" value="<?php echo $usrid; ?>" />
        <div class="categories">
	        <?php
        	$catquery = mysql_query("SELECT s.id,c.id as catid,s.course_name,c.name FROM courses AS s JOIN category AS c ON c.id=s.category_id WHERE c.status=1", $connection);
        	$e=1;
        	$course = $usrdata['course_id'];
		$course = explode("-",$course);
		while($cat = mysql_fetch_array($catquery))
        	{
        	?>
				<label>
		   		<?php if(in_array($cat['id'], $course)){ ?>
		   		<input name="catcheck[]" type="checkbox" value="<?php echo $cat['id']; ?>" checked />
		   		<?php } else { ?>
		   		<input name="catcheck[]" type="checkbox" value="<?php echo $cat['id']; ?>" />
		   		<?php } ?>
		   		<input type="hidden" name="category" id="category" value="<?php echo $cat['catid']; ?>" />
		    		<?php echo $cat['course_name']; ?></label>
		  		<?php if($e%2==0)
		  		{ ?>
		  			<br />
		  		<?php
		  		}
		  		$e++;

       		}
        	?>
        </div>
        <div style="clear:both;padding-bottom:20px;"></div>
        <!--categories-->
        <?php use_helper('Javascript', 'MyForm') ?>
        <div id="personal-inform">

          <!--Description-->
          <p>What best describes you?</p>

          <select name="description" id="description" style="font-size:12px;border:1px solid #CCC;padding:3px;">
            <option value=""></option>
            <option value="Freshman" <?php if($usrdata['tutor_role']=='Freshman') { ?> selected="selected" <?php } ?>>Freshman</option>
            <option value="Sophomore" <?php if($usrdata['tutor_role']=='Sophomore') { ?> selected="selected" <?php } ?>>Sophomore</option>
            <option value="Junior" <?php if($usrdata['tutor_role']=='Junior') { ?> selected="selected" <?php } ?>>Junior</option>
            <option value="Senior" <?php if($usrdata['tutor_role']=='Senior') { ?> selected="selected" <?php } ?>>Senior</option>
            <option value="Masters Student" <?php if($usrdata['tutor_role']=='Masters Student') { ?> selected="selected" <?php } ?>>Masters Student</option>
            <option value="Phd Candidate" <?php if($usrdata['tutor_role']=='Phd Candidate') { ?> selected="selected" <?php } ?>>Phd Candidate</option>
			<option value="Undergrad Degree Holder" <?php if($usrdata['tutor_role']=='Undergrad Degree Holder') { ?> selected="selected" <?php } ?>>Undergrad Degree Holder</option>
            <option value="Masters Degree Holder" <?php if($usrdata['tutor_role']=='Masters Degree Holder') { ?> selected="selected" <?php } ?>>Masters Degree Holder</option>
            <option value="Phd Degree Holder" <?php if($usrdata['tutor_role']=='Phd Degree Holder') { ?> selected="selected" <?php } ?>>Phd Degree Holder</option>
            <option value="Teaching Assistant" <?php if($usrdata['tutor_role']=='Teaching Assistant') { ?> selected="selected" <?php } ?>>Teaching Assistant</option>
            <option value="Professor" <?php if($usrdata['tutor_role']=='Professor') { ?> selected="selected" <?php } ?>>Professor</option>
            <option value="Middle School Teacher" <?php if($usrdata['tutor_role']=='Middle School Teacher') { ?> selected="selected" <?php } ?>>Middle School Teacher</option>
          <option value="High School Teacher" <?php if($usrdata['tutor_role']=='High School Teacher') { ?> selected="selected" <?php } ?>>High School Teacher</option>
          </select><br /><br />
          <!--Description-->

          <!--School Name-->
          <p>School name:</p>

          <?php echo input_auto_complete_tag('school', $usrdata['school'], 'dashboard/autocomplete', array('use_style' => true)); ?>
          <br/><br/>
          <!--School Name-->

          <!--Study-->
          <p><span id="e">Study:</span></p>
		  <input type="text" name="study" id="study" placeholder="example: Electrical Engineering"value="<?php echo $usrdata['study'];?>" />
          <br />
          <br />
          <!--Study-->

          <!--Course Codes-->
          <p>List all relevant couse codes (1 per line):</p>

          <textarea name="CourseCodes" cols="30" rows="5" style="padding:10px;font-size:12px;color:#666;border:1px solid #ccc;"><?php echo $usrdata['course_code']; ?></textarea><br /><br />
          <!--Course Codes-->
        </div>

        <!--Title Preview-->
        <div style="padding:10px;background:#DDF0F6;width:440px;">
        <p style="color:#036;line-height:20px;">Listing Title Preview:</p>
        <span style="color:#069;font-size:11px;">(When students search for tutors, this is what they will see as you)</span><br /><br />
        <u style="color:#000000"><span id="a">&nbsp;&nbsp;&nbsp;</span> at <span id="b">&nbsp;&nbsp;&nbsp;</span> <span id="d">&nbsp;&nbsp;&nbsp;</span> <span id="c">&nbsp;&nbsp;&nbsp;</span></u></div>
        <!--Title Preview-->

      </div>
      <!--row-2-->

      <!--row-3-->
      <div class="row-3">
        <p>
          <input type="submit" id="filter" value="Save Tutor Profile" />
        </p>
      </div>
      <!--row-3-->

    </form>
  </div>
  <!--filter popup inner-->

</div>
<!--filter popup-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/jquery.selectbox-0.1.3.min.js"></script>
<script type="text/javascript">
var tp = jQuery.noConflict();
tp(".filter-popup").before("<div id='trans'></div>");

tp(".filter-popup-close").click(function(){

    tp(".filter-popup").fadeOut('slow');
    tp("#trans").fadeOut('slow');
    //return false;
    window.location = 'http://' + getHostname() + '/dashboard";
});

tp('.education input').click(function(){
    tp('.hide').hide();
    var radioClass=$(this).attr('class');
    radioClass="#"+radioClass;
    tp(radioClass).slideDown();
});


tp('.sbSelector').bind('click', function() {
    tp(this).css({"border-color":"#bcbcbc"});

});
tp('.sbOptions a').bind('click', function() {
    tp('.sbSelector').css({"border-color":"#d4d4d4"});

});

var verb = '';
var question = 'Study:';
document.getElementById('description').onchange = function() {

    document.getElementById('a').innerHTML = this.value;

    switch (this.value) {
    case 'Freshman':
    case 'Sophomore':
    case 'Junior':
    case 'Senior':
    case 'Masters Student':
    case 'Phd Candidate':
        verb = 'studying';
        question = 'What are you studying?';
        break;

    case 'Masters Degree Holder':
    case 'Phd Degree Holder':
	case 'Undergrad Degree Holder':
        verb = 'having studied';
        question = 'What have you studied?';
        break;

    case 'Teaching Assistant':
    case 'Professor':
    case 'Middle School Teacher':
    case 'High School Teacher':
        verb = 'teaching';
        question = 'What are you teaching?';
        break;
    }

    document.getElementById('d').innerHTML = verb;
    document.getElementById('e').innerHTML = question;
};

document.getElementById('school').onblur = function() {
    document.getElementById('b').innerHTML = this.value;
};

document.getElementById('study').onblur = function() {
    document.getElementById('c').innerHTML = this.value;
};

tp(document).ready(function() {
  // Handler for .ready() called.
  document.getElementById('a').innerHTML = document.getElementById('description').value;
  document.getElementById('b').innerHTML = document.getElementById('school').value;
  document.getElementById('c').innerHTML = document.getElementById('study').value;
  document.getElementById('d').innerHTML = verb;
  document.getElementById('e').innerHTML = question;

});

</script>
</div>
