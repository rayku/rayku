<?php
  $raykuUser = $sf_user->getRaykuUser();
  $stats = $raykuUser->getStatisticsForDashboard();
?>
<link rel="stylesheet" type="text/css" href="/css/custom/button.css"/>
<style>
#askqu
{
	margin:0 auto;
	width:617px;
	max-height:175px;
	margin:4px 15px;
	border:1px solid #0f6c9e;
	border-top:2px solid #0f6c9e;
	background:#FFFFFF;
	font-size:16px;
	font-family:Tahoma, Geneva, sans-serif;
}
#askqu-top {
}
#askqu-top .textarea {
	border-bottom: 1px solid #CCCCCC;
	color: grey;
	font: italic 14px Arial;
    font-size: 15px;
    height: 45px;
    padding: 15px;
    width: 587px;
	resize: none;
}
#askqu-main
{
	padding:10px;
	background:#F4F4F4;
}
#askqu-main p
{
	color:#069;
	line-height:18px;
}
</style>

<script type="text/javascript">
function formSubmit()
{
document.getElementById("frm1").submit();
}
</script>


<div id="askqu">
	<div id="askqu-top">
    <?php $categories = CategoryPeer::doSelect(new Criteria()); ?>
      <form id="frm1" action="dashboard/list" method="post">
        <textarea class="textarea" onblur="if(this.value=='') { this.value='Question or topic you need help with (in one sentence)...'; this.style.color='grey'; this.style.font='italic 14px Arial'; }" onfocus="if(this.value=='Question or topic you need help with (in one sentence)...') { this.value=''; this.style.color='#111111'; this.style.font='normal 14px Arial'; }" id="question" name="question">Question or topic you need help with (in one sentence)...</textarea>
        </div>
		<div id="askqu-main">
                  <div id="error" style="margin-bottom:5px;"> </div>
        <div style="float:left;width:150px;">
        <p>Subject:</p>
<?php $limitSubject = array('0' => '1', '1' => '5'); ?>
          <select name="subject" id="subject" style="background:none repeat scroll 0 0 #FFFFFF;border:1px solid #CCCCCC;color:#333333;font-size:14px;height:32px;margin-top:10px;padding:5px 10px;width:140px;">
            <?php foreach( $categories as $category): ?>
            <?php if(in_array($category->getId(), $limitSubject)): ?>
            <option value="<?=$category->getId();?>" <?php if($cat == $category->getId()): ?> <?php endif; ?> >
            <?=$category->getName();?>
            </option>
            <?php endif; ?>
            <?php endforeach; ?>
          </select>
        </div>
       <div style="float:right;width:150px;margin-top:10px" align="right">
        			<input type="hidden" name="redirect" id="redirect" value="1" />

			<input type="button" class="myButton" onClick="return CheckMsg();" value="Get Help!" />
<span style="font-size:12px;font-weight:normal;color:#666">
 <br />
 or <a href="#" title="Just connect with the top 4 most relevant tutors available now." onClick="return CheckLink();">Quick Connect</a>&nbsp;</span>
        </div>
      </form>
      <div class="clear-both"></div>
      <?php
if($_SESSION['conversation'] == 1) : 
unset($_SESSION['conversation']);
?>
      <div>
        <p style="color:#C30;font-size:13px;font-weight:bold">Please finish the current session before asking another question (may take 2 minutes to update).</p>
      </div>
      <?php endif; ?>
    </div>
</div>
<script type="text/javascript">
function CheckMsg() {
var question = document.getElementById('question').value;
var subject = document.getElementById('subject').value;
var error = '<p class="cn-pricepermin"><em style="font-size:14px;color:red;line-height:20px;">Oops, you missed something!</em></p>';
if(question == "Question or topic you need help with (in one sentence)...") {

document.getElementById('error').innerHTML = error;
	return false;
}
if(subject == '' || subject == null || subject.length == 0) {
	
document.getElementById('error').innerHTML = error;
	return false;
}
document.getElementById("redirect").value = 1;

document.getElementById("frm1").submit();
}

function CheckLink() {

	var question = document.getElementById('question').value;
	var subject = document.getElementById('subject').value;
	var error = '<p class="cn-pricepermin"><em style="font-size:14px;color:red;line-height:20px;">Oops, you missed something!</em></p>';
	if(question == "Question or topic you need help with (in one sentence)...") {

	document.getElementById('error').innerHTML = error;
		return false;
	}
	if(subject == '' || subject == null || subject.length == 0) {
	
	document.getElementById('error').innerHTML = error;
		return false;
	}

	document.getElementById("redirect").value = 2;

	document.getElementById("frm1").submit();



}


</script> 
