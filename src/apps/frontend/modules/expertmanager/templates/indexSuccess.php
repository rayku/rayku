<?php use_helper('Javascript'); ?>
<script type="text/javascript" src="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/js/tabcontent.js"></script>
<script type="text/javascript" src="/js/supernote.js"></script> 
<script type="text/javascript">
function answer(id)
{
	var temp='answer_'+id;
	
	document.getElementById(temp).style.display = "block";
	
	return false;
}
</script>

<style media="all" type="text/css">
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
<?

// PHP Calendar Class Version 1.4 (5th March 2001)
//  
// Copyright David Wilkinson 2000 - 2001. All Rights reserved.
// 
// This software may be used, modified and distributed freely
// providing this copyright notice remains intact at the head 
// of the file.
//
// This software is freeware. The author accepts no liability for
// any loss or damages whatsoever incurred directly or indirectly 
// from the use of this script. The author of this software makes 
// no claims as to its fitness for any purpose whatsoever. If you 
// wish to use this software you should first satisfy yourself that 
// it meets your requirements.
//
// URL:   http://www.cascade.org.uk/software/php/calendar/
// Email: davidw@cascade.org.uk


class Calendar
{
    /*
        Constructor for the Calendar class
    */
    function Calendar($expertid = "", $expertlessonid = "")
    {
		$this->expertId = $expertid;
		$this->expertLessonId = $expertlessonid;
    }
    
    
    /*
        Get the array of strings used to label the days of the week. This array contains seven 
        elements, one for each day of the week. The first entry in this array represents Sunday. 
    */
    function getDayNames()
    {
        return $this->dayNames;
    }
    

    /*
        Set the array of strings used to label the days of the week. This array must contain seven 
        elements, one for each day of the week. The first entry in this array represents Sunday. 
    */
    function setDayNames($names)
    {
        $this->dayNames = $names;
    }
    
    /*
        Get the array of strings used to label the months of the year. This array contains twelve 
        elements, one for each month of the year. The first entry in this array represents January. 
    */
    function getMonthNames()
    {
        return $this->monthNames;
    }
    
    /*
        Set the array of strings used to label the months of the year. This array must contain twelve 
        elements, one for each month of the year. The first entry in this array represents January. 
    */
    function setMonthNames($names)
    {
        $this->monthNames = $names;
    }
    
    
    
    /* 
        Gets the start day of the week. This is the day that appears in the first column
        of the calendar. Sunday = 0.
    */
      function getStartDay()
    {
        return $this->startDay;
    }
    
    /* 
        Sets the start day of the week. This is the day that appears in the first column
        of the calendar. Sunday = 0.
    */
    function setStartDay($day)
    {
        $this->startDay = $day;
    }
    
    
    /* 
        Gets the start month of the year. This is the month that appears first in the year
        view. January = 1.
    */
    function getStartMonth()
    {
        return $this->startMonth;
    }
    
    /* 
        Sets the start month of the year. This is the month that appears first in the year
        view. January = 1.
    */
    function setStartMonth($month)
    {
        $this->startMonth = $month;
    }
    
    
    /*
        Return the URL to link to in order to display a calendar for a given month/year.
        You must override this method if you want to activate the "forward" and "back" 
        feature of the calendar.
        
        Note: If you return an empty string from this function, no navigation link will
        be displayed. This is the default behaviour.
        
        If the calendar is being displayed in "year" view, $month will be set to zero.
    */
    function getCalendarLink($month, $year)
    {
        return "";
    }
    
    /*
        Return the URL to link to  for a given date.
        You must override this method if you want to activate the date linking
        feature of the calendar.
        
        Note: If you return an empty string from this function, no navigation link will
        be displayed. This is the default behaviour.
    */
    function getDateLink($day, $month, $year)
    {
        return "javascript: getDate(".$day.",".$month.",".$year.",this.parentNode)";
    }


    /*
        Return the HTML for the current month
    */
    function getCurrentMonthView()
    {
        $d = getdate(time());
        return $this->getMonthView($d["mon"], $d["year"]);
    }
    

    /*
        Return the HTML for the current year
    */
    function getCurrentYearView()
    {
        $d = getdate(time());
        return $this->getYearView($d["year"]);
    }
    
    
    /*
        Return the HTML for a specified month
    */
    function getMonthView($month, $year)
    {
        return $this->getMonthHTML($month, $year);
    }
    

    /*
        Return the HTML for a specified year
    */
    function getYearView($year)
    {
        return $this->getYearHTML($year);
    }
    
    
    
    /********************************************************************************
    
        The rest are private methods. No user-servicable parts inside.
        
        You shouldn't need to call any of these functions directly.
        
    *********************************************************************************/


