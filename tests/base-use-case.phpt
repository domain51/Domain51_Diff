--TEST--
PHPT_Diff has a matrix property that contains a multi-dimensional array that
contains the longest common subsequence length matrix
--FILE--
<?php

require_once dirname(__FILE__) . '/_setup.inc';

$source = str_split("XMJYAUZ");
$new = str_split("MZJAWXU");

$diff = new Domain51_Diff($source, $new);
foreach ($diff->matrix as $value) {
    echo implode(' ', $value), "\n";
}

?>
===DONE===
--EXPECT--
0 0 0 0 0 0 0 0
0 0 0 0 0 0 1 1
0 1 1 1 1 1 1 1
0 1 1 2 2 2 2 2
0 1 1 2 2 2 2 2
0 1 1 2 3 3 3 3
0 1 1 2 3 3 3 4
0 1 2 2 3 3 3 4
===DONE===
