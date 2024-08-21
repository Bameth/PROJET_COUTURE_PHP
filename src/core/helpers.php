<?php
namespace ab\core;
use ab\Core\Session;
use ab\Core\Autorisation;
function add_class_invalid(string $fieldName){
    echo isset(Session::get("errors")[$fieldName])?"is-invalid":"";
}
function add_class_hidden(string $fieldName){
    echo !isset(Session::get("errors")[$fieldName])?"hidden":"";
}
function has_role(string $roleName):bool{
    echo !Autorisation::hasRole($roleName)?"hidden":"";
    return Autorisation::hasRole($roleName);
}

function dd(mixed $data){
   dump($data);die;
}

function dump(mixed $data){
    echo "<pre>";
     var_dump($data);
     echo "<pre>";
}
