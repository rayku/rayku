<h1>Forums List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Description</th>
      <th>Type</th>
      <th>Entity</th>
      <th>Category</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($forum_list as $forum): ?>
    <tr>
      <td><a href="<?php echo url_for('forums/edit?id='.$forum->getId()) ?>"><?php echo $forum->getId() ?></a></td>
      <td><?php echo $forum->getName() ?></td>
      <td><?php echo $forum->getDescription() ?></td>
      <td><?php echo $forum->getType() ?></td>
      <td><?php echo $forum->getEntityId() ?></td>
      <td><?php echo $forum->getCategoryId() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('forums/new') ?>">New</a>
