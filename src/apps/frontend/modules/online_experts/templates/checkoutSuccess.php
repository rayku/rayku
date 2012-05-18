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
<img src="<?php echo image_path('arrow-right.gif', false); ?>" alt="" />
<p>Checkout</p>
</div>

<div class="spacer"></div>
</div>


<div class="body-main">
<div class="box">
<div class="top"></div>
<div class="content2">
<div class="pname">Expert Lesson Plans</div>
<div class="mfee">Rate/Hour</div>
<div class="slct">Select</div>

<div class="clear-both"></div>
<div class="sep"></div>

<div class="prs">
<div class="pname"><?php echo $expert_lesson->getTitle(); ?></div>
<div class="mfee">$<?php echo $expert_lesson->getPrice(); ?></div>
<div class="slct"><input type="checkbox" name="lesson_checkout" value="lesson_checkout" /></div>
<div class="clear-both"></div>
</div>


<!--<div class="sep" style="margin:20px 0 5px 0;"></div>
<div class="pname">Immediate 1-on-1 Help Plans</div>
<div class="mfee">Rate/Minute</div>
<div class="slct">Select</div>

<div class="clear-both"></div>
<div class="sep"></div>

<div class="prs">
<div class="pname">English Literature Tutoring</div>
<div class="mfee">$15.99</div>
<div class="slct"><input type="checkbox" /></div>
<div class="clear-both"></div>
</div>

-->

<div class="entry" style="margin-top:10px;">


</div>
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
    	
    	$header = $monthName . (($showYear > 0) ? " " . $year : "");
		
		$s .="<div class=\"month2\"><h1>$header</h1>";
		$s .="<div class=\"calendar2\">";
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
					$s .= "<div class=\"days day last\">";	
				}
				else
				{
					$s .= "<div class=\"days day\">";       
    	        }
				
				if ($d > 0 && $d <= $daysInMonth)
    	        {
    	            $link = $this->getDateLink($d, $month, $year);
					$date = mktime(0, 0, 0, $month, $d, $year);
					
					
						if (in_array($d,$scheduleddays)) {
					
						$s .= "<div class=\"clickable blue\"><a class=\"supernote-click-demo{$month}{$d}{$year} dates\" href=\"#demo{$month}{$d}{$year}\">$d</a></div>";			
					
						}
						else
						{
														
							$s .= "<div class=\"days\"><a class=\"supernote-click-demo{$month}{$d}{$year} dates\" href=\"#demo{$month}{$d}{$year}\">$d</a></div>";					
						}		
					
								
    	        }
    	        else
    	        {
    	            $s .= "&nbsp;";
    	        }
      	        $s .="</div>";
				
				
				$s .= "<div id=\"supernote-note-demo{$month}{$d}{$year}\" class=\"snp-triggeroffset notedefault\" 
					  style=\"left:194px;
					  opacity:0.999;
					  top:423px;
					  -moz-background-clip:border;
					  -moz-background-inline-policy:continuous;
					  -moz-background-origin:padding;
					  background:transparent url(/images/baloon.png) no-repeat scroll 0 0;
					  color:#000000;
					  height:121px;
					  padding:10px 10px 10px 18px;
					  width:117px;\">";
				$s .= form_remote_tag(array(
					  'update'   => 'schedule',
					  'url'      => 'expert_lesson/schedule?date='.mktime(0,0,0,$month,$d,$year).'',
					  ),array(
					  'name' => "frmTimings{$month}{$d}{$year}",
					  ));
				
				$s .= "<a name=\"demo{$month}{$d}{$year}\"></a><h5>Hello!</h5>".					  
					  "<select multiple name=\"timing[]\" size=\"4\" style=\"font-weight: bold;\">";

				$s .= "<option value=\"0\" ".self::getSelected($d, $month, $year, 0)." >00:00AM-01:00AM</option>".
					  "<option value=\"1\" ".self::getSelected($d, $month, $year, 1)." >01:00AM-02:00AM</option>".
					  "<option value=\"2\" ".self::getSelected($d, $month, $year, 2)." >02:00AM-03:00AM</option>".
					  "<option value=\"3\" ".self::getSelected($d, $month, $year, 3)." >03:00AM-04:00AM</option>".
					  "<option value=\"4\" ".self::getSelected($d, $month, $year, 4)." >04:00AM-05:00AM</option>".
					  "<option value=\"5\" ".self::getSelected($d, $month, $year, 5)." >05:00AM-06:00AM</option>".
					  "<option value=\"6\" ".self::getSelected($d, $month, $year, 6)." >06:00AM-07:00AM</option>".
					  "<option value=\"7\" ".self::getSelected($d, $month, $year, 7)." >07:00AM-08:00AM</option>".
					  "<option value=\"8\" ".self::getSelected($d, $month, $year, 8)." >08:00AM-09:00AM</option>".
					  "<option value=\"9\" ".self::getSelected($d, $month, $year, 9)." >09:00AM-10:00AM</option>".
					  "<option value=\"10\" ".self::getSelected($d, $month, $year, 10)." >10:00AM-11:00AM</option>".
					  "<option value=\"11\" ".self::getSelected($d, $month, $year, 11)." >11:00AM-12:00PM</option>".
					  "<option value=\"12\" ".self::getSelected($d, $month, $year, 12)." >12:00PM-01:00PM</option>".
					  "<option value=\"13\" ".self::getSelected($d, $month, $year, 13)." >01:00PM-02:00PM</option>".
					  "<option value=\"14\" ".self::getSelected($d, $month, $year, 14)." >02:00PM-03:00PM</option>".
					  "<option value=\"15\" ".self::getSelected($d, $month, $year, 15)." >03:00PM-04:00PM</option>".
					  "<option value=\"16\" ".self::getSelected($d, $month, $year, 16)." >04:00PM-05:00PM</option>".
					  "<option value=\"17\" ".self::getSelected($d, $month, $year, 17)." >05:00PM-06:00PM</option>".
					  "<option value=\"18\" ".self::getSelected($d, $month, $year, 18)." >06:00PM-07:00PM</option>".
					  "<option value=\"19\" ".self::getSelected($d, $month, $year, 19)." >07:00PM-08:00PM</option>".
					  "<option value=\"20\" ".self::getSelected($d, $month, $year, 20)." >08:00PM-09:00PM</option>".
					  "<option value=\"21\" ".self::getSelected($d, $month, $year, 21)." >09:00PM-10:00PM</option>".
					  "<option value=\"22\" ".self::getSelected($d, $month, $year, 22)." >10:00PM-11:00PM</option>".
					  "<option value=\"23\" ".self::getSelected($d, $month, $year, 23)." >11:00PM-00:00AM</option>";
	
				$s .= "</select>";
					  
				
				$s .= submit_tag('', array('class' => 'bookin'));
					
				$s .= "</form>";
				$s .= "</div>";
  
        	    $d++;
    	    }
    	    $s .= "</div>";    
    	}
    	
    	$s .= "</div></div>";
    	
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