    /*
        Calculate the number of days in a month, taking into account leap years.
    */
    function getDaysInMonth($month, $year)
    {
        if ($month < 1 || $month > 12)
        {
            return 0;
        }
   
        $d = $this->daysInMonth[$month - 1];
   
        if ($month == 2)
        {
            // Check for leap year
            // Forget the 4000 rule, I doubt I'll be around then...
        
            if ($year%4 == 0)
            {
                if ($year%100 == 0)
                {
                    if ($year%400 == 0)
                    {
                        $d = 29;
                    }
                }
                else
                {
                    $d = 29;
                }
            }
        }
    
        return $d;
    }

	function getSelected($d, $month, $year, $slot)
	{
		$check_date = array();
		
		$c = new Criteria();
		$c->add(ExpertLessonSchedulePeer::DATE, mktime(0,0,0,$month,$d,$year));
		$c->add(ExpertLessonSchedulePeer::USER_ID, sfContext::getInstance()->getUser()->getRaykuUserId());
		
			
		$expert_schedule_all = ExpertLessonSchedulePeer::doSelect($c);
		
		$slots_total = array();
		
		foreach($expert_schedule_all as $expert_schedule)
		{
			$slots_total[] = array('expert_lesson_id' => $expert_schedule->getExpertLessonId(),
									'timings' => explode("|",$expert_schedule->getTimings()),
								);
		}
		
		$timings = array();
		
		/*echo '<pre>';
		print_r($slots_total);
		echo '</pre>';*/
		
		foreach($slots_total as $slots_single)
		{
			//echo "Preset ID--->".$slots_single['expert_lesson_id'];
			//echo "Current ID-->".sfContext::getInstance()->getUser()->getAttribute('expert_lesson_id');
			
			
		
			if($slots_single['expert_lesson_id'] == $this->expertLessonId)
			{
							
				if(in_array($slot, $slots_single['timings']))
				{
					return "class = \"red\"";
				}
			}
			else
			{
								
				if(in_array($slot, $slots_single['timings']))
				{
					return "class = \"red\"";
				}
			}	
		}
		
		return "";
	}
    /*
        Generate the HTML for a given month
    */
    function getMonthHTML($m, $y, $showYear = 1,$scheduleddays)
    {
        
			
		$s = "";
        
        $a = $this->adjustDate($m, $y);
        $month = $a[0];
        $year = $a[1];        
        
    	$daysInMonth = $this->getDaysInMonth($month, $year);
    	$date = getdate(mktime(12, 0, 0, $month, 1, $year));
    	
    	$first = $date["wday"];
    	$monthName = $this->monthNames[$month - 1];
    	
    	$prev = $this->adjustDate($month - 1, $year);
    	$next = $this->adjustDate($month + 1, $year);
    	
    	if ($showYear == 1)
    	{
    	    $prevMonth = $this->getCalendarLink($prev[0], $prev[1]);
    	    $nextMonth = $this->getCalendarLink($next[0], $next[1]);
    	}
    	else
    	{
    	    $prevMonth = "";
    	    $nextMonth = "";
    	}
    	
    	$header = $monthName .'&nbsp;&nbsp;&nbsp;'.$year;
		
		// $s .="<h1>$header</h1>";
		$s .="<div class=\"calendar\">";
		$s .="<div class=\"row\">";
		$s .="<div class=\"day\">" . $this->dayNames[($this->startDay)%7] . "</div>";
		$s .="<div class=\"day\">" . $this->dayNames[($this->startDay+1)%7] . "</div>";
		$s .="<div class=\"day\">" . $this->dayNames[($this->startDay+2)%7] . "</div>";
		$s .="<div class=\"day\">" . $this->dayNames[($this->startDay+3)%7] . "</div>";
		$s .="<div class=\"day\">" . $this->dayNames[($this->startDay+4)%7] . "</div>";
		$s .="<div class=\"day\">" . $this->dayNames[($this->startDay+5)%7] . "</div>";
		$s .="<div class=\"day last\">" . $this->dayNames[($this->startDay+6)%7] . "</div>";
		$s .="</div>";
				
		

    	
    	// We need to work out what date to start at so that the first appears in the correct column
    	$d = $this->startDay + 1 - $first;
    	while ($d > 1)
    	{
    	    $d -= 7;
    	}

        // Make sure we know when today is, so that we can use a different CSS style
        $today = getdate(time());
    	
    	while ($d <= $daysInMonth)
    	{
    	    $s .= "<div class=\"row\">";       
    	    
			$count = 1 ;
			
    	    for ($i = 0; $i < 7; $count++, $i++)
    	    {
        	    $class = ($year == $today["year"] && $month == $today["mon"] && $d == $today["mday"]) ? "calendarToday" : "calendar";
    	        
				
				if($count%7 == 0)
				{
					$s .= "<div class=\"day last\">";	
				}
				else
				{
					$s .= "<div class=\"day\">";       
    	        }
				
				if ($d > 0 && $d <= $daysInMonth)
    	        {
    	            $link = $this->getDateLink($d, $month, $year);
					$date = mktime(0, 0, 0, $month, $d, $year);
					
					
						if (in_array($d,$scheduleddays)) 
						{
					
						$s .= "<div class=\"day clickable blue\" style=\"padding-top:2px 2px 2px 2px;\">$d</div>";			
					
						}
						else
						{
														
							$s .= "<div class=\"day\">$d</div>";					
						}		
					
								
    	        }
    	        else
    	        {
    	            $s .= "&nbsp;";
    	        }
				
      	        $s .="</div>";
				
        	    $d++;
    	    }
    	    $s .= "</div>";    
    	}
    	
    	$s .= "</div>";
    	
    	return $s;  	
    }
    
    
    /*
        Generate the HTML for a given year
    */
    function getYearHTML($year)
    {
        $s = "";
    	$prev = $this->getCalendarLink(0, $year - 1);
    	$next = $this->getCalendarLink(0, $year + 1);
        
        $s .= "<table class=\"calendar\" border=\"0\">\n";
        $s .= "<tr>";
    	$s .= "<td align=\"center\" valign=\"top\" align=\"left\">" . (($prev == "") ? "&nbsp;" : "<a href=\"$prev\">&lt;&lt;</a>")  . "</td>\n";
        $s .= "<td class=\"calendarHeader\" valign=\"top\" align=\"center\">" . (($this->startMonth > 1) ? $year . " - " . ($year + 1) : $year) ."</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" align=\"right\">" . (($next == "") ? "&nbsp;" : "<a href=\"$next\">&gt;&gt;</a>")  . "</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(0 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(1 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(2 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(3 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(4 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(5 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(6 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(7 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(8 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(9 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(10 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(11 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "</tr>\n";
        $s .= "</table>\n";
        
        return $s;
    }

