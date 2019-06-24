<?php
namespace App\common;


class ClassParser
{
    private $fileName;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function setFileName($name)
    {
        $this->fileName = $name;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function getClassName()
    {
        $fileContent = $this->getFileContent();
        $matches = array();

        if (preg_match('/(class)\s(.*?)\s|{/sm', $fileContent, $matches)) {
            return trim($matches[2]);
        } else {
            return array("error" => "Class name is't found");
        }
    }


    private function getFileContent()
    {
        return file_get_contents($this->fileName);
    }
}