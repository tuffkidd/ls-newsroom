<?php
function print_r2($array)
{
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

function human_filesize($bytes, $decimals = 1)
{
	$sz = 'BKMGTP';
	$factor = floor((strlen($bytes) - 1) / 3);
	return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}