    /*
        Adjust dates to allow months > 12 and < 0. Just adjust the years appropriately.
        e.g. Month 14 of the year 2001 is actually month 2 of year 2002.
    */
    function adjustDate($month, $year)
    {
        $a = array();  
        $a[0] = $month;
        $a[1] = $year;
        
        while ($a[0] > 12)
        {
            $a[0] -= 12;
            $a[1]++;
        }
        
        while ($a[0] <= 0)
        {
            $a[0] += 12;
            $a[1]--;
        }
        
        return $a;
    }

    /* 
        The start day of the week. This is the day that appears in the first column
        of the calendar. Sunday = 0.
    */
    var $startDay = 0;

    /* 
        The start month of the year. This is the month that appears in the first slot
        of the calendar in the year view. January = 1.
    */
    var $startMonth = 1;

    /*
        The labels to display for the days of the week. The first entry in this array
        represents Sunday.
    */
    var $dayNames = array("S", "M", "T", "W", "T", "F", "S");
    
    /*
        The labels to display for the months of the year. The first entry in this array
        represents January.
    */
    var $monthNames = array("January", "February", "March", "April", "May", "June",
                            "July", "August", "September", "October", "November", "December");
                            
                            
    /*
        The number of days in each month. You're unlikely to want to change this...
        The first entry in this array represents January.
    */
    var $daysInMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    
}

