<?php
// auto-generated by sfPropelCrud
// date: 2009/09/07 03:54:49
?>

<div class="body-main">

<h1>expert_lesson</h1>

<table>
<thead>
<tr>
  <th>Id</th>
  <th>Title</th>
  <th>Content</th>
  <th>User</th>
   <th>Price</th>
  <th>Created at</th>
  <th>Updated at</th>
</tr>
</thead>
<tbody>
<?php foreach ($expert_lessons as $expert_lesson): ?>
<tr>
    <td><?php echo link_to($expert_lesson->getId(), 'expert_lesson/show?id='.$expert_lesson->getId()) ?></td>
      <td><?php echo $expert_lesson->getTitle() ?></td>
      <td><?php echo $expert_lesson->getContent() ?></td>
      <td><?php echo $expert_lesson->getUserId() ?></td>
	  <td><?php echo $expert_lesson->getPrice() ?></td>
      <td><?php echo $expert_lesson->getCreatedAt() ?></td>
      <td><?php echo $expert_lesson->getUpdatedAt() ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php echo link_to ('create', 'expert_lesson/create') ?>

</div><!-- end of body-main -->
