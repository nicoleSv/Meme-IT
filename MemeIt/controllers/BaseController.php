<?php
 class BaseController {
    public function __construct(){
    }

    function load($page, $data = array()) {
        // Include current page
        include_once VIEWS_DIR.$page;
    }  
}
?>