?>




   

	<div class="body-main">
		<div id="what-is">
			<div style="width:30px; float:left;">
				<img src="../../../images/green_arrow.jpg" width="42" height="25" alt="" />
			</div>
			<p style="font-size:16px; color:#1c517c; font-weight:bold; margin-left:55px;">
				Welcome <?php echo $sf_user->getRaykuUser()->getUsername(); ?>
				<!--<span style="margin-left: 10px; font-size: 15px; color: #A1A1A1; font-weight: normal;">(username)</span>-->
			</p>
		</div>
		<div class="left-bg">
			<div class="left-top"></div>
				<a href="#" class="avatar"><img src="../../../images/default-avatar.jpg" /></a>
				<div class="rightContent">
					<p class="currentlyFollowing">You're currently following:</p>
					<ul>
						<li>- 18 Classrooms, spread out between 10 teachers</li>
						<li>- 136 Friends, 72 which you met on Rayku</li>
						<li>- 12 Groups which include things you like</li>
					</ul>
					<a href="#" style="margin-right: 55px;"><img src="../../../images/dash-add-photos.png" /></a>
					<a href="#" style="margin-right: 55px;"><img src="../../../images/dash-add-videos.png" /></a>
				</div>
			<div class="left-bottom"></div>
		</div>
		<!--<a href="#" class="rss-subscribe"><img src="../../../images/rss-subscribe.png" /></a>-->
		
		<?php  echo link_to( image_tag( "http://www.rayku.com/images/rss-subscribe.png",
                                   array( 'class' => "rss-subscribe" )),
                        'rss/index?id='.$sf_user->getRaykuUser()->getId(), array( 'target' => '_blank' ) );
						
		?>
		
		<h3>Active Tutor Lessons</h3>
		
		<?php if($lessons != NULL): ?>
		
		<div class="pbox">
			<div class="top">
				<div class="name">Name</div>
				<div class="schedule">Scheduled Time / Date</div>
		  </div>
			
			<?php  
			$count = 0;
			
			foreach($lessons as $expert_lesson): ?>
			
				<?php 
						$c=new Criteria();
						$c->add(ExpertLessonSchedulePeer::EXPERT_LESSON_ID,$expert_lesson->getId());
						$c->setLimit('1');
						$schedules=ExpertLessonSchedulePeer::doSelect($c);
				?>
			
			<div class="<?php echo ($count++%2 == 0)?"light":"dark"; ?>">
				<div class="name"><?php echo $expert_lesson->getTitle(); ?></div>
				<div class="schedule"><?php echo $expert_lesson->getDay(); ?>
				
					<?php foreach($schedules as $schedule):
								
								$values=explode("|",$schedule->getTimings());
								
								 global $oldstartkey,$oldendkey;
								 $oldendkey = -1;
								 $firsttime=1;
								 $end = '';
								 $display ='';
								 foreach($values as $key) 
								 {
										if($firsttime==1) 
										{
												$startkey = $key;
												$endkey = $key+1;
										} 
										else 
										{
												if($key==$oldendkey) 
												{ 
													$startkey = $oldstartkey;
													$endkey = $key+1;
													$display=0;
												} 
												else 
												{ 
													$display = 1;
													$displaystart = $oldstartkey;
													$displayend = $oldendkey;
													
												}
										}
										if($end==24||($display==1&&$firsttime==0)) 
										{
											
											if($displaystart == '0') { $displaystart = '0am';}
											if($displaystart == '1') {  $displaystart = '1am';}
											if($displaystart == '2') { $displaystart = '2am'; }
											if($displaystart == '3') { $displaystart = '3am'; }
											if($displaystart == '4') { $displaystart = '4am'; }
											if($displaystart == '5') { $displaystart = '5am'; }
											if($displaystart == '6') { $displaystart = '6am'; }
											if($displaystart == '7') { $displaystart = '7am'; }
											if($displaystart == '8') { $displaystart = '8am'; }
											if($displaystart == '9') { $displaystart = '9am'; }
											if($displaystart == '10') { $displaystart = '10am'; }
											if($displaystart == '11') { $displaystart = '11am'; }
											if($displaystart == '12') { $displaystart = '12pm'; }
											if($displaystart == '13') { $displaystart = '1pm'; }
											if($displaystart == '14') { $displaystart = '2pm'; }
											if($displaystart == '15') { $displaystart = '3pm'; }
											if($displaystart == '16') { $displaystart = '4pm'; }
											if($displaystart == '17') { $displaystart = '5pm'; }
											if($displaystart == '18') { $displaystart = '6pm'; }
											if($displaystart == '19') { $displaystart = '7pm'; }
											if($displaystart == '20') { $displaystart = '8pm'; }
											if($displaystart == '21') { $displaystart = '9pm'; }
											if($displaystart == '22') { $displaystart = '10pm'; }
											if($displaystart == '23') { $displaystart = '11pm'; } 
											
											
											if($displayend == '0') { $displayend = '0am';}
											if($displayend == '1') {  $displayend = '1am';}
											if($displayend == '2') { $displayend = '2am'; }
											if($displayend == '3') { $displayend = '3am'; }
											if($displayend == '4') { $displayend = '4am'; }
											if($displayend == '5') { $displayend = '5am'; }
											if($displayend == '6') { $displayend = '6am'; }
											if($displayend == '7') { $displayend = '7am'; }
											if($displayend == '8') { $displayend = '8am'; }
											if($displayend == '9') { $displayend = '9am'; }
											if($displayend == '10') { $displayend = '10am'; }
											if($displayend == '11') { $displayend = '11am'; }
											if($displayend == '12') { $displayend = '12pm'; }
											if($displayend == '13') { $displayend = '1pm'; }
											if($displayend == '14') { $displayend = '2pm'; }
											if($displayend == '15') { $displayend = '3pm'; }
											if($displayend == '16') { $displayend = '4pm'; }
											if($displayend == '17') { $displayend = '5pm'; }
											if($displayend == '18') { $displayend = '6pm'; }
											if($displayend == '19') { $displayend = '7pm'; }
											if($displayend == '20') { $displayend = '8pm'; }
											if($displayend == '21') { $displayend = '9pm'; }
											if($displayend == '22') { $displayend = '10pm'; }
											if($displayend == '23') { $displayend = '11pm'; }
											if($displayend == '24') { $displayend = '11pm'; }
											
											
											echo "(".$displaystart."-".$displayend.")";
											
											$oldstartkey = $key;
											$oldendkey = $key+1;
											
										} 
										else 
										{
											$firsttime = 0;
											
											$oldstartkey = $startkey;
											$oldendkey = $endkey;
											
										}
										
																			
								 } 
								 
								 			if($oldstartkey == '0') { $oldstartkey = '0am';}
											if($oldstartkey == '1') {  $oldstartkey = '1am';}
											if($oldstartkey == '2') { $oldstartkey = '2am'; }
											if($oldstartkey == '3') { $oldstartkey = '3am'; }
											if($oldstartkey == '4') { $oldstartkey = '4am'; }
											if($oldstartkey == '5') { $oldstartkey = '5am'; }
											if($oldstartkey == '6') { $oldstartkey = '6am'; }
											if($oldstartkey == '7') { $oldstartkey = '7am'; }
											if($oldstartkey == '8') { $oldstartkey = '8am'; }
											if($oldstartkey == '9') { $oldstartkey = '9am'; }
											if($oldstartkey == '10') { $oldstartkey = '10am'; }
											if($oldstartkey == '11') { $oldstartkey = '11am'; }
											if($oldstartkey == '12') { $oldstartkey = '12pm'; }
											if($oldstartkey == '13') { $oldstartkey = '1pm'; }
											if($oldstartkey == '14') { $oldstartkey = '2pm'; }
											if($oldstartkey == '15') { $oldstartkey = '3pm'; }
											if($oldstartkey == '16') { $oldstartkey = '4pm'; }
											if($oldstartkey == '17') { $oldstartkey = '5pm'; }
											if($oldstartkey == '18') { $oldstartkey = '6pm'; }
											if($oldstartkey == '19') { $oldstartkey = '7pm'; }
											if($oldstartkey == '20') { $oldstartkey = '8pm'; }
											if($oldstartkey == '21') { $oldstartkey = '9pm'; }
											if($oldstartkey == '22') { $oldstartkey = '10pm'; }
											if($oldstartkey == '23') { $oldstartkey = '11pm'; } 
											
											
											if($oldendkey == '0') { $oldendkey = '0am';}
											if($oldendkey == '1') {  $oldendkey = '1am';}
											if($oldendkey == '2') { $oldendkey = '2am'; }
											if($oldendkey == '3') { $oldendkey = '3am'; }
											if($oldendkey == '4') { $oldendkey = '4am'; }
											if($oldendkey == '5') { $oldendkey = '5am'; }
											if($oldendkey == '6') { $oldendkey = '6am'; }
											if($oldendkey == '7') { $oldendkey = '7am'; }
											if($oldendkey == '8') { $oldendkey = '8am'; }
											if($oldendkey == '9') { $oldendkey = '9am'; }
											if($oldendkey == '10') { $oldendkey = '10am'; }
											if($oldendkey == '11') { $oldendkey = '11am'; }
											if($oldendkey == '12') { $oldendkey = '12pm'; }
											if($oldendkey == '13') { $oldendkey = '1pm'; }
											if($oldendkey == '14') { $oldendkey = '2pm'; }
											if($oldendkey == '15') { $oldendkey = '3pm'; }
											if($oldendkey == '16') { $oldendkey = '4pm'; }
											if($oldendkey == '17') { $oldendkey = '5pm'; }
											if($oldendkey == '18') { $oldendkey = '6pm'; }
											if($oldendkey == '19') { $oldendkey = '7pm'; }
											if($oldendkey == '20') { $oldendkey = '8pm'; }
											if($oldendkey == '21') { $oldendkey = '9pm'; }
											if($oldendkey == '22') { $oldendkey = '10pm'; }
											if($oldendkey == '23') { $oldendkey = '11pm'; }
											if($oldendkey == '24') { $oldendkey = '11pm'; }
								 
								 echo "(".$oldstartkey."-".$oldendkey.")";	
								
						  endforeach;
					 ?>
				
				</div>
				
				<div class="hist"><?php echo link_to('History','expertmanager/history?less_id='.$expert_lesson->getId().'',array('class' => 'history')); ?></div>
				
			</div>
			
			<?php endforeach; ?>
			
			<!--<div class="light">
				<div class="name">Mathematics</div>
				<div class="schedule">Mon, Wed & Fri  (4pm-5pm)</div>
				<div class="hist"><a class="history" href="#">History</a></div>
			</div>
			<div class="dark">
				<div class="name">Mathematics</div>
				<div class="schedule">Mon, Wed & Fri  (4pm-5pm)</div>
				<div class="hist"><a class="history" href="#">History</a></div>
			</div>-->
			
			
			<div class="bot"></div>
		</div><!--pbox-->
		
		<?php else : ?>
		
			<p style="font-size:12px; font-family:verdana; color:#000000; font-weight:bold; padding-left:30px; padding-top:5px; padding-bottom:20px;">No active tutor lessons created yet! </p>
	
	<?php endif;?>
		
		<h3>Immediate Lessons</h3>
		
		<?php if($immlessons != NULL): ?>
		
			<div class="pbox">
				<div class="top">
					<div class="name">Name</div>
					<div class="schedule">Description</div>
					<div class="price">Pricing</div>
			  </div>
				
				<?php  
			
				foreach($immlessons as $immlesson): ?>
				
								
				<div class="<?php echo ($count++%2 == 0)?"light":"dark"; ?>">
					<div class="name"><?php echo $immlesson->getTitle(); ?></div>
					<div class="schedule"><?php echo $immlesson->getContent(); ?></div>
					<div class="price">$<?php echo $immlesson->getPrice(); ?> / Minute</div>
					
				</div>
				
				<?php endforeach; ?>
				
				
				<div class="bot"></div>
			</div><!--pbox-->
		
		
		<?php else : ?>
		
			<p style="font-size:12px; font-family:verdana; color:#000000; font-weight:bold; padding-left:30px; padding-top:5px;">No immediate lessons created yet! </p>
	
	<?php endif;?>	


