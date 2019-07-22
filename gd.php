<?php

$arr = array(
	0 => array(2,3),
	1 => array(5,6,7),
);


function gd($arr, $i)
{
	static $result = array(), $_i=0;
	if(isset($arr[$i]))
	{
		foreach ($arr[$i] as $k => $v)
		{
			$result[$_i][] = $v;
			gd($arr, ++$i);
		}
	}
	$_i++;
	return $result;
}

$a = gd($arr, 0);

var_dump($a);