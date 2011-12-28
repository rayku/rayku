<?php
echo select_tag(
        'group[type]',
        options_for_select(
                Group::getTypes(),
                $group->getType() ),
        array('style' => 'width: 125px') );
?>