<div id="top" style="margin-left:18px;padding-top:2px">
  <div class="title" style="float:left"> <img src="/images/arrow-right.gif" alt="" />
    <p style="font-size:16px; line-height:24px;color:#1C517C;font-weight:bold;margin-left:15px;"><? echo $journalEntry->getUser(); ?>'s Journal Entries</p>
  </div>
  <div class="spacer"></div>
</div>
<div class="body-main">
  <?php if ($sf_user->isAuthenticated() && $owner->equals($sf_user->getRaykuUser())): ?>
  <div class="actions">
    <h4>Actions</h4>
    <p> <?php echo link_to('Create new entry', 'journal/editForm') ?> </p>
  </div>
  <?php endif ?>
  <?php if (count($journalEntries) > 0): ?>
  <div class="categories">
    <?php foreach ($journalEntries as $count => $journalEntry): ?>
    <div class="topic">
      <div class="status">
        <div class="on">Topic Open</div>
      </div>
      <h4><?php echo link_to($journalEntry->getSubject(), 'journal/view?id='.$journalEntry->getID(),array('style'=>'color:#1C77A2;text-decoration:none;')); ?></h4>
      <div class="info">
        <p>Posted On: <br />
          <?php echo date(sfConfig::get('app_general_date_format'), strtotime($journalEntry->getCreatedAt())) ?></p>
        <br />
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php else: ?>
  <p>No entries found</p>
  <?php endif ?>
</div>
