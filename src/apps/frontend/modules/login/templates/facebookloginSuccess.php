<link href="../css/style-reg-table.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="../styles/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="../styles/donny.css"  />
<script type="text/javascript">document.documentElement.className += " js";</script>

<div style="padding:35px 0 0 0"> <span style="background:url(../../../images/arrow-right.gif) no-repeat; padding-left:40px; margin-left:16px; color:#1C517C; font-size:20px; font-weight:bold">Create your account (step 2 of 2)</span>
  <div style="margin:18px 0 0 7px">
    <ul id="skip">
      <li><a href="#nav" accesskey="n">Skip to navigation [n]</a></li>
      <li><a href="#content" accesskey="c">Skip to content [c]</a></li>
      <li><a href="#footer" accesskey="f">Skip to footer [f]</a></li>
    </ul>
    <form name="register" method="post" action="/register/show" style="width:637px;float:left">
      <div id="root" class="table-a">
        <h3>Course Information (*IMPORTANT*) </h3>
        <div style="font-size:14px;color:#069;padding:25px"><strong>1. What is your Year of Study?</strong><br />
          <select name="course_year" id="course_year" style="padding:5px;margin-top:15px">
            <option value="" > Select </option>
            <option value="1">1st</option>
            <option value="2" >2nd</option>
            <option value="3" >3rd</option>
            <option value="4+" >4th+</option>
            <option value="graduated">graduated</option>
          </select>
        </div>
        <div style="font-size:14px;color:#069;padding:0 0 10px 25px"><strong>2. What Courses are you Taking?</strong></div><br />
        <fieldset>
          <legend>Course Information</legend>
          <table id="dataTable" summary="Description of this table.">
            <caption>
            Table with course information
            </caption>
            <tr>
              <th scope="col" class="first" style="color:#222">Subject</th>
              <th scope="col" style="color:#222">Course Name</th>
              <th scope="col" style="color:#222">Estimated Performance</th>
            </tr>
            <tr>
              <td class="first"><select name="course_subject[]" id="course_subject[]" style="padding:5px;">
                  <option value="">Select</option>
                  <option value="1" >Mathematics</option>
                  <option value="2" >English</option>
                  <option value="3" >Science</option>
                  <option value="4" >Business</option>
                </select></td>
              <td><p>
                  <input name="course_name[]" type="text" id="course_name[]" value="e.g. Introduction to Management..." size="30" maxlength="50" style="padding:5px" onBlur="if(this.value=='') this.value='e.g. Introduction to Management...';" onFocus="if(this.value=='e.g. Introduction to Management...') this.value='';"/>
                </p>
                <p style="font-size:10px;color:#999">(Your actual course name here)</p></td>
              <td><table width='100%' border='0' cellspacing='0' cellpadding='0' style='margin-right:10px'>
                  <tr>
                    <td align='center' style='border:0;padding:0'><label class="d"><span>D</span>
                        <input type="radio" name="grade[0]" id="grade[0]" value = "D"/>
                      </label></td>
                    <td align='center' style='border:0;padding:0'><label class="c"><span>C</span>
                        <input type="radio" name="grade[0]" id="grade[0]" value = "C" />
                      </label></td>
                    <td align='center' style='border:0;padding:0'><label class="b"><span>B</span>
                        <input type="radio" name="grade[0]" id="grade[0]" value = "B" />
                      </label></td>
                    <td align='center' style='border:0;padding:0'><label class="a"><span>A</span>
                        <input type="radio" name="grade[0]" id="grade[0]" value = "A" />
                      </label></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td class="first"><select name="course_subject[]" id="course_subject[]" style="padding:5px;">
                  <option value="">Select</option>
                  <option value="1" >Mathematics</option>
                  <option value="2" >English</option>
                  <option value="3" >Science</option>
                  <option value="4" >Business</option>
                </select></td>
              <td><p>
                  <input name="course_name[]" type="text" id="course_name[]" size="30" maxlength="50" style="padding:5px"/>
                </p>
                <p style="font-size:10px;color:#999">(Your actual course name here)</p></td>
              <td><table width='100%' border='0' cellspacing='0' cellpadding='0' style='margin-right:10px'>
                  <tr>
                    <td align='center' style='border:0;padding:0'><label class="d"><span>D</span>
                        <input type="radio" name="grade[1]" id="grade[1]" value = "D"/>
                      </label></td>
                    <td align='center' style='border:0;padding:0'><label class="c"><span>C</span>
                        <input type="radio" name="grade[1]" id="grade[1]" value = "C" />
                      </label></td>
                    <td align='center' style='border:0;padding:0'><label class="b"><span>B</span>
                        <input type="radio" name="grade[1]" id="grade[1]" value = "B" />
                      </label></td>
                    <td align='center' style='border:0;padding:0'><label class="a"><span>A</span>
                        <input type="radio" name="grade[1]" id="grade[1]" value = "A" />
                      </label></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td class="first"><select name="course_subject[]" id="course_subject[]" style="padding:5px;">
                  <option value="">Select</option>
                  <option value="1" >Mathematics</option>
                  <option value="2" >English</option>
                  <option value="3" >Science</option>
                  <option value="4" >Business</option>
                </select></td>
              <td><p>
                  <input name="course_name[]" type="text" id="course_name[]" size="30" maxlength="50" style="padding:5px"/>
                </p>
                <p style="font-size:10px;color:#999">(Your actual course name here)</p></td>
              <td><table width='100%' border='0' cellspacing='0' cellpadding='0' style='margin-right:10px'>
                  <tr>
                    <td align='center' style='border:0;padding:0'><label class="d"><span>D</span>
                        <input type="radio" name="grade[2]" id="grade[2]" value = "D"/>
                      </label></td>
                    <td align='center' style='border:0;padding:0'><label class="c"><span>C</span>
                        <input type="radio" name="grade[2]" id="grade[2]" value = "C" />
                      </label></td>
                    <td align='center' style='border:0;padding:0'><label class="b"><span>B</span>
                        <input type="radio" name="grade[2]" id="grade[2]" value = "B" />
                      </label></td>
                    <td align='center' style='border:0;padding:0'><label class="a"><span>A</span>
                        <input type="radio" name="grade[2]" id="grade[2]" value = "A" />
                      </label></td>
                  </tr>
                </table></td>
            </tr>
          </table>
        </fieldset>
      </div>
      <div id="error" style="color:#FF0000; font-size:12px; padding:5px 0 0 5px"></div>
      <div style="float:right">
        <input type="button" name="button2" id="button2" value="More Space" style="padding:6px;font-size:14px;margin-top:10px" onclick="addRow('dataTable')" />
        <input type="submit" value="Submit Form" style="padding:6px;font-size:14px;margin:10px;font-weight:bold" onClick = "return require()" />
      </div>
    </form>
    <div class="body-side" style="margin:-16px 0 0 0">
      <div class="box">
        <div class="top"></div>
        <div class="content" style="position:relative; _top:-3px; _bottom:-3px;">
          <div class="title" style="margin-top:0px; font-size:14px">Why is this Important?</div>
          <div class="text"><span style="font-size:13px;margin-top:5px;line-height:18px">Please fill in the  form on your right <strong>as concisely as possible</strong> with your current course information.<br />
            <br />
            This is because it will be directly used to better <strong>match you to the right experts, &amp; vise versa.</strong></span></div>
        </div>
        <div class="bottom"></div>
      </div>
    </div>
    <br class="clear-both" />
  </div>