<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="country1" class="selected">ANSWERED</a></li>
<li><a href="#" rel="country2">UN-ANSWERED</a></li>
<li><a href="#" rel="country3">SELF-ANSWERED</a></li>
</ul>
<div class="clear-both"></div>


<div id="country1" class="tabcontent">
		<div class="box">
			<div class="top"></div>
			<div class="content">
				<div class="entry">
					<ul class="questions">
						
						 <?php $i=0; ?>
						<?php foreach($questions as $question) : ?>
					
								<?php 

									if($i < 10) :
									
										$c=new Criteria();
										$c->add(PostPeer::THREAD_ID,$question->getId());
										$c->add(PostPeer::CREATED_AT,$question->getCreatedAt(),Criteria::NOT_EQUAL);
										$c->add(PostPeer::BEST_RESPONSE,'1');
										$answers=PostPeer::doSelect($c);
							
								?>
						
										<?php if($answers != NULL): ?>
										
										<li><?php echo link_to($question->getTitle(), '@view_thread?thread_id='.$question->getId()) ; ?> </li>
								
										<?php  $i++; ?>
										
										<?php endif; ?>
										
									<?php endif; ?>
								
						<?php endforeach; ?>						
						
						<div class="clear-both"></div>
					</ul>
				</div>
			</div>
			<div class="bottom"></div>
		</div>
