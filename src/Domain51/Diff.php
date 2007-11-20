<?php

class Domain51_Diff
{
    // todo: protect this
    public $matrix = array();

    public function __construct($source, $new)
    {
        $source_len = count($source) + 1;
        $new_len = count($new) + 1;

        for ($i = 0; $i < $source_len; $i++) {
            $this->matrix[$i] = array(0);
        }
        for ($i = 0; $i < $new_len; $i++) {
            $this->matrix[0][$i] = 0;
        }

        for ($source_cursor = 1; $source_cursor < $source_len; $source_cursor++) {
            for ($new_cursor = 1; $new_cursor < $new_len; $new_cursor++) {
                if ($source[$source_cursor - 1] == $new[$new_cursor - 1]) {
                    $this->matrix[$source_cursor][$new_cursor] = $this->matrix[$source_cursor - 1][$new_cursor - 1] + 1;
                } else{
                    $this->matrix[$source_cursor][$new_cursor] = max($this->matrix[$source_cursor - 1][$new_cursor], $this->matrix[$source_cursor][$new_cursor - 1]);
                }
            }
        }
    }

}

