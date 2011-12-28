<?php
$user = $sf_user->getRaykuUser();
?>

<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/styles/classroom.css" />

<style type="text/css">
.title {
	color:#1c517c;
	font:16px "Arial";
	font-weight:bold;
	}
.subtitle {
	color:#7f8189;
	font:12px "Arial";
	padding-bottom:5px;
	margin-top:3px;
	}
</style>

<div class="body-main">

  <div class="title" style="float:left; margin-left:20px; margin-top:20px;">
    <img src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/images/newspaper.gif" alt="" />
    <p>Welcome <?php echo $user; ?></p>
  </div>

  <div class="spacer"></div>

  <div class="entry" style="margin-bottom:11px; margin-top:80px;">
    <div class="top"></div>
      <div class="content">
        <div class="hand-in">
          <div class="email-st">
            <label>Expert account is all about of  blah blah ..............</label>
            <br />
            <br />

            <?php if($account == NULL): ?>

              <label>
                Do you want to upgrade to expert accont?
                <?php echo link_to('Click here', 'studentmanager/expertprogram?account=switch'); ?>
              </label>

            <?php else:

              echo form_tag('studentmanager/expertswitch');
                echo input_hidden_tag('user_id',$user->getId());

                echo '<div class="title">Select Expert Categories</div>';
                echo '<div class="subtitle">
                        Every expert needs to select atleast one category (Can select multiple categories with shift button)
                      </div>';

                echo select_tag( 'categories', options_for_select( CategoryPeer::getAllForSelect() ),
                                 array('style' => 'width: 300px; height: 80px; background: none', 'multiple' => true) );

                echo '<br />';
                echo submit_tag('Register') ?>
              </form>

          <?php endif; ?>

        </div>
      </div>
    </div>

     <div class="bottom"></div>
   </div>



</div>