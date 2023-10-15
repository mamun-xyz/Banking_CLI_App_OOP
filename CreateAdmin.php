#!/usr/bin/env php
<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\admins\AdminRegistar;

class CreateAdmin{

    public function createAdmin(){
       $admin_registar = new AdminRegistar();
       $admin_registar->adminRegistar();
    }
}

$create_admin = new CreateAdmin();
$create_admin->createAdmin();
?>