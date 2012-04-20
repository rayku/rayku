<?php
function acl_javascript($select_id = 'gallery_type', $container_id = 'visible-by-container')
{
	return javascript_tag('
window.onload = function()
{
	$(\'' . $select_id . '\').onchange = function()
	{
		if (this.value == ' . Gallery::TYPE_SPECIFIC_PEOPLE_ONLY . ')
		{
			' . visual_effect('BlindDown', $container_id) . '
		}
		else
		{
			' . visual_effect('BlindUp', $container_id) . '
		}
	}
}');
}
