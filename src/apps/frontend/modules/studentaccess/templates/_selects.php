<label style="margin-top: 30px;">Select category:</label>

<?php
  $iCategory = $sf_request->getParameter('category');
  $iTeacher = $sf_request->getParameter('teacher');
  $iClassroom = $sf_request->getParameter('classroom');
?>

<form name="testform" method="post">
  <select id="category" name="category" class="dropdown" >
    <option value="" selected="selected">SELECT CATEGORY</option>
    <?php foreach($categories as $category) { ?>
      <option value="<?php echo $category->getId();?>" <?php if( isset( $iCategory ) && $iCategory == $category->getId()): ?> selected="selected" <?php endif ?> >
        <?php echo $category->getname(); ?>
      </option>
    <?php } ?>
  </select>

  <label style="margin-top: 15px;">Select teacher:</label>

  <select id="teacher" name="teacher" class="dropdown">
    <option value="">SELECT TEACHER</option>
    <?php foreach($alluser as $user) { ?>
    <option value="<?php echo $user->getId(); ?>" <?php if( $iTeacher == $user->getId()) { ?> selected="selected"<?php } ?> >
      <?php echo $user->getName(); ?>
    </option>
    <?php } ?>
  </select>

  <label style="margin-top: 15px;">Select Classroom:</label>

  <select id="classroom" name="classroom" class="dropdown">
    <option value="">SELECT CLASSROOM</option>
    <?php foreach($allclassroom as $classroom) { ?>
      <option value="<?php echo $classroom->getId(); ?>" <?php if( $iClassroom == $classroom->getId() ) { ?> selected="selected"<?php } ?> >
        <?php echo $classroom->getFullName(); ?>
      </option>
    <?php } ?>
  </select>
  
  <?php if( $iClassroom != ""): ?>
    <label style="margin-top: 15px; margin-bottom:30px;">
      <a href="<?php echo url_for('studentaccess/sendMail?userid='.$iTeacher.'&catid='.$iCategory.'&classid='.$iClassroom.'');?>" class="blue" style="line-height:35px; float:left;"><span>JOIN</span></a>
    </label>
  <?php endif;?>
</form>

<?php
  $sUrl = url_for( 'studentaccess/join' );

  sfProjectConfiguration::getActive()->loadHelpers('Javascript');

  echo javascript_tag("
    var oCategory = document.getElementById('category');
    var oTeacher = document.getElementById('teacher');
    var oClassroom = document.getElementById('classroom');

    var oContent = document.getElementById('tcontent');
    var oIndicator = document.getElementById('ajaxindicator');

    updateContent = function( oContent, sUrl )
    {
          
          
       new Ajax.Updater( oContent, sUrl, {
           asynchronous: true,
           evalScripts: true,
           onLoading: function()
           {
             oContent.setStyle( { display: 'none' } );
             oIndicator.setStyle( { display: '' } );
           },
           onSuccess: function()
           {
             oContent.setStyle( { display: '' } );
             oIndicator.setStyle( { display: 'none' } );
           }
         }
       );
    }

    Element.observe(oCategory, 'change', function()
       {
         var sUrl = '$sUrl' + '?category=' + oCategory.value;

         updateContent( oContent, sUrl );
       }
    );

    Element.observe(oTeacher, 'change', function()
       {
         var sUrl = '$sUrl' + '?category=' + oCategory.value + '&teacher=' + oTeacher.value;

         updateContent( oContent, sUrl );
       }
    );

    Element.observe(oClassroom, 'change', function()
       {
         var sUrl = '$sUrl' + '?category=' + oCategory.value + '&teacher=' + oTeacher.value + '&classroom=' + oClassroom.value;

         updateContent( oContent, sUrl );
       }
    );

  ");
?>