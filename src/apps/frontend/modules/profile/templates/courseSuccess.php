		<link href="/css/style-reg-table.css" rel="stylesheet" type="text/css" media="screen" />
		<link rel="stylesheet" type="text/css" href="/styles/print.css" media="print" />
        <link rel="stylesheet" type="text/css" href="/styles/donny.css"  />
		<script type="text/javascript">document.documentElement.className += " js";</script>
        
        <div style="padding:48px 7px 0 7px">

        <div style="margin-top:22px">
<?php $userName = explode("/", $_SERVER['REDIRECT_URL']); ?>

		<form name="register" method="post" action="/profile/show/name/<?php echo $userName[4]; ?>">
		<div id="root" class="table-a">
			<h3>Course Information </h3>
	<?php
		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%") or die(mysql_error());
		$db = mysql_select_db("rayku_db", $con) or die(mysql_error());

$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

		$query = mysql_query("select * from user_course where user_id=".$logedUserId) or die(mysql_error());
			$i = 0;
		if(mysql_num_rows($query) == 0) { ?>

<tr><td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td class="first"><b style="font-size:16px; color:#002c50"> Year Of Study</b></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td class="first">		  <select name="course_year" id="course_year" style="background:none;padding:0;width:auto;height:auto">
					               		<?php $categories = CategoryPeer::doSelect(new Criteria()); ?>
								<option value="">--- Select ---</option>
								<?php foreach( $categories as $category): ?>
								<?php if($category->getId() != 5): ?>
								<option value="<?=$category->getId();?>" ><?=$category->getName();?></option>
								<?php endif; ?>

								<?php endforeach; ?>
				                           				 </select>
                         	 </td>
<tr><td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td></tr>


	<fieldset>
					<table id="dataTable" summary="Description of this table.">
						<tr>
							<th scope="col" class="first">Subject</th>
							<th scope="col">Course Name</th>
							
							<th scope="col">Performance (Estimate)</th>
							<th scope="col">&nbsp;</th>
						</tr>
						<tr> </tr>
<tr>
							<td class="first"><select name="course_new_subject" id="course_new_subject" style="background:none;padding:0;width:auto;height:auto">
							  <option value="">Select</option>
					               		<?php $categories = CategoryPeer::doSelect(new Criteria()); ?>
								<option value="">--- Select ---</option>
								<?php foreach( $categories as $category): ?>
								<?php if($category->getId() != 5): ?>
								<option value="<?=$category->getId();?>" ><?=$category->getName();?></option>
								<?php endif; ?>

								<?php endforeach; ?>
				          </select></td>
						  <td><p>
						    <input name="course_new_name" type="text" id="course_new_name" value="" size="20" maxlength="50" />
						  </p>
					      <p style="font-size:10px;color:#999">(eg. Calculus Vectors Intro)</p></td>
							
							<td>
							 	 <label class="d"><span>D</span><input type="radio" name="new_grade" id="new_grade" value = "D"/></label>
								<label class="c"><span>C</span><input type="radio" name="new_grade" id="new_grade" value = "C" /></label>
								<label class="b"><span>B</span><input type="radio" name="new_grade" id="new_grade" value = "B" /></label>
                               					 <label class="a"><span>A</span><input type="radio" name="new_grade" id="new_grade" value = "A" /></label>
						  </td>
					  </tr>
		<?php } else {
				while($rowValues = mysql_fetch_array($query))
				{
					if($i == 0) { ?>
<tr><td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td class="first"><b style="font-size:16px; color:#002c50"> Year Of Study</b></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td class="first">		  <select name="course_year" id="course_year" style="background:none;padding:0;width:auto;height:auto">
				<option value="1" <?php if($rowValues['course_year'] == 2) {?> selected="selected" <?php } ?> >1</option>
				<option value="2" <?php if($rowValues['course_year'] == 2) {?> selected="selected" <?php } ?> >2</option>
				<option value="3" <?php if($rowValues['course_year'] == 3) {?> selected="selected" <?php } ?>>3</option>
				<option value="4+" <?php if($rowValues['course_year'] == '4+') {?> selected="selected" <?php } ?>>4+</option>
				<option value="graduated" <?php if($rowValues['course_year'] == 'graduated') {?> selected="selected" <?php } ?>>graduated</option>
				                           				 </select>
                         	 </td>
<tr><td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td></tr>


	<fieldset>
					<table id="dataTable" summary="Description of this table.">
						<tr>
							<th scope="col" class="first">Subject</th>
							<th scope="col">Course Name</th>
							
							<th scope="col">Performance (Estimate)</th>
							<th scope="col">&nbsp;</th>
						</tr>
						<tr> </tr>
						<?php } ?>

			<?php if($rowValues['course_subject'] != 5) : ?>
						<tr>
							<td class="first"><select name="course_subject[]" id="course_subject[]" disabled="disabled" style="background:none;padding:0;width:auto;height:auto">

					         <?php $categories = CategoryPeer::doSelect(new Criteria()); ?>
						<option value="">--- Select ---</option>
						<?php foreach( $categories as $category): ?>
						
					<option value="<?=$category->getId();?>" <?php if($rowValues['course_subject'] == $category->getId()): ?> selected="selected" 							<?php endif; ?> ><?=$category->getName();?></option>
					
						<?php endforeach; ?>
				          </select></td> 


<input type="hidden" name="course_new_sub[]" id="course_new_sub[]" value="<?php echo $rowValues['course_subject']; ?>" /> <input type="hidden" name="courseid[]" id="courseid[]" value="<?php echo $rowValues['id']; ?>" />
						  <td><p>

						     <input name="course_name[]" type="text" id="course_name[]" value="<?php echo $rowValues['course_name']; ?>" size="20" maxlength="50" />
						  </p>
					      <p style="font-size:10px;color:#999">(eg. Calculus Vectors Intro)</p></td>
							
							<td>
							 	 <label class="d"><span>D</span><input type="radio" name="grade[<?php echo $i; ?>]" value = "D" <?php if($rowValues['course_performance'] == D) {?> checked="checked" <?php } ?>/></label>
								<label class="c"><span>C</span><input type="radio" name="grade[<?php echo $i; ?>]" value = "C" <?php if($rowValues['course_performance'] == C) {?> checked="checked" <?php } ?>/></label>
								<label class="b"><span>B</span><input type="radio" name="grade[<?php echo $i; ?>]" value = "B" <?php if($rowValues['course_performance'] == B) {?> checked="checked" <?php } ?>/></label>
                               					 <label class="a"><span>A</span><input type="radio" name="grade[<?php echo $i; ?>]" value = "A" <?php if($rowValues['course_performance'] == A) {?> checked="checked" <?php } ?>/></label>
						  </td>
							<td><?php echo link_to('Delete', 'profile/rowdelete?id='.$rowValues['id'], array('class' => 'navlink delete', 'onclick' => "return confirm('Are you sure?');" )); ?> </td>
					  </tr>
						
						
			<?php 

					$i++;

				endif;

				 } 

		} ?>

					</table>

				</fieldset>

		</div>
		

		<input type="button" name="button2" id="button2" value="More Space" style="padding:6px;font-size:14px;margin:10px 0 0 10px" onclick="addRow('dataTable')" />
	 	
		<input type="submit" value="Submit Form" style="padding:6px;font-size:14px;margin:10px;font-weight:bold"  />

			</form> 


        </div>
        </div>
 <SCRIPT language="javascript">
	        function addRow(tableID) {
 
	            var table = document.getElementById(tableID);
	            var rowCount = table.rows.length;
	            var row = table.insertRow(rowCount);
	


					    var colCount = table.rows[2].cells.length;
				 
					    for(var i=0; i<colCount; i++) {

					 var j = 1;
						var newcell = row.insertCell(i);


						if(i == 0) {
							table.rows[rowCount].cells[i].innerHTML = "<select name='subject[" + rowCount + "]' id='subject[" + rowCount + "]' style='background:none;padding:0;width:auto;height:auto'><option value=''>Select</option><option value='1' >Mathematics</option><option value='4'>Business</option><option value='6'>Economics</option></select>";

			newcell.innerHTML = table.rows[rowCount].cells[i].innerHTML;
						
						} else if(i == '1') {
				
						 table.rows[rowCount].cells[i].innerHTML =  "<input name='name[" + rowCount + "]' type='text' id='name[" + rowCount + "]' size='20' maxlength='50' >";

							newcell.innerHTML = table.rows[rowCount].cells[i].innerHTML;

						} else if(i == '2') {
							 table.rows[rowCount].cells[i].innerHTML = "<label class='d'><input type='radio' name= newgrade[" + rowCount + "] value='D'></label><label class='c'><input  type='radio' name= newgrade[" + rowCount + "] value='C'></label><label class='b'><input type='radio' name= newgrade[" + rowCount + "] value='B'></label><label class='a'><input  type='radio' name= newgrade[" + rowCount + "] value='A'></label>";

							newcell.innerHTML = table.rows[rowCount].cells[i].innerHTML;

						}
					    }


        }



	       	    </SCRIPT>
                        