</div>

<div id="country2" class="tabcontent">
		<div class="box">
			<div class="top"></div>
			<div class="content">
				<div class="entry">
					<ul class="questions">
					
					 <?php $j=0; ?>
					<?php foreach($questions as $question) : ?>
												
								<?php 

										if($j < 10) :
									
									$c=new Criteria();
									$c->add(PostPeer::THREAD_ID,$question->getId());
									$c->add(PostPeer::CREATED_AT,$question->getCreatedAt(),Criteria::NOT_EQUAL);
									$c->add(PostPeer::BEST_RESPONSE,'1');
									$answers=PostPeer::doCount($c);
							
								?>
						
										<?php 
										 if($answers < '1'): ?>
										
										<li> <?php echo link_to($question->getTitle(), '@view_thread?thread_id='.$question->getId()) ; ?> </li>
								
										<?php $j++; ?>
										
										<?php  endif; ?>
								
								<?php endif; ?>
							
					<?php endforeach; ?>
					
					<div class="clear-both"></div>
					</ul>
				</div>
			</div>
			<div class="bottom"></div>
		</div></div>

<div id="country3" class="tabcontent">
		<div class="box">
			<div class="top"></div>
			<div class="content">
				<div class="entry">
					<ul class="questions">
				
					<?php foreach($questions as $question) : ?>
					
								<?php 

									$c=new Criteria();
									$c->add(PostPeer::THREAD_ID,$question->getId());
									$c->add(PostPeer::POSTER_ID,$sf_user->getRaykuUserId());
									$c->add(PostPeer::CREATED_AT,$question->getCreatedAt(),Criteria::NOT_EQUAL);
									$answers=PostPeer::doSelect($c);
							
								?>
						
								<?php if($answers != NULL): ?>
								
								<li><?php echo link_to($question->getTitle(), '@view_thread?thread_id='.$question->getId()) ; ?> </li>
						
								<?php endif; ?>
							
					<?php endforeach; ?>
					
						 <div class="clear-both"></div>
					</ul>
				</div>
			</div>
			<div class="bottom"></div>
		</div></div>



<script type="text/javascript">

