<?php 
namespace Jemer\StringHelper;

class StringBuilder
{
    private $strArr = [];

    /**
     * Add a new string to the string builder
     */
    public function Add(string $str) : void
    {
        $this->strArr[] = $str;
    }
    /**
     * Adds a line with an indent. $indents = 1 is the same a space. $indents = 5 is a tab
     */
    public function Add_Indented(string $str, int $indents) : void
    {
        $cache = "";

        for ($i=0; $i < $indents; $i++) { 
            $cache .= "\t";
        }
        $cache .= $str;
        $this->Add($cache);
    }
    /**
     * Adds a new line then your text then another new line
     */
    public function AddNewLineText($str) : void
    {
        $this->strArr[] = $this->AddNewLine();
        $this->strArr[] = $str;
        $this->strArr[] = $this->AddNewLine();

    }
    /**
     * Adds dashed line
     */
    public function AddHorizontalLine(int $width) : void
    {
        $cache = "";

        for ($i=0; $i < $width; $i++) 
        { 
            $cache .= "-";
        }
        $this->AddNewLineText($cache);
    }
    /**
     * Adds a new line to the string builder
     */
    public function AddNewLine() : void
    {
        $this->strArr[] = PHP_EOL;
    }
    /**
     * Adds text but as a comment "//this is a comment"
     */
    public function AddComment(string $str) : void
    {
        $this->AddNewLineText('//'.$str);
    }
    /**
     * var_dumps the containing array
     */
    public function Dump() : void
    {
        var_dump($this->strArr);
    }
    /**
     * Converts to a string
     */
    public function ToString() : string
    {
        $str = "";

        foreach ($this->strArr as $key) 
        {
            $str .= $key;
        }

        return $str;
    }
    /**
     * clears the containing array
     */
    public function Clear() : void
    {
        $this->strArr = [];
    }    
}

?>