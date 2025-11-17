<?php

namespace Auth;

use database\DataBase;


class Auth
{

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

   

    

    

    public function register()
    {
    require_once(BASE_PATH . '/template/auth/register.php');
    }


    public function registerStore($request)
    {
        if(empty($request['email'])  || empty($request['password']))
        {
            flash('register_error', 'تمامی فیلد ها اجباری میباشند');
            $this->redirectBack();
        }
        
        else if(!filter_var($request['email'], FILTER_VALIDATE_EMAIL))
        {
            flash('register_error', 'ایمیل معتبری وارد نشده است');
            $this->redirectBack();
        }
        else{
            $db = new DataBase();
            $user = $db->select('SELECT * FROM users WHERE email = ?', [$request['email']])->fetch();
            if($user != null){
                flash('register_error', 'کاربر از قبل در سیستم وجود دارد ');
                $this->redirectBack();
            }
            else{
               
                   $db->insert('users', array_keys($request), $request);
                   $this->redirect('home');
            }
        }
    }







    public function login()
    {
        require_once(BASE_PATH . '/template/auth/login.php');
    }


    public function checkLogin($request)
    {
       if(empty($request['email']) || empty($request['password']))
       {
        flash('login_error', 'تمامی فیلد ها الزامی میباشند');
        $this->redirectBack();
       }
       else{
           $db = new DataBase();
           $user = $db->select("SELECT * FROm users WHERE email = ?", [$request['email']])->fetch();

           if($user != null)
           {
            if($request['password'] == $user['password'])
            {
                $_SESSION['user'] = $user['id'];
                if (isset(  $_SESSION['user'] )){
                     if ($user['role'] == 'user') {
                    $this->redirect('home');
                } else if ($user['role'] == 'consultant') {
                    $this->redirect('Reserv_list');
                }

                }
               

                
            }
            else{
                flash('login_error', 'ورود انجام نشد');
                $this->redirectBack();
            }
           }
           else{
            flash('login_error', 'کاربری با این مشخصات یافت نشد');
            $this->redirectBack();
           }
       }
    }
     public function logout()
    {
        if(isset($_SESSION['user']))
        {
            unset($_SESSION['user']);
            session_destroy();
        }
        $this->redirect('login');
    }

}
