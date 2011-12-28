<?php use_helper('Validation', 'MyForm') ?>
<?php
/* @var $gallery Gallery */

$raykuUser = $sf_user->getRaykuUser();
?>
<?php if ($sf_user->isAuthenticated() && $gallery->isOwnedBy($raykuUser)): ?>
<style type="text/css"></style>
<script type="text/javascript">

function loadVideos() {

	document.getElementById('loading_video').style.display = "block"; 

  }
  
function loadImages() {

	document.getElementById('loading_images').style.display = "block"; 

  }
  
/*function call_loading(){ 

 var el = document.getElementById("loading_box");
     el.innerHTML = '<img src="/images/loading.gif">';
        new Effect.Appear('loading_box');
  }*/
</script>
<?php /* @var $gallery Gallery */ ?>

<div id="top" style="margin-left:16px;padding-top:2px">
  <div style="width:30px; float:left;"><img height="25" width="42" src="/images/green_arrow.jpg"/></div>
    <div style="font-size:16px; color:#1C517C; font-weight:bold; margin-left:25px; padding-top:3px;float:left"><a href="/gallery/list/<?php echo $sf_user->getRaykuUser()->getId() ?>">Gallery Home</a> > <a href="/gallery/show/<?php echo htmlentities($gallery->getId()) ?>">Album "<?php echo htmlentities($gallery->getTitle()) ?>"</a> > Upload</div>
  <div class="spacer"></div>
</div>
<div class="body-main">
  <div id="pictures" class="box"> <?php echo form_tag('@gallery_upload?id=' . $gallery->getId(), 'multipart=true') ?>
    <div class="top"></div>
    <div class="content">
      <div class="mediacount"> <img src="/images/ico/album-homepage-pic.gif" style="border:none" alt="" />
        <p style="text-align:left;padding-top:5px">Picture Upload</p>
      </div>
      <div id="loading_images" style="display:none; margin-left:-350px;padding-bottom:15px; padding-top:15px;"> <img src="/images/loader.gif" border="0" alt="loader"/> </div>
      <div class="select" style="text-align:left;">Select a picture you would like to upload.</div>
      <div class="browse">
        <input type="text" id="picupload" disabled="disabled" />
        <!--<input type="file" size="71" onchange="document.getElementById('picupload').value=this.value" />--> 
        <?php echo input_file_tag('file',array('size'=>'71','onChange'=>'document.getElementById("picupload").value=this.value')) ?> </div>
      <div class="allowed" style="text-align:left;">JPG, GIF, PNG - Max <?php echo $maximum_upload_size ?>B size</div>
      <?php echo form_error('file'); ?>
      <div style="width:100%;text-align:left;	"> <?php echo submit_tag('Upload',array('style'=>'cursor:pointer;cursor:hand;','class'=>'upload','onClick' => 'loadImages()')) ?> </div>
    </div>
    <div class="spacer"></div>
    <div class="bottom"></div>
    </form>
  </div>
  <!-- end of box -->
  
  <div class="spacer"></div>
  <div class="box"> <?php echo form_tag('@gallery_upload?id='.$gallery->getId(), 'multipart=true') ?>
    <div class="top"></div>
    <div class="content">
      <div class="mediacount"> <img src="/images/ico/album-homepage-vid.gif" style="border:non" alt="" />
        <p style="text-align:left;padding-top:5px">Video Upload</p>
      </div>
      <div id="loading_video" style="display:none; margin-left:-350px;padding-bottom:15px; padding-top:15px;"> <img src="/images/loader.gif" border="0" alt="loader"/> </div>
      <div class="select" style="text-align:left;">Select a video you would like to upload.</div>
      <div class="browse">
        <input type="text" id="vidupload" disabled="disabled" />
        <!--<input type="file" size="71" onchange="document.getElementById('vidupload').value=this.value" />--> 
        <?php echo input_file_tag('file',array('size'=>'71','onChange'=>'document.getElementById("vidupload").value=this.value')) ?> </div>
      <div class="allowed" style="text-align:left;">MPEG, MOV, AVI - Max 16MB size</div>
      <?php echo form_error('file'); ?>
      <div style="width:100%;text-align:left;	"> <?php echo submit_tag('Upload',array('class'=>'upload','onClick' => 'loadVideos()')) ?> </div>
    </div>
    <div class="spacer"></div>
    <div class="bottom"></div>
    </form>
  </div>
</div>
<!-- end of body-main -->

<div class="body-side">
  <div class="box">
    <div class="top"></div>
    <div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
      <div align="left" style="font-size:14px;line-height:22px;font-weight:bold;color:#060;margin-top:0px">What should I know about uploading my photos &amp; videos?</div>
      <div class="text" align="left"> We will never share your photos or video with other services or to profit from them. </div>
      <div class="text" align="left"> You shouldn't consider this as a backup service as we can't be held responsible if files are lost due to technical difficulties. </div>
    </div>
    <div class="spacer"></div>
    <div class="bottom"></div>
  </div>
  <a href="/gallery/show/<?php echo htmlentities($gallery->getId()) ?>" class="navlink back">Back to Album</a>
</div>
<!-- end of body-side -->

<?php else:  ?>
You do not have permission to upload here.
<?php endif; ?>
