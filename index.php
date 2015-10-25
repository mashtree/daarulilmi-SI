<?php

/*
 * error reporting on
 */

error_reporting(E_ALL ^ E_NOTICE);

/*
 * define the sitepath POK SISI/
 */

$sitepath = realpath(dirname(__FILE__));
define('ROOT',$sitepath);

//echo $sitepath;

/*
 * define the sitepath url
 */

$base_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/';

define('URL',$base_url);//echo URL;

define('APP','Sistem Informasi Sekolah Islam Daarul Ilmi');

/*
 * define role
 *
define('ADMIN','admin'); //super duper admin
define('USTADZ','ustadz'); //koordinator
define('WALI','wali'); //inputer nilai
*/

$roleAuth = [];
$roleAuth['ADMIN'] = 'admin';
$roleAuth['USTADZ'] = 'ustadz';
$roleAuth['WALI'] = 'wali';

$path = array(
    ROOT.'/libs/',
    ROOT.'/app/controllers/',
    ROOT.'/app/models/'
);

//include ROOT.'/config/config.php';
include ROOT.'/libs/Autoloader.php';
include ROOT.'/libs/config.php';
include ROOT.'/app/akses.php';

Autoloader::setCacheFilePath(ROOT.'/libs/cache.txt');
Autoloader::setClassPaths($path);
Autoloader::register();
$registry = new Registry();
//$registry->upload = new Upload();
$registry->view = new View();
$registry->db = new Database();
$registry->auth = new Auth();
$registry->roleAuth = $roleAuth;
foreach($roleAuth as $key=>$value){
	$registry->auth->add_roles($roleAuth['ADMIN']);
} 
$registry->auth->add_access('home',$roleAuth['ADMIN'],$akses['Home']);
$registry->auth->add_access('auth',$roleAuth['ADMIN'],$akses['Auth']);
$registry->auth->add_access('home',$roleAuth['USTADZ'],$akses['Home']);
$registry->auth->add_access('auth',$roleAuth['USTADZ'],$akses['Auth']);
$registry->auth->add_access('home',$roleAuth['WALI'],$akses['Home']);
$registry->auth->add_access('auth',$roleAuth['WALI'],$akses['Auth']);
$registry->auth->add_roles('guest'); //admin
$registry->auth->add_access('home','guest',$akses['Home']);
$registry->auth->add_access('auth','guest',$akses['Auth']);
$registry->exception = new ClassException();
$registry->bootstrap = new Bootstrap($registry);

$registry->bootstrap->loader();
