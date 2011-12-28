<?php use_helper('Enum'); ?>
<?php echo enum_values_select_tag('Network', 'Type', $network->getType()); ?>