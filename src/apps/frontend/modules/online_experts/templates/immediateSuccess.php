<?php use_helper('Javascript'); ?>
<style media="all" type="text/css">
	@import "/styles/ex_global.css";
	@import "/styles/ex_donny.css";
	@import "/styles/ex_supernote.css";

	.entry select {
		width:295px; height:40px;
		background:#fff url(/images/add-journal-view.gif) no-repeat;
		float:left;
		margin-right:5px;
		color:#3d3d3d;
		font:14px "Arial";
		border:0px;
		padding:11px 10px 10px 12px;
		}
	.dates {
		color:#8fafc8;
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
 <!-- SuperNote v1.0beta by Angus Turnbull htpp://www.twinhelix.com -->
 <script type="text/javascript" src="/js/supernote.js"></script>
 
 
 
<div id="top">
<div class="title" style="float:left">
<img src="/images/arrow-right.gif" alt="" />
<p>Checkout</p>
</div>

<div class="spacer"></div>
</div>


<div class="body-main">

<?php echo form_tag('online_experts/paypal'); ?>
<input type="hidden" name="expert_id" value="<?php echo $expert_id;?>" />
<input type="hidden" name="expert_immediate_lesson_id" value="<?php echo $expert_immediate_lesson_id; ?>" />
<input type="hidden" name="experts_price" value="<?php echo $expert_lesson->getPrice(); ?>" />
<input type="hidden" name="immediate" value="immediate" />

<div class="box">
		<div class="top"></div>
		<div class="content2">
			<div class="pname">Immediate 1-on-1 Help Plans</div>
			<div class="mfee">Rate/Minute</div>
			<div class="slct">Select</div>
			<div class="clear-both"></div>
			<div class="sep"></div>

			<div class="prs">
			<div class="pname"><?php echo $expert_lesson->getTitle(); ?></div>
			<div class="mfee">$<?php echo $expert_lesson->getPrice(); ?></div>
			<div class="slct"><input type="checkbox" name="lesson_checkout" value="lesson_checkout" /></div>
			<div class="clear-both"></div>
			</div>

			<div class="entry" style="margin-top:10px;"></div>
		</div>
		<div class="bottom"></div>
</div>


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

<div class="clear-both"></div>
<div class="clear-both"></div>
<div class="quick"></div>
<div class="spacer"></div>
<div class="box">
<div class="top"></div>
<div class="content2" style="padding:0 18px 10px 18px; width:601px " >
<h1>Information</h1>
This is an information box. You can add valuable information to the user so that he or she doesn't get lost. This is an information box. You can add valuable information to the user so that he or she doesn't get lost. This is an information box. You can add valuable information to the user so that he or she doesn't get lost.
</div>
<div class="bottom"></div>

<input type="submit" name="submit" value="submit" class="continuepp" />

<?php // echo link_to('Continue','online_experts/paypal',array('class' => 'continuepp')); ?>

<!--<a href="#" class="continuepp">Continue</a>-->

</div>

</form>

</div>

<div class="body-side">

<div class="box">
<div class="top"></div>
<div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
<img src="/images/vid.gif" alt="vid" width="250" />                                
</div>
<div class="bottom"></div>
</div>

<div class="box">
<div class="top"></div>
<div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
<h1>Order Summary</h1>
<div class="sep"></div>
<h2>Expert Lesson Plans</h2>
<div class="sep"></div>

<?php 
		$c= new Criteria();
		$c->add(ExpertLessonPeer::USER_ID,$expert_id);
		$expert_lessons=ExpertLessonPeer::doSelect($c);
		
		foreach($expert_lessons as $expert_lesson): 
		
?>

			<div class="ll"><?php echo $expert_lesson->getTitle(); ?></div>
			<div class="rr">$<?php echo $expert_lesson->getPrice(); ?></div>
			<div class="clear-both"></div>

	<?php endforeach; ?>


<div class="total">
<div class="ll"><strong>Monthly charge:</strong></div>
<div class="rr">$15.99</div>
<div class="clear-both"></div>
</div>

<div class="sep" style="margin:40px 0 5px 0;"></div>
<h2>Immediate 1-on-1 Help Plans</h2>
<div class="sep"></div>

	<?php 
		$c= new Criteria();
		$c->add(ExpertsImmediateLessonPeer::USER_ID,$expert_id);
		$expert_immediate_lessons=ExpertsImmediateLessonPeer::doSelect($c);
		
		foreach($expert_immediate_lessons as $expert_immediate_lesson):
		
			
?>

			<div class="ll"><?php echo $expert_immediate_lesson->getTitle(); ?></div>
			<div class="rr">$<?php echo $expert_immediate_lesson->getPrice(); ?></div>
			<div class="clear-both"></div>

	<?php endforeach; ?>



<div style="width:100%; border-bottom:1px dotted #a6a6a6; margin:20px 0;"></div>

<div class="total">
<div class="ll"><strong>Monthly charge <span>(1 month prepay)</span>:</strong></div>
<div class="rr">$15.99</div>
<div class="clear-both"></div>
</div>
<div class="total">
<div class="ll"><strong>Monthly charge:</strong></div>
<div class="rr">$15.99</div>
<div class="clear-both"></div>
</div>

</div>
<div class="bottom"></div>
</div>

<a href="#" class="checkout">Checkout</a>

<div class="clear-both"></div>

</div>