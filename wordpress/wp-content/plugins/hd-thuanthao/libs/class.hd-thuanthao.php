<?php
if(!function_exists('add_action')){
    echo "Please go out now!"; exit;
}

class HDThuanThao{
    protected static $instance;
    protected function __construct() {
        
    }
    protected function __clone() {
        
    }
    public static function get_instance(){
        if(self::$instance === null){
            self::$instance = new HDThuanThao();
        }
        return self::$instance;
    }
    
    public static function run(){
        HDThuanThaoPosttype::run();
    }
    
    public static function plugin_activation(){
        
    }
    
    public static function plugin_deactivation(){
        
    }
}
