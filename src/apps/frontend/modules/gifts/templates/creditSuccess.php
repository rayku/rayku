<script type="text/javascript">
function addCredit(amt)
{
	var amount = document.getElementById('return');
	var url = 'http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/gifts/payment' + '/amt/' + amt;
	amount.value = url;
	
	var credit = document.getElementById('amount');
	
	if(amt == 10)
	{
		credit.value =1;
	}else if(amt == 50)
	{
		credit.value =5;
	}else if(amt == 100)
	{
		credit.value =10;
	}
	 
}
</script>
<style type="text/css">
div#mainContent{ margin: 0px;background: #ebebeb}
b.rtop, b.rbottom{display:block;background: #ffffff;}
b.rtop b, b.rbottom b{display:block;height: 1px;
    overflow: hidden; background: #ebebeb}
b.r1{margin: 0 5px}
b.r2{margin: 0 3px}
b.r3{margin: 0 2px}
b.rtop b.r4, b.rbottom b.r4{margin: 0 1px;height: 2px}
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

<h2>Buy Credit</h2>
<div id="mainContent" style="background:#ebebeb; ">
		<b class="rtop">
	  			<b class="r1"></b>
                <b class="r2"></b>
                <b class="r3"></b>
                <b class="r4"></b>
		</b>
		<form name="paypalfrm" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" id="amount" name="amount" value="1">
		<input type="submit" name="Submit" value="Donate" style="display:none;">
		<input type="hidden" id="return" name="return"
		value="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/gifts/payment/amt/10">
		<input type="hidden" name="cancel_return"
		value="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/gifts/payment_error">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="item_name" value="himanshu">
		<input type="hidden" name="item_number" value="1">
		<!--<input type="hidden" name="business" value="dreamajax.himanshu@gmail.com">-->
		<input type="hidden" name="business" value="shreelakshmi.u@dreamajax.com">
		<input type="hidden" name="currency_code" value="USD">
 
		<table cellpadding="10px" cellspacing="10px" width="500px" style="margin:10px;">
			<tr>
				<td>

				</td>
			</tr>
			<tr>
				<td>
				<table>
					<tr>
						<td colspan="2"><b>Select Credits Amount:</b></td>
					</tr>
					<tr>
						<td width="5px"></td><td><input type="radio" name="credit_count" value="0" checked="checked" onclick="javascript:addCredit(10);">10 Credits ($1.00 USD)</td>
					</tr>
					<tr>
						<td width="5px"></td><td><input type="radio" name="credit_count" value="1" onclick="javascript:addCredit(50);">50 Credits ($5.00 USD)</td>
					</tr>
					<tr>
						<td width="5px"></td><td><input type="radio" name="credit_count" value="2" onclick="javascript:addCredit(100);">100 Credits ($10.00 USD)</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td>
					<button class="rounded" onClick="this.form.submit();">
					  <span>Continue</span>
					</button>
					
					<button class="rounded" onClick="javascript:document.cancelfrm.submit();">
					  <span>Cancel</span>
					</button>
				
					
				</td>
			</tr>
		</table>
		</form>
		<b class="rbottom">
		<b class="r4"></b>
		<b class="r3"></b>
		<b class="r2"></b>
		<b class="r1"></b>
	</b>
</div>