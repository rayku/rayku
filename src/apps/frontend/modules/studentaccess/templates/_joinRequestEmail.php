Hello <?php echo $teacher->getName(); ?> 
I want to join to the classroom <?php $classroom->getFullName(); ?> comes under <?php echo $category->getName(); ?> category.
Please accept my request.

Thank you,
<?php $raykuUser = $sf_user->getRaykuUser(); ?>
<?php echo $raykuUser->getName(); ?>

In order to accept the above student please click on below link.

<?php echo $activationLink; ?>