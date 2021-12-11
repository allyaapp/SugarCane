<?php
//menggunakan Framework PHPUnit
use PHPUnit\Framework\TestCase;

// Class yang akan di TEST.
require_once "login.php";

// Class untuk run Testing.
class Test_login extends TestCase
{
    //membuat sebuah fungsi
    public function testLoginPost()
    {
        //class yang akan kita pakai
        $insert = new Login();

        //memasukkan username dan password sesuai yang ada pada database
        $username = "syilla";
        $password = "syilla";
        $hasil = $insert->login($username, $password);
        $this->assertTrue($hasil);
    }
}
