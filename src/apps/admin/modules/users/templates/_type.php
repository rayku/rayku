<?php use_helper('Enum'); ?>
<?php echo enum_values_select_tag('User', 'Type', $user->getType()); ?>