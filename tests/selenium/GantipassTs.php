<?php
require 'vendor/autoload.php';

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

// Setup akun dummy
$uniq = time();
$userEmail = "gantipass$uniq@example.com";
$userPassword = 'gantipass123';

$driver = RemoteWebDriver::create('http://localhost:4444', DesiredCapabilities::chrome());

// Register user
$driver->get('http://127.0.0.1:8000/register');
$driver->wait(10)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('email')));
$driver->findElement(WebDriverBy::id('email'))->sendKeys($userEmail);
$driver->findElement(WebDriverBy::id('name'))->sendKeys("GantiPass $uniq");
$driver->findElement(WebDriverBy::id('password'))->sendKeys($userPassword);
$driver->findElement(WebDriverBy::id('password_confirmation'))->sendKeys($userPassword);
$driver->findElement(WebDriverBy::cssSelector('button[type=submit]'))->click();
$driver->wait(10)->until(function($driver){ return strpos($driver->getCurrentURL(), '/login') !== false; });

// Tes fitur lupa password
$driver->get('http://127.0.0.1:8000/login');
$driver->wait(10)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::linkText('Lupa Password')));
$driver->findElement(WebDriverBy::linkText('Lupa Password'))->click();
$driver->wait(10)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('input[type="email"]')));
$driver->findElement(WebDriverBy::cssSelector('input[type="email"]'))->sendKeys($userEmail);
$driver->findElement(WebDriverBy::cssSelector('button[type=submit]'))->click();
sleep(1);
// Cek notifikasi (ubah selector sesuai aplikasi Anda)
if (strpos($driver->getPageSource(), 'link reset password telah dikirim') !== false ||
    strpos($driver->getPageSource(), 'reset password link sent') !== false) {
    echo "✅ Permintaan lupa password berhasil dikirim\n";
} else {
    echo "❌ Permintaan lupa password gagal\n";
}

$driver->quit();
