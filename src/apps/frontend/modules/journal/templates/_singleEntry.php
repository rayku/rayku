<?php if ($entry instanceof JournalEntry): ?>

<p class="page-title"><?php echo $entry->getSubject() ?></p>
<div class="main-body">
  <p> <b>Posted By: </b><?php echo $entry->getUser() ?> </p>
  <p> <b>Posted On: </b><?php echo date(sfConfig::get('app_general_date_format'), strtotime($entry->getCreatedAt())) ?> </p>
  <?php echo $entry->getContent() ?> </div>
<?php endif ?>
