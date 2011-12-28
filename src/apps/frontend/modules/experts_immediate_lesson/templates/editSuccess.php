<?php use_helper('Javascript'); ?>
<script type="text/javascript" src="/js/supernote.js"></script> 
<style media="all" type="text/css">
@import "/styles/ex_supernote.css";
.entry select 
{
	width:295px; height:40px;
	background:#fff url(/images/add-journal-view.gif) no-repeat;
	float:left;
	margin-right:5px;
	color:#3d3d3d;
	font:14px "Arial";
	border:0px;
	padding:11px 10px 10px 12px;
}
.days:hover
{
	background-color:#0099CC;
	color:#000000;
	font-weight:bold;
	cursor:pointer;
}
.green
{
	background-color:#009900; 
	color:#FFFFFF
}
.red
{
	background-color:#FF0000;
	color:#FFFFFF;
}



</style>
<script type="text/javascript">

// SuperNote setup: Declare a new SuperNote object and pass the name used to
// identify notes in the document, and a config variable hash if you want to
// override any default settings.

var supernote = new SuperNote('supernote', {});

// Available config options are:
//allowNesting: true/false    // Whether to allow triggers within triggers.
//cssProp: 'visibility'       // CSS property used to show/hide notes and values.
//cssVis: 'inherit'
//cssHid: 'hidden'
//IESelectBoxFix: true/false  // Enables the IFRAME select-box-covering fix.
//showDelay: 0                // Millisecond delays.
//hideDelay: 500
//animInSpeed: 0.1            // Animation speeds, from 0.0 to 1.0; 1.0 disables.
//animOutSpeed: 0.1

// You can pass several to your "new SuperNote()" command like so:
//{ name: value, name2: value2, name3: value3 }


// All the script from this point on is optional!

// Optional animation setup: passed element and 0.0-1.0 animation progress.
// You can have as many custom animations in a note object as you want.
function animFade(ref, counter)
{
 //counter = Math.min(counter, 0.9); // Uncomment to make notes translucent.
 var f = ref.filters, done = (counter == 1);
 if (f)
 {
  if (!done && ref.style.filter.indexOf("alpha") == -1)
   ref.style.filter += ' alpha(opacity=' + (counter * 100) + ')';
  else if (f.length && f.alpha) with (f.alpha)
  {
   if (done) enabled = false;
   else { opacity = (counter * 100); enabled=true }
  }
 }
 else ref.style.opacity = ref.style.MozOpacity = counter*0.999;
};
supernote.animations[supernote.animations.length] = animFade;



// Optional custom note "close" button handler extension used in this example.
// This picks up click on CLASS="note-close" elements within CLASS="snb-pinned"
// notes, and closes the note when they are clicked.
// It can be deleted if you're not using it.
addEvent(document, 'click', function(evt)
{
 var elm = evt.target || evt.srcElement, closeBtn, note;

 while (elm)
 {
  if ((/note-close/).test(elm.className)) closeBtn = elm;
  if ((/snb-pinned/).test(elm.className)) { note = elm; break }
  elm = elm.parentNode;
 }

 if (closeBtn && note)
 {
  var noteData = note.id.match(/([a-z_\-0-9]+)-note-([a-z_\-0-9]+)/i);
  for (var i = 0; i < SuperNote.instances.length; i++)
   if (SuperNote.instances[i].myName == noteData[1])
   {
    setTimeout('SuperNote.instances[' + i + '].setVis("' + noteData[2] +
     '", false, true)', 100);
	cancelEvent(evt);
   }
 }
});


// Extending the script: you can capture mouse events on note show and hide.
// To get a reference to a note, use 'this.notes[noteID]' within a function.
// It has properties like 'ref' (the note element), 'trigRef' (its trigger),
// 'click' (whether its shows on click or not), 'visible' and 'animating'.
addEvent(supernote, 'show', function(noteID)
{
 // Do cool stuff here!
});
addEvent(supernote, 'hide', function(noteID)
{
 // Do cool stuff here!
});


// If you want draggable notes, feel free to download the "DragResize" script
// from my website http://www.twinhelix.com -- it's a nice addition :).

</script> 

