<?php
// auto-generated by sfPropelCrud
// date: 2009/12/07 03:43:40
?>

<div class="body-main">

<table>
<tbody>
<tr>
<th>Id: </th>
<td><?php echo $experts_immediate_lesson->getId() ?></td>
</tr>
<tr>
<th>Title: </th>
<td><?php echo $experts_immediate_lesson->getTitle() ?></td>
</tr>
<tr>
<th>Content: </th>
<td><?php echo $experts_immediate_lesson->getContent() ?></td>
</tr>
<tr>
<th>Price: </th>
<td><?php echo $experts_immediate_lesson->getPrice() ?></td>
</tr>
<tr>
<th>User: </th>
<td><?php echo $experts_immediate_lesson->getUserId() ?></td>
</tr>
<tr>
<th>Created at: </th>
<td><?php echo $experts_immediate_lesson->getCreatedAt() ?></td>
</tr>
<tr>
<th>Updated at: </th>
<td><?php echo $experts_immediate_lesson->getUpdatedAt() ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo link_to('edit', 'experts_immediate_lesson/edit?id='.$experts_immediate_lesson->getId()) ?>
&nbsp;<?php echo link_to('list', 'experts_immediate_lesson/list') ?>

</div><!-- end of body-main -->