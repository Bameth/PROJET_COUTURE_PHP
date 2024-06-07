<?php
class Controller{
    protected String $layout;
    public function __construct() {
        Session::ouvrirSession();
        $this->layout="base";
    }
    public function renderView(string $view, array $data=[]){
        ob_start();
        extract($data);
        require_once("../views/$view.html.php");
        $contentView=ob_get_clean();
        require_once("../views/layout/$this->layout.layout.php");

}
public function redirectToRoute($path){
    header("location:".WEBROOT."?$path");
    exit();

}
}