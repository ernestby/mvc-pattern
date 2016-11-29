<?php

class View
{
	
	function generate($content_view, $template_view, $data = null)
	{
		!isset($data) ?: extract($data);
		include 'app/views/'. $template_view;
	}
}