<?php

require 'vendor/autoload.php';

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

$host = 'http://localhost:9515';
$driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

// =====================
// REGISTER ADMIN
// =====================
$driver->get('http://127.0.0.1:8000/register');
$driver->wait(10)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('email')));

$uniq = time();
$email = "admin@example.com";
$password = '123123';

$driver->findElement(WebDriverBy::id('email'))->sendKeys($email);
$driver->findElement(WebDriverBy::id('name'))->sendKeys("Admin $uniq");
$driver->findElement(WebDriverBy::id('password'))->sendKeys($password);
$driver->findElement(WebDriverBy::id('password_confirmation'))->sendKeys($password);
$driver->findElement(WebDriverBy::cssSelector('button[type=submit]'))->click();

// Tunggu redirect ke /login
$driver->wait(10)->until(
    function ($driver) {
        return strpos($driver->getCurrentURL(), '/login') !== false;
    }
);
echo "✅ Register admin berhasil, masuk ke halaman login\n";

// =====================
// LOGIN ADMIN
// =====================
$driver->wait(10)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('input[placeholder="Email"]')));
$driver->findElement(WebDriverBy::cssSelector('input[placeholder="Email"]'))->sendKeys($email);
$driver->findElement(WebDriverBy::cssSelector('input[placeholder="Password"]'))->sendKeys($password);
$driver->findElement(WebDriverBy::cssSelector('button[type=submit]'))->click();

// Tunggu redirect ke /admin/dashboard
$driver->wait(10)->until(
    function ($driver) {
        return strpos($driver->getCurrentURL(), '/admin/dashboard') !== false;
    }
);

$currentUrl = $driver->getCurrentURL();
if (strpos($currentUrl, '/admin/dashboard') !== false) {
    echo "✅ Login admin berhasil, masuk ke /admin/dashboard\n";
} else {
    echo "❌ Login gagal, halaman saat ini: $currentUrl\n";
}

$driver->quit();
