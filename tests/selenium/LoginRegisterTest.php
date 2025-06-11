<?php

require 'vendor/autoload.php';

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

$host = 'http://localhost:9515';
$driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

// Fungsi untuk mengetik perlahan
function slowType($element, $text, $delay = 100000) {
    foreach (str_split($text) as $char) {
        $element->sendKeys($char);
        usleep($delay); // mikrodetik: 100000 = 0.1 detik
    }
}

try {
    // =====================
    // REGISTER
    // =====================
    echo "🔐 Membuka halaman register...\n";
    $driver->get('http://127.0.0.1:8000/register');
    $driver->wait(10)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('email')));
    sleep(1);

    $uniq = time();
    $email = "user$uniq@gmail.com";
    $password = '123123';

    echo "📝 Mengisi form registrasi...\n";
    slowType($driver->findElement(WebDriverBy::id('email')), "admin@example.com");
    sleep(1);
    slowType($driver->findElement(WebDriverBy::id('name')), "Admin $uniq");
    sleep(1);
    slowType($driver->findElement(WebDriverBy::id('password')), $password);
    sleep(1);
    slowType($driver->findElement(WebDriverBy::id('password_confirmation')), $password);
    sleep(1);

    echo "📨 Submit form registrasi...\n";
    $driver->findElement(WebDriverBy::cssSelector('button[type=submit]'))->click();

    // Tunggu redirect ke /login
    $driver->wait(10)->until(WebDriverExpectedCondition::urlContains('/login'));
    echo "✅ Register berhasil, masuk ke halaman login\n";
    sleep(1);

    // =====================
    // LOGIN ULANG
    // =====================
    echo "🔐 Mengisi form login...\n";
    $driver->wait(10)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('input[placeholder="Email"]')));
    slowType($driver->findElement(WebDriverBy::cssSelector('input[placeholder="Email"]')), "admin@example.com");
    sleep(1);
    slowType($driver->findElement(WebDriverBy::cssSelector('input[placeholder="Password"]')), $password);
    sleep(1);

    echo "➡️ Submit login...\n";
    $driver->findElement(WebDriverBy::cssSelector('button[type=submit]'))->click();

    // Tunggu redirect ke /home
    $driver->wait(10)->until(WebDriverExpectedCondition::urlContains('/admin/dashboard'));
    $currentUrl = $driver->getCurrentURL();

    if (strpos($currentUrl, '/admin/dashboard') !== false) {
        echo "✅ Login setelah register berhasil, masuk ke /home\n";
        sleep(3);
    } else {
        echo "❌ Login gagal, halaman saat ini: $currentUrl\n";
    }

} catch (Exception $e) {
    echo "❌ Terjadi error: " . $e->getMessage() . "\n";
} finally {
    $driver->quit();
}
