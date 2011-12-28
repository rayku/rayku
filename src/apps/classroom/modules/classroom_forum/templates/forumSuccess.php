<?php use_helper('Javascript'); ?>

<div class="title" style="float:left">

	<img src="../../../images/newspaper.gif" alt="" />

	<p><?php echo $forum->getForumName();?> &nbsp;forum posts</p>

</div>


<div class="spacer"></div>

<?php  include_partial('classroom_forum/showForum', array('forumID' => $forum->getId())); ?>


<?php  include_partial('classroom_forum/makePostForm', array('forumID' => $forum->getId())); ?>
