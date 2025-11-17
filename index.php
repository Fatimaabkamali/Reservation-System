<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//session start
session_start();


//config
define('BASE_PATH', __DIR__);
define('CURRENT_DOMAIN', currentDomain() . '/reservation');
define('DISPLAY_ERROR', true);
define('DB_HOST', 'localhost');
define('DB_NAME', 'reservation');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

require_once 'database/DataBase.php';
require_once 'activities/App/Home.php';
require_once "activities/App/Reservation.php";
require_once 'activities/Admin/ReservList.php';
require_once 'activities/Auth/Auth.php';



function uri($reservedUrl, $class, $method, $requestMethod = 'GET') 
{

    //current url array
    $currentUrl = explode('?', currentUrl())[0];
    $currentUrl = str_replace(CURRENT_DOMAIN, '', $currentUrl);
    $currentUrl = trim($currentUrl, '/');
    $currentUrlArray = explode('/', $currentUrl);
    $currentUrlArray = array_filter($currentUrlArray);

    //reserved Url array
    $reservedUrl = trim($reservedUrl, '/');
    $reservedUrlArray = explode('/', $reservedUrl);
    $reservedUrlArray = array_filter($reservedUrlArray);

        if(sizeof($currentUrlArray) != sizeof($reservedUrlArray) || methodField() != $requestMethod)
        {
                return false;
        }

        $parameters = [];
        for($key = 0; $key < sizeof($currentUrlArray); $key++)
        {
                if($reservedUrlArray[$key][0] == "{" && $reservedUrlArray[$key][strlen($reservedUrlArray[$key]) - 1] == "}")
                {
                        array_push($parameters, $currentUrlArray[$key]);
                }
                elseif($currentUrlArray[$key] !== $reservedUrlArray[$key])
                {
                        return false;
                }
        }

        if(methodField() == 'POST')
        {
                $request = isset($_FILES) ? array_merge($_POST, $_FILES) : $_POST;
                $parameters = array_merge([$request], $parameters);
        }

        $object = new $class;
        call_user_func_array(array($object, $method), $parameters);
        exit();
}



//helpers

function protocol() {
     return  stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://'; 
}


function currentDomain()
 {
        return protocol() . $_SERVER['HTTP_HOST'];
}


function asset($src){

        $domain = trim(CURRENT_DOMAIN, '/ ');
        $src = $domain . '/' . trim($src, '/');
        return $src;
}


function url($url){

        $domain = trim(CURRENT_DOMAIN, '/ ');
        $url = $domain . '/' . trim($url, '/');
        return $url;
}

function currentUrl()
{
        return currentDomain() . $_SERVER['REQUEST_URI'];
}


function methodField()
{
        return $_SERVER['REQUEST_METHOD'];
}

function displayError($displayError)
{

        if($displayError)
        {
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
        }
        else
        {
                ini_set('display_errors', 0);
                ini_set('display_startup_errors', 0);
                error_reporting(0);
        }

}

displayError(DISPLAY_ERROR);


global $flashMessage;
if(isset($_SESSION['flash_message'])){
        $flashMessage = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
}


function flash($name, $value = null)
{
        if($value === null){
                global $flashMessage;
                $message = isset($flashMessage[$name]) ? $flashMessage[$name] : '';
                return $message;
        }
        else{
                $_SESSION['flash_message'][$name] = $value;
        }

}



function dd($var){
    echo '<pre>';
    var_dump($var);
    exit;
}







uri('home', 'App\Home', 'index');


uri('reservation/{id}', 'App\Reservation', 'index');
uri('reservation/create', 'App\Reservation', 'create','POST');
uri('reservation/check', 'App\Reservation', 'check','POST');
uri('reservation/show', 'App\Reservation', 'showAvailableTimes','POST');


uri('Reserv_list', 'Admin\ReservList', 'index');
uri('active/{id}', 'Admin\ReservList', 'is_active');
//Auth 
uri('register', 'Auth\Auth', 'register');
uri('register/store', 'Auth\Auth', 'registerStore', 'POST');
uri('activation/{verify_token}', 'Auth\Auth', 'activation');
uri('', 'Auth\Auth', 'login');
uri('login', 'Auth\Auth', 'login');
uri('check-login', 'Auth\Auth', 'checkLogin', 'POST');
uri('logout', 'Auth\Auth', 'logout');



echo '404 - page not found';