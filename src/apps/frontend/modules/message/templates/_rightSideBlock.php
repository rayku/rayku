<div class="body-side">
  
  <div id="searchfm">Search for a Member</div>
    <div class="box">
      <div class="top"></div>
        <div class="content">
          <div class="text">Browse through our user database with one easy search and connect  now!</div>

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

  <?php echo link_to('Back to Private Messages', 'message/index',array('class'=>'btmlnk')); ?>
</div>