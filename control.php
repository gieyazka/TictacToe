
<?php

class checkWin
{

    private $board;
    private $table;
    private $player;
    private $full;
    private $arr;
    function __construct()
    {
        if ($_POST) {
            $this->table = $_POST['table'];
            $this->board = $_POST['board'];
            $this->player = $_POST['player'];
        }
    }

    function checkHorizontalrow()
    {
        $playerWin = 0;

        for ($i = 0; $i < $this->table; $i++) {
            for ($j = 0; $j < $this->table; $j++) {
                if ($this->player == @$this->board[$i][$j]) {
                    $playerWin += 1;
                }
                if ($playerWin == $this->table) {
                    $this->arr = array("Winner" => "$this->player Win!!!!");
                    echo json_encode($this->arr);
                    break;
                }
            }
            if ($playerWin == $this->table) {
                break;
            }
            $playerWin = 0;
        }
    }

    function checkHorizontalColumn()
    {
        $playerWin = 0;

        for ($i = 0; $i < $this->table; $i++) {
            for ($j = 0; $j < $this->table; $j++) {
                if ($this->player == @$this->board[$j][$i]) {
                    $playerWin += 1;
                }
                if ($playerWin == $this->table) {
                    $this->arr = array("Winner" => "$this->player Win!!!!");
                    echo json_encode($this->arr);
                    break;
                }
            }
            if ($playerWin == $this->table) {
                break;
            }
            $playerWin = 0;
        }
    }
    function checkRightDiagonal()
    {
        $playerWin = 0;
        for ($i = 0; $i < $this->table; $i++) {

            if ($this->player == @$this->board[$i][$i]) {
                $playerWin += 1;
            }
            if ($playerWin == $this->table) {
                $this->arr = array("Winner" => "$this->player Win!!!!");
                echo json_encode($this->arr);
                break;
            }
            if ($playerWin == $this->table) {
                break;
            }
        }
    }
    function checkLeftDiagonal()
    {
        $playerWin = 0;
        $count = 0;

        for ($i = ($this->table - 1); $i >= 0; $i--) {
            if ($this->player == @$this->board[$count][$i]) {
            }
            if ($playerWin == $this->table) {
                $this->arr = array("Winner" => "$this->player Win!!!!");
                echo json_encode($this->arr);
                break;
            }
            if ($playerWin == $this->table) {
                break;
            }
            $count++;
        }
    }
    function getArray()
    {
        return $this->arr;
    }
    function checkBoard()
    {
        for ($i = 0; $i < $this->table; $i++) {
            for ($j = 0; $j < $this->table; $j++) {
                if (@$this->board[$i][$j]) {
                    $this->full += 1;
                }
            }
        }

        if ($this->full == ($this->table * $this->table)) {
            $this->arr = array("Winner" => "Game End Board Full");
            echo json_encode($this->arr);
        }
    }
}
header('Content-Type: application/json');
$obj = new checkWin();
$obj->checkHorizontalrow();
$obj->checkHorizontalColumn();
$obj->checkRightDiagonal();
$obj->checkLeftDiagonal();

if (!$obj->getArray()) {
    $obj->checkBoard();
}
?>