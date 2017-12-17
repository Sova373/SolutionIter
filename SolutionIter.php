<?php
class SolutionIter implements Iterator
{
    protected $name, $file;
    private $position, $current;

    public function __construct($name) {
        $this->position = 0;
        $this->name = $name;
    }

    public function rewind() {
        $this->position = 0;
        $this->file = fopen($this->name, "r") or die("Unable to open file!");
    }

    public function current() {
        return $this->current;
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        while(!feof($this->file)) {
            $this->current = trim(fgets($this->file));

            if(preg_match("/^\+?\-?\d+$/", $this->current)
                && intval($this->current) >= -10000000000
                && intval($this->current) <= 10000000000
            ) {
                $this->current = intval($this->current);
                return true;
            }
        }

        fclose($this->file);
        return false;
    }

    public function key() {
        return $this->position;
    }
}

$myfile = "array.txt";
$solution = new SolutionIter($myfile);

foreach ($solution as $key => $integer)
    echo $key . " => " . $integer . "\n";
?>