<?php 

namespace Admin;

use database\DataBase;

class ReservList {
       protected function redirect($url)
    {
        header('Location: ' . trim(CURRENT_DOMAIN, '/ ') . '/' . trim($url, '/ '));
        exit;
    }

    protected function redirectBack()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    public function index()
    {
        $db = new DataBase();
        $iduser = $_SESSION['user'];
        

        // گرفتن لیست رزروها
        $reservs = $db->select(
            'SELECT * FROM appointments WHERE userID = ? OR consultantID = ?',
            [$iduser, $iduser]
        )->fetchAll();
        
        // گرفتن همه ساعت‌ها
        $hoursData = $db->select('SELECT * FROM hours')->fetchAll();
        $hours = [];
        foreach ($hoursData as $h) {
            $hours[$h['id']] = $h['time'];
        }

        // گرفتن همه کاربران
        $usersData = $db->select('SELECT * FROM users')->fetchAll();
        $users = [];
        foreach ($usersData as $u) {
            $users[$u['id']] = $u['name'];
        }

        require_once(BASE_PATH . '/template/admin/index.php');
    }
    public function is_active($id)
{
    $db = new DataBase();
    $appointment = $db->select('SELECT * FROM appointments WHERE id = ?', [$id])->fetch();

 
    if ($appointment['status'] == 'reserved') {
   
        $db->update('appointments', ['status' => 'canceled'], 'id = ?', [$id]);
    } else {
       
        $db->update('appointments', ['status' => 'reserved'], 'id = ?', [$id]);
    }

   
    $this->redirect('Reserv_list');
    
}

}
