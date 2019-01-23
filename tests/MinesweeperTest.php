<?php

use App\Minesweeper;
use PHPUnit\Framework\TestCase;

class MinesweeperTest extends TestCase
{
    private $input;
    private $output;

    protected function setUp()
    {
        $this->input = [
            '....',
            '.*..',
            '.*.*',
            '...*'
        ];

        $this->output = [
            '1110',
            '2*31',
            '2*4*',
            '113*'
        ];
    }

    /**
     * @test
     */
    public function itPassesAcceptanceCriteria()
    {
        $minesweeper = new Minesweeper($this->input);
        $this->assertEquals($this->output, $minesweeper->getHints());
    }

    /**
     * @test
     */
    public function itShouldDisplayEmptyMinefield()
    {
        $minesweeper = new Minesweeper(['....']);
        $this->assertEquals(['0000'], $minesweeper->getHints());
    }

    /**
     * @test
     */
    public function itShouldDisplayCorrectDimensions()
    {
        $minesweeper = new Minesweeper(['.....', '.....']);
        $this->assertEquals(['00000', '00000'], $minesweeper->getHints());
    }

    /**
     * @test
     */
    public function itShouldDisplayMines()
    {
        $minesweeper = new Minesweeper(['****']);
        $this->assertEquals(['****'], $minesweeper->getHints());
    }

    /**
     * @test
     */
    public function itShouldDisplayLeftToMine()
    {
        $minesweeper = new Minesweeper(['.*.']);
        $this->assertEquals(['1*1'], $minesweeper->getHints());
    }

    /**
     * @test
     */
    public function itShouldDisplayHintOnColumn()
    {
        $minesweeper = new Minesweeper(['*', '.', '.']);
        $this->assertEquals(['*', '1', '0'], $minesweeper->getHints());
    }

    /**
     * @test
     */
    public function itShouldDisplayHintsAroundMine()
    {
        $minesweeper = new Minesweeper(['...', '.*.', '...']);
        $this->assertEquals(['111', '1*1', '111'], $minesweeper->getHints());
    }

    /**
     * @test
     */
    public function itShouldCountMinesAroundCell()
    {
        $minesweeper = new Minesweeper(['***', '*.*', '***']);
        $this->assertEquals(['***', '*8*', '***'], $minesweeper->getHints());
    }
}
