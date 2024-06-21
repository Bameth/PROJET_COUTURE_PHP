<?php
namespace ab\Core;

class Controller {
    protected string $layout;

    public function __construct() {
        Session::ouvrirSession();
        $this->layout = "base";
    }

    public function renderView(string $view, array $data = []) {
        ob_start();
        extract($data);
        require_once("../views/$view.html.php");
        $contentView = ob_get_clean();
        require_once("../views/layout/$this->layout.layout.php");
    }
    public function renderJson(array $data = []) {
        echo json_encode($data);
    }

    public function redirectToRoute($path) {
        header("Location: " . WEBROOT . "?$path");
        exit();
    }
}