</div>
<SCRIPT language="javascript">
	        function addRow(tableID) {
	 
	 
	 
	            var table = document.getElementById(tableID);
	            var rowCount = table.rows.length;
	            var row = table.insertRow(rowCount);
	
	
	
		   var newCount =  rowCount - 1;

	            var colCount = table.rows[2].cells.length;
	 
	            for(var i=0; i<colCount; i++) {
 
	                var newcell = row.insertCell(i);


			if(i == '2')
			{
				
			 table.rows[rowCount].cells[i].innerHTML = "<table width='100%' border='0' cellspacing='0' cellpadding='0' style='margin-right:10px'><tr><td align='center' style='border:0;padding:0'><label class='d'><input type='radio' name= grade[" + newCount + "] value='D'></label></td><td align='center' style='border:0;padding:0'><label class='c'><input type='radio' name= grade[" + newCount + "] value='C'></label></td><td align='center' style='border:0;padding:0'><label class='b'><input type='radio' name= grade[" + newCount + "] value='B'></label></td><td align='center' style='border:0;padding:0'><label class='a'><input  type='radio' name= grade[" + newCount + "] value='A'></label></td></tr></table>";

				newcell.innerHTML = table.rows[rowCount].cells[i].innerHTML;

			} else {
	                	newcell.innerHTML = table.rows[2].cells[i].innerHTML;
			}


	            }
        }
function require()
{


var subject = document.getElementById('course_subject[]').value;

var course = document.getElementById('course_name[]').value;

var year = document.getElementById('course_year').value;

var grade = document.getElementById('grade[0]').value;

	if(subject == '')
	{
			document.getElementById('error').style.display = "block";
			document.getElementById('error').innerHTML = 'Please enter at least one course entry.';
			return false;

	} else if(course == '') {

			document.getElementById('error').style.display = "block";
			document.getElementById('error').innerHTML = 'Please enter at least one course entry.';
			return false;
		
	}else if(year == '') {

			document.getElementById('error').style.display = "block";
			document.getElementById('error').innerHTML = 'Please enter at least one course entry.';
			return false;
		
	} else if(grade == '') {

			document.getElementById('error').style.display = "block";
			document.getElementById('error').innerHTML = 'Please enter at least one course entry.';
			return false;
		
	}

	

}
	       	    </SCRIPT> 
