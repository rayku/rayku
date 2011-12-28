<div class="body-side">
  
  <?php if($friends != NULL) : ?>
  
  <div id="selectfriends">Select friend to message</div>

  <?php include_partial('message/friendsList',array('friends'=>$friends)); ?> 
  
  <?php endif; ?>

  <div id="searchfm">Search for a member</div>
    <div class="box">
      <div class="top"></div>
        <div class="content">
          <div class="text">Browse through our user database with one easy search, and connect with friends now!</div>

            <form action="/search/index" id="search-form" method="post">
            <fieldset>
              <div>Name, Email, Hobbies, or Interests:</div>

              <input type="text" class="text-box" name="criteria"  id="searchbox"/>
              <input type="submit" id="searchbtn" value="" />
            </fieldset>
            </form>

        </div>
        <div class="spacer"></div>
        <div class="bottom"></div>
    </div>

  <?php echo link_to('Private Messages Home Page', 'message/index',array('class'=>'btmlnk')); ?>
</div>