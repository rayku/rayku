<?php
 if(!($sf_user->isAuthenticated())): 
    header('Location:'." http://".$_SERVER['HTTP_HOST']);
  endif
?>
<style type="text/css">
div#mainContent {
	margin: 0px;
	background: #ebebeb
}
b.rtop, b.rbottom {
	display:block;
	background: #ffffff;
}
b.rtop b, b.rbottom b {
	display:block;
	height: 1px;
	overflow: hidden;
	background: #ebebeb
}
b.r1 {
	margin: 0 5px
}
b.r2 {
	margin: 0 3px
}
b.r3 {
	margin: 0 2px
}
b.rtop b.r4, b.rbottom b.r4 {
	margin: 0 1px;
	height: 2px
}
button {
	border: 0 none;
	cursor: pointer;
	font-weight: bold;
	padding: 0 15px 0 0;
	text-align: center;
	height: 30px;
	line-height: 30px;
	width: auto;
}
button.rounded {
	background: transparent url( /images/btn_right.png ) no-repeat scroll right top;
	clear: left;
	font-size: 1em;
}
button span {
	display: block;
	padding: 0 0 0 15px;
	position: relative;
	white-space: nowrap;
	height: 30px;
	line-height: 30px;
}
button.rounded span {
	background: transparent url( /images/btn_left.png ) no-repeat scroll left top;
	color: #FFFFFF;
}
button.rounded:hover {
	background-position: 100% -30px;
}
button.rounded:hover span {
	background-position: 0% -30px;
}
button::-moz-focus-inner {
border: none;
}
</style>
<script language="javascript">
var XMLHttpRequestObject = false;
if (window.XMLHttpRequest) {
XMLHttpRequestObject = new XMLHttpRequest();
} else if (window.ActiveXObject) {
XMLHttpRequestObject = new
ActiveXObject("Microsoft.XMLHTTP");
}

function addToStore(id)
{
	var giftid = document.getElementById('giftid');
	giftid.value = id;
	if(XMLHttpRequestObject) {
	var obj = document.getElementById('attachedGift');



	url = "http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/gifts/select/giftid/"+id;
	alert(url);
	XMLHttpRequestObject.open("GET", url);

	XMLHttpRequestObject.onreadystatechange = function()
	{
	if (XMLHttpRequestObject.readyState == 4 &&
	XMLHttpRequestObject.status == 200) {
	alert(XMLHttpRequestObject.responseText);
	
	obj.innerHTML = '';
	obj.innerHTML =
	XMLHttpRequestObject.responseText;
	}
	}

	XMLHttpRequestObject.send(null);
	}
}
function checkuser(name)
{

	if(XMLHttpRequestObject) {
	var checkuser = document.getElementById('checkuser');

	$url = "ajaxgift.php?checkuser="+name;

	XMLHttpRequestObject.open("GET", $url);

	XMLHttpRequestObject.onreadystatechange = function()
	{
	if (XMLHttpRequestObject.readyState == 4 &&
	XMLHttpRequestObject.status == 200) {

			checkuser.innerHTML = '';
			checkuser.innerHTML =
			XMLHttpRequestObject.responseText;
		if(XMLHttpRequestObject.responseText!='')
		{
			document.getElementById('continue').disabled = true;

		}else
		{
			document.getElementById('continue').disabled = false;
		}
	}
	}

	XMLHttpRequestObject.send(null);
	}
}

function showgifts(username)
{

	var giftlist = document.getElementById('giftlist');
	document.getElementById('newgifts').style.display = "none";
		if(XMLHttpRequestObject) {

	$url = "ajaxgift.php?seen=seen&username="+username;

	XMLHttpRequestObject.open("GET", $url);

	XMLHttpRequestObject.onreadystatechange = function()
	{
	if (XMLHttpRequestObject.readyState == 4 &&
	XMLHttpRequestObject.status == 200) {

			giftlist.innerHTML = '';
			giftlist.innerHTML =
			XMLHttpRequestObject.responseText;
	}
	}

	XMLHttpRequestObject.send(null);
	}
}
function checkContinue()
{
	var giftid = document.getElementById('giftid');
	var recipient = document.getElementById('input-who');
	var message = document.getElementById('input-message');
	var attachedGift = document.getElementById('attachedGift');
	
	if(recipient.value == '' || message.value == '')
	{
		alert('Please fill all entries.');
		return false;
	}
	
	if(giftid.value == '' || attachedGift.innerHTML == '' )
	{
		alert('You have not selected any gift.');
		return false;
	}
	
	document.giftFrm.submit();
	return true;	 
}
</script>
<div class="body-main">
  <div id="what-is">
    <div style="width:30px; float:left;"> <img src="/images/green_arrow.jpg" width="42" height="25" alt="" /> </div>
    <p style="font-size:14px; color:#1c517c; font-weight:bold; margin-left:50px;"><a href="/shop/index" style="color:#1C517C">Rayku $RP Shop</a> > Send a Gift</p>
  </div>
  <p style="font-size:12px;color:#777777;margin:0 0 10px 0;"><strong>Note:</strong> This function does not go through the shop checkout system. It is instant delivery.</p>
  <div class="left-bg">
    <div class="left-top"></div>
    <div class="send-gift">
      <h3>Select a gift that you would like to send:</h3>
      <?php foreach($gifts as $gift) { ?>
      <div onClick="$('imgfrm_<?php echo $gift->getId();?>').submit();" class="gift-box">
        <form name="imgfrm_<?php echo $gift->getId();?>" action="<?php echo url_for('gifts/index?giftid=' . $gift->getId()); ?>" method="post" id="imgfrm_<?php echo $gift->getId();?>" >
          <img src="/images/<?php echo $gift->getImage();?>" alt="<?php echo $gift->getImage();?>"  />
          <div id="price">
            <?php  echo $gift->getCost();?>
            $RP</div>
        </form>
      </div>
      <?php } ?>


