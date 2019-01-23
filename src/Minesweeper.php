<?php

namespace App;

class Minesweeper
{
    /**
     * @var array
     */
    private $input;

    /**
     * Minesweeper constructor.
     * @param array $input
     */
    public function __construct(array $input)
    {
        $this->input = $input;
    }

    /**
     * @return array
     */
    public function getHints(): array
    {
        $hints = [];
        for ($row = 0; $row < count($this->input); $row++) {
            $line = '';
            for ($col = 0; $col < strlen($this->input[$row]); $col++) {
                $line .= $this->getHint($row, $col);
            }
            $hints[$row] = $line;
        }
        return $hints;
    }

    /**
     * @param int $row
     * @param int $col
     * @return string
     */
    private function getHint(int $row, int $col): string
    {
        if ($this->isMine($row, $col)) return '*';

        $count = 0;
        for ($r  = $row-1; $r <= $row+1; $r++) {
            for ($c = $col-1; $c <= $col+1; $c++) {
                if ($this->isMine($r, $c)) $count++;
            }
        }
        return $count;
    }

    /**
     * @param int $row
     * @param int $col
     * @return bool
     */
    private function isMine(int $row, int $col): bool
    {
        if ($row < 0 || $row >= count($this->input)) return false;
        if ($col < 0 || $col >= strlen($this->input[$row])) return false;
        return $this->input[$row][$col] == '*';
    }
}
