--TEST--
When Domain51_Diff is cast to a string, it outputs a diff
--FILE--
<?php

require_once dirname(__FILE__) . '/_setup.inc';

$source = array(
    "This part of the document has stayed",
    "the same from version to version.",
    "",
    "This paragraph contains text that is",
    "outdated - it will be deprecated and",
    "deleted in the near future.",
    "",
    "It is important to spell check this",
    "dokument. On the other hand, a misspelled",
    "word isn't the end of the world.",
);

$new = array(
    "This is an important notice! It should",
    "therefore be located at the beginning of",
    "this document!",
    "",
    "This part of the document has stayed",
    "the same from version to version.",
    "",
    "It is important to spell check this",
    "document. On the other hand, a misspelled",
    "word isn't the end of the world. This",
    "paragraph contains important new",
    "additions to this document.",
);

echo new Domain51_diff($source, $new);

?>
===DONE===
--EXPECT--
+ This is an important notice! It should
+ therefore be located at the beginning of
+ this document!
+ 
  This part of the document has stayed
  the same from version to version.
- 
- This paragraph contains text that is
- outdated - it will be deprecated and
- deleted in the near future.
  
  It is important to spell check this
- dokument. On the other hand, a misspelled
- word isn't the end of the world.
+ document. On the other hand, a misspelled
+ word isn't the end of the world. This
+ paragraph contains important new
+ additions to this document.
===DONE===
