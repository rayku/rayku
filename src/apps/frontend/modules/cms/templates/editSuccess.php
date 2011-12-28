<?php use_helper('Javascript'); ?>
<?php echo javascript_tag('tinyMCE.init({mode: "exact", language: "en", elements: "content", plugins: "table,advimage,advlink,flash", theme: "advanced", theme_advanced_toolbar_location: "top", theme_advanced_toolbar_align: "left", theme_advanced_path_location: "bottom", theme_advanced_buttons1: "justifyleft,justifycenter,justifyright,justifyfull,separator,bold,italic,strikethrough,separator,sub,sup,separator,charmap", theme_advanced_buttons2: "bullist,numlist,separator,outdent,indent,separator,undo,redo,separator,link,unlink,image,flash,separator,cleanup,removeformat,separator,code", theme_advanced_buttons3: "tablecontrols", extended_valid_elements: "img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name]", relative_urls: false, debug: false});'); ?>
<p class="page-title">Edit Page</p>
<div class="main-body">
	<table><tr><td valign="top">
		<div style="margin: 5px; height: 90%" id="orderContainer">
			<?php include_partial('orderPages', array('group' => $group)); ?>
		</div>
	</td>
	<td valign="top">
		<div id="CMS">
			Select a page to the left to edit.
		</div>
	</td></tr></table>
</div>