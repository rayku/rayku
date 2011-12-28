<?php
use_helper('Validation');

function _labelise($id)
{
	return sfToolkit::pregtr($id, array('#/(.?)#e'    => "'::'.strtoupper('\\1')",
                                         '/(^|_)(.)/e' => "strtoupper(' \\2')"));
}

function form_row($id, $form_element, $label = null)
{
	$r = sprintf(
		'		<div class="form-row">
			%s
			<label for="%s">%s:</label> %s
		</div>',
		form_error($id),
		$id,
		$label ? $label : _labelise($id),
		$form_element
	);
	
	return $r;
}

function form_row_no_label($form_element)
{
	$r = sprintf(
		'		<div class="form-row-no-label">
			%s
		</div>',
		$form_element
	);
	
	return $r;
}