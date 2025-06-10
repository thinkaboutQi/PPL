<?php

require 'vendor/autoload.php';

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

$host = 'http://localhost:9515';
$driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

// =====================
// REGISTER
// =====================
$driver->get('http://127.0.0.1:8000/register');
$driver->wait(10)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('email')));

$uniq = time();
$email = "user$uniq@gmail.com";
$password = '123123';

$driver->findElement(WebDriverBy::id('email'))->sendKeys($email);
$driver->findElement(WebDriverBy::id('name'))->sendKeys("User $uniq");
$driver->findElement(WebDriverBy::id('password'))->sendKeys($password);
$driver->findElement(WebDriverBy::id('password_confirmation'))->sendKeys($password);
$driver->findElement(WebDriverBy::cssSelector('button[type=submit]'))->click();

// Tunggu redirect ke /login
$driver->wait(10)->until(
    WebDriverExpectedCondition::urlContains('/login')
);

echo "✅ Register berhasil, masuk ke halaman login\n";

// =====================
// LOGIN ULANG
// =====================
$driver->wait(10)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('input[placeholder="Email"]')));
$driver->findElement(WebDriverBy::cssSelector('input[placeholder="Email"]'))->sendKeys($email);
$driver->findElement(WebDriverBy::cssSelector('input[placeholder="Password"]'))->sendKeys($password);
$driver->findElement(WebDriverBy::cssSelector('button[type=submit]'))->click();

// Tunggu redirect ke /home
$driver->wait(10)->until(
    WebDriverExpectedCondition::urlContains('/home')
);

$currentUrl = $driver->getCurrentURL();
if (strpos($currentUrl, '/home') !== false) {
    echo "✅ Login setelah register berhasil, masuk ke /home\n";
} else {
    echo "❌ Login gagal, halaman saat ini: $currentUrl\n";
}

$driver->quit();
