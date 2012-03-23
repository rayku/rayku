<?php use_helper('MyForm', 'Javascript', 'Enum','Validation') ?>


<?php /* get the count of email address if found */ ?>
<?php if(isset($display_array) and count($display_array)>0): ?>
<?php echo form_tag('register/sendInvitation',array("name"=>"form_results")) ?>
    <div class="left-bg green import-results" >

        <div class="left-top"></div>

        <div class="send-gift" style="height:300px;overflow-y:scroll;padding-right:0">

            <h3 class="your-friends">Your Email Contacts (select ones to invite)</h3>
            <p style="text-align:left; padding-left:10px">
                <a href="javascript:checkall(true)"><font >Check All</font></a>&nbsp;&nbsp;
                <a href="javascript:checkall(false)"><font >Uncheck All</font></a>
            </p>
            <?php foreach($display_array as $key=>$val): ?>

            <div class="res-item">

                <div class="res-tick"><?php echo checkbox_tag("list[]",$key.'x22z'.$val,true)?></div>
                <div class="res-name"><?php echo $key;?></div>
                <div class="res-email"><?php echo $val;?></div>

            </div>

            <?php endforeach; ?>        

        </div>

        <input name="submit" type="image" value="1" src="/images/invite-your-friends.png" alt="Invite Your Friends" style="clear: both; float: right;margin-right:10px; margin-top: 14px;" onClick="" />
        <div class="left-bottom"></div>

    </div>

</form>

<?php  else : ?>

<p align=center>
	<b>
    	<font face=Arial size=2 color=#3366CC>
        	ERROR - No contacts were found. Your login info was wrong?.
        </font>
    </b>
</p>	
<?php  endif; ?>


