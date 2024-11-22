<?php

class fileOpenException extends Exception
{
    public function errorMessage() {
        return "Error: Could not open the file. " . $this->getMessage();
    }
}

class fileWriteException extends Exception
{
    public function errorMessage() {
        return "Error: Could not write to the file. " . $this->getMessage();
    }
}

class fileLockException extends Exception
{
    public function errorMessage() {
        return "Error: Could not lock the file. " . $this->getMessage();
    }
}

?>