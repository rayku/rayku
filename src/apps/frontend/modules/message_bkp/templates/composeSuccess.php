<?php use_helper('Javascript', 'MyForm') ?>

<div id="top">
    <div class="title">
    <img src="/images/arrow-right.gif" alt="" />
    <p><a href="/message">Private Messages</a> > New Message</p>
    </div>
    <div class="spacer"></div>
</div>

<div class="body-main">

	<div id="msgnav">
	<?php echo link_to('Inbox', '@inbox',array('id'=>'inbox')); ?>
	<?php echo link_to('Send Messages', '@outbox',array('id'=>'sent')); ?>
	<?php echo link_to('Compose new message', 'message/compose',array('id'=>'new','class'=>"active")); ?>
<div class="clear-both"></div>
</div>

<div class="box">
	<div class="top"></div>
	<div class="content">
	<?php echo form_tag('message/send') ?>

        <div class="entry">
                                	<div class="ttle">To (username):</div>
                                    <div>
                                		<?php echo input_auto_complete_tag('name', $to, 'friends/autocomplete', array(), array('use_style' => true)); ?>
                                    	<?php echo form_error('name'); ?>
                                        <div class="availableb">Start typing a username, or select a friend.</div>
                                    </div>
                                </div>

        <div class="entry">
                                	<div class="ttle">Message Title:</div>
                                	<?php echo input_tag('subject', $sf_params->get('subject', '')); ?>
                                    <?php echo form_error('subject'); ?>
                                </div>

		<div class="entry">
                                    <div class="ttle">Message:</div>
                                    <div class="spacer"></div>
                                   <?php echo textarea_tag('body', '', array('style' => 'width:430px;height:210px;padding:10px;font-size:14px;color:#777777'), 'Message'); ?>
                                   <?php echo form_error('body'); ?>
                                </div>
                                
        <?php echo submit_tag('Send this private message',array('class'=>'button')); ?>
                                
        <div class="spacer"></div>
    </form>
</div>
<div class="spacer"></div>
<div class="bottom"></div>
</div>



























	<br class="clear" />

</div>
<?php include_partial('message/rightSideBlock', array('friends' => $friends)); ?>