<?php 

$value = explode("/", $_SERVER['REDIRECT_URL']);

if(count($value) > 3):

	$giftAll = GiftPeer::retrieveByPK($value[4]);
	
endif;

?>


      <div class="clear-both"></div>
    </div>
    <hr class="divider" />
    <div class="send-gift">
      <form name="giftFrm" action="/gifts/process" method="post">
        <input type="hidden" name="giftid" id="giftid" value="<?php if($giftAll) echo $giftAll->getId();?>">
        <h3>Who are you sending it to?</h3>
        <input name="recipient" type="text" id="input-who" />
        <h3>Message to send with gift</h3>
        <textarea name="message" cols="" rows="" id="input-message"></textarea>

    </div>
    <hr class="divider" />
    <div class="send-gift">
      <h3>Choose privacy level</h3>
      <div class="privacy_block">
        <div class="privacy_block_left" style="padding-top: 7px;">
          <input name="send_type" type="radio" value="0" checked="checked" />
        </div>
        <div class="privacy_block_text">
          <h3>Public</h3>
          <p>People will see your gift and message. The gift will appear in the recipient's gift box and the wall.</p>
        </div>
      </div>
      <div class="clear-both"></div>
      <div class="privacy_block">
        <div class="privacy_block_left" style="padding-top: 17px;">
          <input name="send_type" type="radio" value="1" />
        </div>
        <div class="privacy_block_text">
          <h3>Private</h3>
          <p>People wll see the gift but only the recipient will see your name and message.<br />
            The gift will appear in the recipients gift box but no their wall.</p>
        </div>
      </div>
      <div class="clear-both"></div>
      <div class="privacy_block">
        <div class="privacy_block_left" style="padding-top: 17px;">
          <input name="send_type" type="radio" value="2" />
        </div>
        <div class="privacy_block_text">
          <h3>Anonymous</h3>
          <p>People will see the gift but only the recipient will see your message. No one will see your name.<br />
            The gift will appear in the recipients giftbox but not the wall.</p>
        </div>
      </div>
      <input name="submit" type="submit" id="continue" value="" onClick="return checkContinue();" />
</form>
      <div class="clear-both"></div>
    </div>
  </div>
  <div class="left-bottom"></div>
</div>






<!--<div class="body-side" style="display: inline; margin-top: 37px;">
  
  <div class="right-bg">
    <div class="right-top"></div>
    <div class="right-inside">
      <h3>You have <?php echo $user->getPoints();?> gift credits.</h3>
      <div style="margin:0;">
      <?php if(isset($selectedGift) && $selectedGift) { ?>
        <div id="attachedGift" style="">
          <img src="/images/gifts/<?php echo $selectedGift->getImage();?>"/>
          <br />
          <span style="font-size:10px; color:#999999; font-weight:bold;">
          Credit Cost&nbsp;:&nbsp;<?php echo $selectedGift->getCost();?>
          </span>
        </div>
      <?php } ?>
      </div>
    </div>
  </div>
  <div class="right-bottom"></div>

  <div class="right-bg">
    <div class="right-top"></div>
      <div class="right-inside">
        <h3>Gifts you've received</h3>
          <?php
            foreach($userGifts as $userGift)
            {
              $gift = $userGift->getGift();
              $giver = $userGift->getUserRelatedByGiverId();
          ?>
            <div class="receivedgifts">
              <div class="receivedleft">
                <img src="/images/gifts/<?php echo $gift->getImage();?>" alt="" />
              </div>
              <div class="receivedright">
                 From: <a href="<?php  echo url_for('@profile?username=' . $giver->getUsername()) ?>"><?php  echo  $giver->getName(); ?></a><br /><?php echo $userGift->getMessage() ?>
              </div>
              <div class="clear-both"></div>
            </div>
          <?php } ?>
      </div>
  </div>
  <div class="right-bottom"></div>
                        
</div>
<br class="clear-both" /> -->

<?php include_component('shop','rightBox') ?>
<script type="text/javascript">
$$('.gift-box').each(function(item){ 
item.observe('mouseover',function(ev){var ele=Event.element(ev);item.setStyle({background:'transparent url(/images/bluebg.gif) no-repeat'});});
item.observe('mouseout',function(ev){var ele=Event.element(ev);item.setStyle({background:'none'});});
});
</script>