<script type="text/javascript">
function checkrange(val)
{
	if(!((val >= 0.25) && (val <= 3)))
	{
		alert("Value should be inbetween 0.25 and 3.");
		document.frmLesson.price.value = '';
		document.frmLesson.price.focus();
		return false;
	}else
	{
		return true;
	}
}
</script>
<?php if($sf_user->isAuthenticated()): ?>
		<div id="top">
			<a id="create-account">Create an account</a>
			<div class="clear-both"></div>
		</div>
	
	
		<div class="body-main">
						
			<?php use_helper('Object') ?>
				<?php echo form_tag('experts_immediate_lesson/update',array('name' => 'frmLesson', 'onsubmit' => 'javascript: return checkrange(document.frmLesson.price.value);')) ?>
			
		
		<div class="box">
				<div class="top"></div>
				
				<?php // print_r($sf_user->getUser()->getRaykuUser()); ?>
				
				<?php echo object_input_hidden_tag($experts_immediate_lesson, 'getId') ?>
				<?php echo object_input_hidden_tag($experts_immediate_lesson, 'getUserId') ?>
				<div class="content">
					<div class="entry">
						<div class="ttle">Title</div>
						<div>
							<?php echo object_input_tag($experts_immediate_lesson, 'getTitle', array ('size' => 80,)) ?>
							<div class="information">
								Enter the title for immediate lesson! 
							</div>
						</div>
						<div class="spacer"></div>
					</div>
					<div class="entry">
						<div class="ttle">Description</div>
						<div class="clear-both"></div>
						<div>
							<?php echo object_textarea_tag($experts_immediate_lesson, 'getContent', array ('size' => '30x3',)) ?>
							<div class="information">
								Enter the content for immediate lesson! 
							</div>
						</div>
						<div class="spacer"></div>
					</div>
			  <div class="entry">
						<div class="ttle">Rate</div>
						
						<div style="clear:left">
							<?php echo object_input_tag($experts_immediate_lesson, 'getPrice', array ('class' => 'price', 'name' => 'price', 'id' => 'rate', 'onchange' => 'javascript: return checkrange(this.value);')) ?>
							<!--<input type="text" class="price" name="price" value="" onchange="" />-->
							<div class="per">$&nbsp;PER</div>
						   <select style=" background:#FFFFFF url(/images/rate.gif) no-repeat scroll 0 0; width:100px;" name="method">
							<option value="" selected="selected">Minute</option>
							</select>
							<div class="information">
								Enter cost per minute!
							</div>
							
							<div style="clear: both;">
						
						<?php if ($experts_immediate_lesson->getId()): ?>
							
							<?php //  echo submit_tag('update') ?>
							
							<input class="blue1" type="submit" name="commit" value="update" />
							
							&nbsp;<?php echo link_to('delete', 'experts_immediate_lesson/delete?id='.$experts_immediate_lesson->getId(),array('class' => 'blue1'),'post=true&confirm=Are you sure?') ?>
							&nbsp;<?php echo link_to('cancel', 'experts_immediate_lesson/show?id='.$experts_immediate_lesson->getId(),array('class' => 'blue1')) ?>
						
						<?php else: ?>
							<input type="submit" name="submit" value="submit" class="createlesson" />
							<!--<a class="createlesson" href="#" onclick="return checkrange(document.frmLesson.price.value); document.frmLesson.submit();">Create</a>-->
  							&nbsp;<?php echo link_to('cancel', 'experts_immediate_lesson/list',array('class' => 'blue1')) ?>
  						<?php endif; ?>
						
						</div>
							
				</div>
						<div class="spacer"></div>
						
						
						 
				  </div>
				</div>
							
				
				</form>
				<div class="bottom"></div>
			</div>
		   
			</div>
		<!--<div class="body-side">
			<div class="box">
				<div class="top"></div>
				<div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
					<div class="title" style="margin-top:0px;">About the process</div>
					<div class="text">First we do this, then we do that and then we do this. First we do this, then we do that and then we do this. First we do this, then we do that and then we do this. First we do this, then we do that and then we do this. First we do this, then we do that and then we do this. First we do this, then we do that and then we do this. First we do this, then we do that and then we do this. First we do this, then we do that and then we do this. </div>
				</div>
				<div class="bottom"></div>
			</div>
		</div>-->
<?php
	else:
	header('Location:'." http://".$_SERVER['HTTP_HOST']);
endif; ?>
