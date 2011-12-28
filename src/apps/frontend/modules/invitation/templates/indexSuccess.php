<?php  use_helper('MyForm') ?>

<div id="top">
  <div class="title">
    <img alt="" src="/images/arrow-right.gif"/>
    <p>Invitation</p>
  </div>

  <div class="spacer"></div>
</div>

<div class="body-main">
  <?php
  echo form_tag('invitation/sendConfirmation',  array('name' => 'invitation'));
  echo '<table>';
    echo '<tr>';
      echo '<td>Enter E-mail address:</td><td>'.input_tag('email').'</td>';
    echo '</tr>';
    echo '<tr>';
      echo '<td colspan="2">'.submit_tag('Send Invitation mail', array('class' => 'clearBlock') ).'</td>';
    echo '</tr>';
  echo '</table>';
  ?>
  </form>
</div>