<div id="top">
  <div class="title">
    <img alt="" src="/images/arrow-right.gif"/>
    <p>Search for classroom names, location, school, course name</p>
  </div>
  <div class="spacer"></div>
</div>

<div class="body-main">

<form action="" method="post">
	<table>
		<tr>
      <td width="159"><input type="text" name="classroom_search" value="<?php echo $sf_request->getParameter('classroom_search') ?>" /></td>
		  <td width="191"><input type="submit" name="search" value="Search" /></td>
		</tr>
    <tr><td colspan="2">&nbsp;</td></tr>
	</table>
</form>

<?php
  if( $sf_request->getMethod() === sfWebRequest::POST )
  {
    if( isset( $searchresult) && count( $searchresult ) > 0 )
    {
      echo '<div id="results">Search Results:</div>';

      echo '<div style="float: left;" class="box">';
        echo '<div class="top"></div>';
        echo '<div class="content">';

          foreach ($searchresult as $result)
          {
            echo '<div class="entry">';
              echo '<table>';
                echo '<tr>';
                  echo '<th>Full Name</th>';
                  echo '<td>'.$result->getFullName().'</td>';
                  echo '<td rowspan="4">';
                    $sUrl = 'studentaccess/sendMail?userid='.$result->getUserId().'&catid='.$result->getCategoryId().'&classid='.$result->getId();
                    echo link_to('Join This Classroom',$sUrl , array('class' => 'navlink') );
                  echo '</td>';
                echo '</tr>';

                echo '<tr>';
                  echo '<th>Short Name</th>';
                  echo '<td>'.$result->getShortName().'</td>';
                echo '</tr>';

                echo '<tr>';
                  echo '<th>School Name</th>';
                  echo '<td>'.$result->getSchoolName().'</td>';
                echo '</tr>';

                echo '<tr>';
                  echo '<th>Location</th>';
                  echo '<td>'.$result->getLocation().'</td>';
                echo '</tr>';
              echo '</table>';
              
            echo '</div>';
          }

        echo '</div>';
      echo '</div>';
    }
    else
      echo '<p>No results</p>';
  }
 ?>
 
 </div><!-- end of body-main -->
