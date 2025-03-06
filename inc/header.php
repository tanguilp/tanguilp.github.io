<?php

$acceptedLanguages = explode(',', $_SERVER['HTTP_ACCEPT']);
if(in_array('application/xhtml+xml', $acceptedLanguages))
{
	header('Content-type:application/xhtml+xml');
}
else
{
	header('Content-type:text/html;charset=utf-8');
}

echo '<?xml version="1.0" encoding="utf-8"?>'."\n"?>