<h1 class="cal">Calendar</h1>
<h3 class="leg"><span>White = free</span> <span>Blue = booked</span></h3>
<div class="clear-both"></div>

<?php

			
						$m=date("m",$lesson_shedule->getDate());
											
						$y=date("Y",$lesson_shedule->getDate());

						$scheduled_current_days[]=date("d",$lesson_shedule->getDate());			
							
						

				
							$cal = new Calendar();
						
							$next1 = $m + 1;
							$next2 = $m + 2;
							
								
							echo $cal->getMonthHTML($m,$y,0,$scheduled_current_days);
										
							echo $cal->getMonthHTML($next1,$y,0,'');
										
							echo $cal->getMonthHTML($next2,$y,0,'');


?>


<div class="clear-both"></div>

<div class="quick">
<h3>Select days Quickly:</h3>


<?php $days=explode(',',$expert_lesson->getDay()); ?>
					
						
						
						<?php  foreach($days as $day) {
						
												
								if($day == 'mon') { $mon='mon'; }
								if($day == 'tue') { $tue='tue'; }
								if($day == 'wed') { $wed='wed'; }
								if($day == 'thur') { $thur='thur'; }
								if($day == 'fri') { $fri='fri'; }
								
						}
						
						?>
				
				<?php // object_checkbox_tag($expert_lesson,'getDay'); ?>
				
				<input type="checkbox" name="days[]" value="mon" <?php if($mon == 'mon') { ?> checked="checked" <?php } ?>/><label>Every Monday</label>
				<input type="checkbox" name="days[]" value="tue" <?php if($tue == 'tue') { ?> checked="checked" <?php } ?> /><label>Every Tuesday</label>
				<input type="checkbox" name="days[]" value="wed" <?php if($wed == 'wed') { ?> checked="checked" <?php } ?>/><label>Every Wednesday</label>
				<input type="checkbox" name="days[]" value="thur" <?php if($thur == 'thur') { ?> checked="checked" <?php } ?> /><label>Every Thursday</label>
				<input type="checkbox" name="days[]" value="fri" <?php if($fri == 'fri') { ?> checked="checked" <?php } ?> /><label>Every Friday</label>
				
				</div>

<div class="spacer"></div>

<div class="box">
<div class="top"></div>
<div class="content2" style="padding:0 18px 10px 18px; width:601px " >
<h1>Information</h1>
This is an information box. You can add valuable information to the user so that he or she doesn't get lost. This is an information box. You can add valuable information to the user so that he or she doesn't get lost. This is an information box. You can add valuable information to the user so that he or she doesn't get lost.
</div>
<div class="bottom"></div>

<a href="#" class="continuepp">Continue</a>
</div>
</div>
<div class="body-side">

<div class="box">
<div class="top"></div>
<div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
<img src="<?php echo image_path('vid.gif', false); ?>" alt="vid" width="250" />                                
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