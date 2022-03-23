<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Button
 *
 * @author xoviwyrx
 */
class Button {
    private string $value;
    private string $name;
    private string $id;
    public function __construct(string $value, string $name, string $id) {
        $this->value = $value;
        $this->name = $name;
        $this->id = $id;
    }
    public function showButton():string{
        $string = "<input class='p-1' type='submit' name='".$this->name. "' value='".$this->value."' id = '".$this->id."'>";
        return $string;
    }



}
