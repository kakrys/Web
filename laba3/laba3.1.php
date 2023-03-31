<?php
//a
echo '<pre>';
$str = 'ahb acb aeb aeeb adcb axeb';
$f = preg_match_all('/a..b/', $str, $matches);
echo "a:";
var_dump($matches);
echo '</pre>';


//b
echo '<pre>';
$str = 'a1b2c3';
$replacements=[1,8,27];
$patterns=['/1/','/2/','/3/'];
echo "b:",preg_replace($patterns, $replacements, $str),"\n";
echo '</pre>';


