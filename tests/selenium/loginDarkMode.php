<?php
require 'vendor/autoload.php';

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

$host = 'http://localhost:9515';
$driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

// ========== LOGIN USER ==========
$userEmail = 'user@example.com'; // Ganti dengan email user yang sudah terdaftar
$userPassword = '123123'; // Ganti dengan password user yang sesuai
$driver->get('http://127.0.0.1:8000/login');
$driver->wait(10)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('input[placeholder="Email"]')));
$driver->findElement(WebDriverBy::cssSelector('input[placeholder="Email"]'))->sendKeys($userEmail);
$driver->findElement(WebDriverBy::cssSelector('input[placeholder="Password"]'))->sendKeys($userPassword);
$driver->findElement(WebDriverBy::cssSelector('button[type=submit]'))->click();
$driver->wait(10)->until(function($driver){ return strpos($driver->getCurrentURL(), '/dashboard') !== false; });
echo "✅ Login user berhasil\n";

// ========== AKTIFKAN DARK MODE ========== 
$driver->findElement(WebDriverBy::id('darkModeToggle'))->click();
sleep(1);
$bodyClass = $driver->executeScript('return document.body.className;');
if (strpos($bodyClass, 'dark-mode') !== false) {
    echo "✅ Dark mode aktif untuk user\n";
} else {
    echo "❌ Dark mode gagal untuk user\n";
}

// Cek background-color body (USER)
$bgColor = $driver->executeScript('return window.getComputedStyle(document.body).backgroundColor;');
echo "Body background (user): $bgColor\n";
if (strpos($bgColor, '18, 28, 36') !== false || strpos($bgColor, '24, 28, 36') !== false || strpos($bgColor, 'rgb(18, 18, 18)') !== false) {
    echo "✅ Visual dark mode aktif untuk user\n";
} else {
    echo "❌ Visual dark mode gagal untuk user\n";
}

$driver->get('http://127.0.0.1:8000/logout');
sleep(1);
$driver->quit();
