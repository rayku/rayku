<?php use_helper('Object') ?>
<?php use_helper('Javascript'); ?>
<style media="all" type="text/css">
@import "/styles/global.css";
 @import "/styles/donny.css";
 @import "/css/custom/forum-threads-bit.css";
 .error
 {
	 color:#F00;
	 font-size:12px;
 }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
  function gotoforum()
  {
    if(document.getElementById('jumpto').value!="")
    {
      window.location=document.getElementById('jumpto').value ;
    }
  }


  function validate()

  {
  		title= document.getElementById('thread_title').value;

		if(title == '')
		{
			alert('Title is empty!');
			return false;
		}


return false;

  }


function get_smile(val)
{



//	alert(document.getElementById("post_body").value);

	// alert(val);

	document.getElementById("post_body").value = val;

	alert( tinyMCE.get('post_body').getContent()) ;

//	alert(document.getElementById("post_body").value);

}
/*
$(document).ready(function(){
	
	$(".question-post").click(function(){
		var thread_val=document.getElementById("thread_title").value;
		var post_body=document.getElementById("post_body").value;
	
		if(thread_val.length<10)
		{
			alert("Title should be more than 10 characters");
			return false;
		}
		else
		{
			return true;
		}
		
		return false;
		
		});
	});
	*/

</script>

<div id="body">
<div id="top" style="margin-left:16px;padding-top:2px">
  <div style="width:30px; float:left;"><img height="25" width="42" src="<?php echo image_path('green_arrow.jpg', false); ?>"/></div>
  <div style="font-size:16px; line-height:24px;color:#1C517C;font-weight:bold;margin-left:25px;float:left;width:600px;"><?php echo link_to('Q&A Boards','forum/index'); ?> > <?php echo link_to($category->getName(),'forum/'.$category->getId().'');?> > New Question</div>
    <select id="jumpto"  onchange="return gotoforum();">
      <option value="">Quick forum selection</option>
      <?php foreach($publicforums as $publicforum): ?>
      <?php if($publicforum->getTopOrBottom() == '0'): ?>
      <option value="<?php echo '/forum/'.$publicforum->getID() ; ?>"><?php echo $publicforum->getName(); ?></option>
      <?php endif; ?>
      <?php endforeach; ?>
      <?php foreach($allcategories as $categorie): ?>
      <option value="<?php echo '/forum/'.$categorie->getID() ; ?>"><?php echo $categorie->getName(); ?> </option>
      <?php endforeach; ?>
      <?php foreach($publicforums as $publicforum): ?>
      <?php if($publicforum->getTopOrBottom() == '1'): ?>
      <option value="<?php echo '/forum/'.$publicforum->getID() ; ?>"><?php echo $publicforum->getName(); ?></option>
      <?php endif; ?>
      <?php endforeach; ?>
    </select>
	
  </div>
  <div class="spacer"></div>
  <div class="body-main"> <?php echo form_tag('@new_thread?forum_id='.$category->getID()); ?>
    <div class="box">
      <div class="top"></div>
      <div class="content">
      <?php if($_GET[exp_online]==1):?>
		<p style="font-size:14px;color:red;padding-top:15px;" align="center"><em>Uh-oh... all experts are either busy or unavailable. Please elaborate on your question below:</em></p>
		<?php endif;?>
        <!--threadtitle-->

        <div class="content-info">
          <h1 class="info" style="font-size:16px; font-weight:normal; margin-top:10px;">Question  (25 words or less): <?php if($title_error<>''){echo '<span class="error">('.$title_error.' )</span>';}?></h1>

	 
	<?php if(!empty($_COOKIE["forumsub"]) || $_GET['exp_online']==1 || $_GET['pob']==1) : ?>
		
         	 <input name="thread_title" id="thread_title" value="<?php echo $_SESSION['question']; ?>" size="30" type="text" style="color:#000000"> 

		<?php 
			setcookie("forumsub", "", time()-3600,"/",sfConfig::get('app_cookies_domain'));
			 $_COOKIE["forumsub"] = "";

			 setcookie("redirection", "", time()-3600,"/",sfConfig::get('app_cookies_domain'));
			 $_COOKIE["redirection"] = "";

		 ?>
 
       <?php else : ?>
		
		<input name="thread_title" id="thread_title" value="" size="30" type="text" style="color:#000000"> 
	
    
   
   
	<?php endif; ?>
	<h1 class="info" style="font-size:16px; font-weight:normal; margin:25px 0 15px 0">Question Full Description: <?php if($desc_error<>''){echo '<span class="error">('.$desc_error.')</span>';}?>	</h1>
    	
          <?php echo textarea_tag('post_body','',array('size' => '60x35', 'rich' => 'fck')); ?>
          </div>
        <!--content-info-->

      </div>
      <div class="spacer"></div>
      <div class="bottom"></div>
      <input type="submit" name="Post" class="question-post">

      <!--   <a class="question-post" href="#">post</a>-->
    </div>
    <div class="spacer"></div>
  </div>
  <div class="body-side">
    <div class="box">
      <div class="top"></div>
      <div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
        <div class="title" style="margin-top:0px;padding-left:0;">
          <h1>Tags:</h1>
        </div>
        <div class="text"> Separate each tag with a comma.
          <div class="group">
            <input type="text" name="tags" value="" size="35" style="width:225px;border:1px solid #98C0D6;background:none" />
          </div>
        </div>
      </div>
      <div class="bottom"></div>
    </div>
    <div class="box">
      <div class="top"></div>
      <div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
        <div class="title" style="margin-top:0px;padding-left:0;">
          <h1>Response Notifications:</h1>
        </div>
        <div class="text">How would you like to be notified when someone responds?
          <!-- <div class="group">
                                    	<label>SMS:</label> <input type="checkbox" /> <input type="text" />
                                    </div>-->
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><div class="group">
                  <label>Email:</label>
                  <input type="checkbox" name="notify_email" value="1"/>
                  <!--<input type="text" />-->
                </div></td>
              <td><div class="group">
                  <label>PM:</label>
                  <input type="checkbox" name="notify_pm" value="1" checked="checked" />
                  <!--<input type="text" />-->
                </div></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="bottom"></div>
    </div>
  </div>
  </form>
</div>
