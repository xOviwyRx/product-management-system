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
    private string $form_id;
    private string $type;
    private string $on_click;
    public function __construct(string $value, string $name, 
            string $id, string $form_id, string $type) {
        $this->value = $value;
        $this->name = $name;
        $this->id = $id;
        $this->form_id = $form_id;
        $this->type = $type;
    }
    public function showButton():string{
        $string = "<button type='".$this->type."' class='p-1' "
                . "form='".$this->form_id."' name='".$this->name. "' "
                . "value='".$this->value."' id = '".$this->id.""
                . "onclick='".$this->on_click."'>"
                . "".$this->value."</button>";
        return $string;
    }



}
