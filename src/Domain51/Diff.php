<?php

class Domain51_Diff
{
    // todo: protect this
    public $matrix = array();

    private $_expected = array();
    private $_actual = array();

    private $_expected_len = 0;
    private $_actual_len = 0;

    public function __construct($expected, $actual)
    {
        $this->_expected = $expected;
        $this->_actual = $actual;

        $this->_expected_len = count($expected);
        $expected_len = $this->_expected_len + 1;
        $this->_actual_len = count($actual);
        $actual_len = $this->_actual_len + 1;
        
        $this->_initializeMatrix();

        for ($expected_cursor = 1; $expected_cursor < $expected_len; $expected_cursor++) {
            for ($actual_cursor = 1; $actual_cursor < $actual_len; $actual_cursor++) {
                if ($expected[$expected_cursor - 1] == $actual[$actual_cursor - 1]) {
                    $this->matrix[$expected_cursor][$actual_cursor] = $this->matrix[$expected_cursor - 1][$actual_cursor - 1] + 1;
                } else{
                    $this->matrix[$expected_cursor][$actual_cursor] = max($this->matrix[$expected_cursor - 1][$actual_cursor], $this->matrix[$expected_cursor][$actual_cursor - 1]);
                }
            }
        }
    }

    public function __toString()
    {
        return $this->_printDiff(count($this->_expected), count($this->_actual));
    }

    private function _initializeMatrix()
    {
        $xAxis = $this->_expected_len + 1;
        $yAxis = $this->_actual_len + 1;

        for ($x = 0; $x < $xAxis; $x++) {
            $this->matrix[$x] = array(0);
        }
        for ($y = 0; $y < $yAxis; $y++) {
            $this->matrix[0][$y] = 0;
        }
    }

    private function _printDiff($i, $j)
    {
        $return = '';
        if ($i > 0 && $j > 0 && $this->_expected[$i - 1] == $this->_actual[$j - 1]) {
            $return .= $this->_printDiff($i -1, $j - 1);
            $return .= "  " . $this->_expected[$i - 1] . "\n";
        } else {
            if ($j > 0 && ($i == 0 || $this->matrix[$i][$j - 1] >= $this->matrix[$i - 1][$j])) {
                $return .= $this->_printDiff($i, $j - 1);
                $return .= "+ " . $this->_actual[$j - 1] . "\n";
            } elseif ($i > 0 && ($j == 0 || $this->matrix[$i][$j - 1] < $this->matrix[$i - 1][$j])) {
                $return .= $this->_printDiff($i - 1, $j);
                $return .= '- ' . $this->_expected[$i - 1] . "\n";
            }
        }
        return $return;
    }
}

