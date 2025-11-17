<?php 

namespace App;

use database\DataBase;



class Home{
  public function index()
  
  {
         $db = new DataBase();
         $consultants = $db->select('SELECT * FROM users WHERE role =?', ['consultant']);
         

        
        require_once(BASE_PATH . '/template/app/home.php');
  }

 
}



?>