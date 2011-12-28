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

function acl_select_friends($friends, $selectedFriends = array(), $hidden = true, $container_id = 'visible-by-container')
{
	$contents = '';
	
	if (isset($friends) && is_array($friends))
	{
		foreach ($friends as $friend)
		{
			$string = sprintf(
				'<div class="form-row-indented">
					<input type="checkbox" name="friend[%s]" value="1" %s/> %s
				</div>',
				$friend->getId(),
				in_array($friend->getId(), $selectedFriends) ? 'checked="checked" ' : '',
				$friend
			);
			
			
			$contents .= $string;
		}
	}
	else
	{
		$contents = 'You have no friends.';
	}
	
	return '
		<div id="' . $container_id . '" style="' . ($hidden ? 'display: none; ' : '') . 'margin-top: 10px;">
			<!-- AJAX THIS EVENTUALLY. -->
			' . $contents . '
		</div>
	';
}