var countries=new ddtabcontent("countrytabs")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>

	
	</div>
	
	
	<div class="body-side">
		<div class="box">
			<div class="top"></div>
			<div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
				<div class="text">
					<h1 class="tit">Calendar of <?php echo date('F').'&nbsp;'.date('Y'); ?></h1>

					<div class="calendar">
							
					
						<?php 
						
						
						$scheduled_current_days = array();
						 
						foreach($lessondates as $lessondate)
						{
							if( (date('m') ==  date('m',$lessondate->getDate())) && (date('Y') ==  date('Y',$lessondate->getDate()) ) )
							{
								$scheduled_current_days[] = date('d',$lessondate->getDate()); 
							}
						}
						
					 																		
					   foreach($lessondays as $lessonday)
					   {
								if($lessonday->getMonday() == '1')
								{
									  
									  $week = 0;
									  $day = 0;
									  $i = 1;
									  $month = date('m');
								  	  $year = date('Y');
									  
									  $newyear = $year;
									  $newmonth= $month;
									  
										while ($week != 1) 
										{
											$day++;
											$week = date("w", mktime(0, 0, 0, $month,$day, $year));
										}
								  
										array_push($scheduled_current_days,date("d", mktime(0, 0, 0, $month,$day, $year)));
									  
										while ($newyear == $year && $newmonth == $month ) 
										{
											$test =  strtotime(date("r", mktime(0, 0, 0, $month,$day, $year)) . "+" . $i . " week");
											$i++;
											if ($year == date("Y",$test) && ($month == date("m",$test) ) ) 
											{
											  array_push($scheduled_current_days,date("d", $test));
											}
											$newyear = date("Y",$test); 
											$newmonth = date('m', $test);
										}	
								}
							
							    elseif($lessonday->getTuesday() == '1')
								{
									  $week = 0;
									  $day = 0;
									  $i = 1;
									  $month = date('m');
								 	  $year = date('Y');
									  
									  $newyear = $year;
									  $newmonth= $month;
									  
										while ($week != 1) 
										{
											$day++;
											$week = date("w", mktime(0, 0, 0, $month,$day-1, $year));
										}
								  
										array_push($scheduled_current_days,date("d", mktime(0, 0, 0, $month,$day, $year)));
								
										while ($newyear == $year && $newmonth == $month ) 
										{
											$test =  strtotime(date("r", mktime(0, 0, 0, $month,$day, $year)) . "+" . $i . "week");
											$i++;
											if ($year == date("Y",$test) && ($month == date("m",$test) ) ) 
											{
											  array_push($scheduled_current_days,date("d", $test));
											}
											$newyear = date("Y",$test); 
											$newmonth = date('m', $test);
										}
								}
							
								elseif($lessonday->getWednesday() == '1')
								{
								
								  $week = 0;
								  $day = 0;
								  $i = 1;
								  $month = date('m');
								  $year = date('Y');
								
								
									 $newyear = $year;
									 $newmonth= $month;
								  
									while ($week != 1) 
									{
										$day++;
										$week = date("w", mktime(0, 0, 0, $month,$day-2, $year));
									}
							  
									array_push($scheduled_current_days,date("d", mktime(0, 0, 0, $month,$day, $year)));
								  
									while ($newyear == $year && $newmonth == $month ) 
									{
										$test =  strtotime(date("r", mktime(0, 0, 0, $month,$day, $year)) . "+" . $i . "week");
										$i++;
										if ($year == date("Y",$test) && ($month == date("m",$test) ) ) 
										{
										  array_push($scheduled_current_days,date("d", $test));
										}
										$newyear = date("Y",$test); 
										$newmonth = date('m', $test);
									}
								}

								elseif($lessonday->getThursday() == '1')
								{								

								$week = 0;
							    $day = 0;
							    $i = 1;
							    $month = date('m');
							    $year = date('Y');
								
								  $newyear = $year;
								  $newmonth= $month;
										  
									while ($week != 1) 
									{
										$day++;
										$week = date("w", mktime(0, 0, 0, $month,$day-3, $year));
									}
							  
									array_push($scheduled_current_days,date("d", mktime(0, 0, 0, $month,$day, $year)));
								  
									while ($newyear == $year && $newmonth == $month ) 
									{
										$test =  strtotime(date("r", mktime(0, 0, 0, $month,$day, $year)) . "+" . $i . "week");
										$i++;
										if ($year == date("Y",$test) && ($month == date("m",$test) ) ) 
										{
										  array_push($scheduled_current_days,date("d", $test));
										}
										$newyear = date("Y",$test); 
										$newmonth = date('m', $test);
									}	
										
								}
							else if($lessonday->getFriday() == '1')
							{
									  $week = 0;
									  $day = 0;
									  $i = 1;
									  $month = date('m');
									  $year = date('Y');
									  
									  $fridays = array();
									  $newyear = $year;
									  $newmonth= $month;
									  
									while ($week != 1) 
									{
										$day++;
										$week = date("w", mktime(0, 0, 0, $month,$day-4, $year));
									}
							  
									array_push($scheduled_current_days,date("d", mktime(0, 0, 0, $month,$day, $year)));
								  
									while ($newyear == $year && $newmonth == $month ) 
									{
										$test =  strtotime(date("r", mktime(0, 0, 0, $month,$day, $year)) . "+" . $i . "week");
										$i++;
										if ($year == date("Y",$test) && ($month == date("m",$test) ) ) 
										{
										  array_push($scheduled_current_days,date("d", $test));
										}
										$newyear = date("Y",$test); 
										$newmonth = date('m', $test);
									}

								}
							
								elseif($lessonday->getSaturday() == '1')
								{
								
								$week = 0;
							    $day = 0;
							    $i = 1;
							    $month = date('m');
							    $year = date('Y');
									  
									  $newyear = $year;
									  $newmonth= $month;
									  
										while ($week != 1) 
										{
											$day++;
											$week = date("w", mktime(0, 0, 0, $month,$day-5, $year));
										}
								  
										array_push($scheduled_current_days,date("d", mktime(0, 0, 0, $month,$day, $year)));
									  
										while ($newyear == $year && $newmonth == $month ) 
										{
											$test =  strtotime(date("r", mktime(0, 0, 0, $month,$day, $year)) . "+" . $i . "week");
											$i++;
											if ($year == date("Y",$test) && ($month == date("m",$test) ) ) 
											{
											  array_push($scheduled_current_days,date("d", $test));
											}
											$newyear = date("Y",$test); 
											$newmonth = date('m', $test);
											
										}
								}
							
								else if($lessonday->getSunday() == '1')
								{
									  $week = 0;
									  $day = 0;
									  $i = 1;
									  $month = date('m');
									  $year = date('Y');
									  
									  $newyear = $year;
									  $newmonth= $month;
									  
									while ($week != 1) 
									{
										$day++;
										$week = date("w", mktime(0, 0, 0, $month,$day-6, $year));
									}
							  
									array_push($scheduled_current_days,date("d", mktime(0, 0, 0, $month,$day, $year)));
								  
									while ($newyear == $year && $newmonth == $month ) 
									{
										$test =  strtotime(date("r", mktime(0, 0, 0, $month,$day, $year)) . "+" . $i . "week");
										$i++;
										if ($year == date("Y",$test) && ($month == date("m",$test) ) ) 
										{
										  array_push($scheduled_current_days,date("d", $test));
										}
										$newyear = date("Y",$test); 
										$newmonth = date('m', $test);		
									}
								}
						
						}
						
						$cal = new Calendar();	
						$m = date("m");
						$y=date("Y");
						echo $cal->getMonthHTML($m,$y,0,$scheduled_current_days);

						?>
					</div>
				</div>
			</div>
			<div class="bottom"></div>

		</div>
		<?php 					 

					 $a=new Criteria();
					 $a->add(UserPeer::ID,$sf_user->getRaykuUserId());
					 $user =UserPeer::doSelectOne($a);

				
		 ?>




		<!--<a href="#" class="navlink next">Expert's Lesson Creation</a>-->
		<?php echo link_to('Expert&rsquo;s Calendar', 'expert_lesson/calendar',array('class' => 'navlink next')); ?>
		
		<?php echo link_to('Expert&rsquo;s Lesson Creation', 'expert_lesson/create',array('class' => 'navlink next')); ?>
		<!--<a href="#" class="navlink next">Expert's portfolio</a>
		<?php echo link_to('Expert&rsquo;s portfolio', 'expertmanager/portfolio/'.$user->getUsername(),array('class' => 'navlink next')); ?>-->

		<a href="http://www.rayku.com/expertmanager/portfolio/<?php echo $user->getUsername(); ?> " class="navlink next" >Expert's portfolio</a>
		
		<?php echo link_to('Expert&rsquo;s Immediate Lesson Creation', 'experts_immediate_lesson/create',array('class' => 'navlink next')); ?>
		
		<?php echo link_to('Expert&rsquo;s payout page','payout/payout',array('class' => 'navlink next')); ?>
		
		<?php echo link_to('Expert&rsquo;s Categories','profile/categories?userid='.$sf_user->getRaykuUserId().'',array('class' => 'navlink next')); ?>
		
		<?php echo link_to('Go for online chat','online_experts/chat',array('class' => 'navlink next')); ?> 
		
		 		<?php echo link_to('Chat History','online_experts/chathistory', array('class' => 'navlink next')); ?>

		<?php echo link_to('Expert&rsquo;s Tutorial','expertmanager/tutorial',array('class' => 'navlink next')); ?>
				
		<?php echo link_to('Listing all experts', 'expertmanager/list',array('class' => 'navlink next')); ?>
		
</div>
