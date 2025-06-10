<?php
require 'vendor/autoload.php';

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

// Setup akun dummy
$uniq = time();
$userEmail = "user$uniq@example.com";
$userPassword = '123123';
$adminEmail = "admin$uniq@example.com";
$adminPassword = '123123';

$driver = RemoteWebDriver::create('http://localhost:4444', DesiredCapabilities::chrome());

// ========== REGISTER USER ==========
$driver->get('http://127.0.0.1:8000/register');
$driver->wait(10)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('email')));
$driver->findElement(WebDriverBy::id('email'))->sendKeys($userEmail);
$driver->findElement(WebDriverBy::id('name'))->sendKeys("User $uniq");
$driver->findElement(WebDriverBy::id('password'))->sendKeys($userPassword);
$driver->findElement(WebDriverBy::id('password_confirmation'))->sendKeys($userPassword);
$driver->findElement(WebDriverBy::cssSelector('button[type=submit]'))->click();
$driver->wait(10)->until(function($driver){ return strpos($driver->getCurrentURL(), '/login') !== false; });

// ========== TEST DARK MODE SEBAGAI USER ==========
$driver->wait(10)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('input[placeholder="Email"]')));
$driver->findElement(WebDriverBy::cssSelector('input[placeholder="Email"]'))->sendKeys($userEmail);
$driver->findElement(WebDriverBy::cssSelector('input[placeholder="Password"]'))->sendKeys($userPassword);
$driver->findElement(WebDriverBy::cssSelector('button[type=submit]'))->click();
$driver->wait(10)->until(function($driver){ return strpos($driver->getCurrentURL(), '/dashboard') !== false; });

// Langsung tes tombol dark mode setelah login USER
try {
    echo "Menunggu tombol dark mode (user)...\n";
    $driver->wait(10)->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('darkModeToggle')));
    $darkModeButton = $driver->findElement(WebDriverBy::id('darkModeToggle'));
    $driver->executeScript("arguments[0].scrollIntoView(true);", [$darkModeButton]);
    if ($darkModeButton->isDisplayed() && $darkModeButton->isEnabled()) {
        try {
            $darkModeButton->click();
            echo "Tombol dark mode user berhasil diklik (native click).\n";
        } catch (\Exception $e) {
            $driver->executeScript("arguments[0].click();", [$darkModeButton]);
            echo "Tombol dark mode user berhasil diklik (JS click).\n";
        }
    } else {
        echo "❌ darkModeToggle user tidak visible atau tidak enabled\n";
    }
} catch (\Exception $e) {
    echo "❌ Tidak bisa klik tombol dark mode user: " . $e->getMessage() . "\n";
}
sleep(1);
$bodyClass = $driver->executeScript('return document.body.className;');
if (strpos($bodyClass, 'dark-mode') !== false) {
    echo "✅ Dark mode aktif untuk user\n";
} else {
    echo "❌ Dark mode gagal untuk user\n";
}
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

// ========== REGISTER ADMIN ==========
$driver = RemoteWebDriver::create('http://localhost:4444', DesiredCapabilities::chrome());
$driver->get('http://127.0.0.1:8000/register');
$driver->wait(10)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('email')));
$driver->findElement(WebDriverBy::id('email'))->sendKeys($adminEmail);
$driver->findElement(WebDriverBy::id('name'))->sendKeys("Admin $uniq");
$driver->findElement(WebDriverBy::id('password'))->sendKeys($adminPassword);
$driver->findElement(WebDriverBy::id('password_confirmation'))->sendKeys($adminPassword);
$driver->findElement(WebDriverBy::cssSelector('button[type=submit]'))->click();
$driver->wait(10)->until(function($driver){ return strpos($driver->getCurrentURL(), '/login') !== false; });

// ========== TEST DARK MODE SEBAGAI ADMIN ==========
try {
    echo "Menunggu input email admin...\n";
    $driver->wait(10)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('input[placeholder="Email"]')));
} catch (\Exception $e) {
    echo "❌ Gagal menemukan input email admin: " . $e->getMessage() . "\n";
    $driver->quit();
    exit(1);
}
$driver->findElement(WebDriverBy::cssSelector('input[placeholder="Email"]'))->sendKeys($adminEmail);
$driver->findElement(WebDriverBy::cssSelector('input[placeholder="Password"]'))->sendKeys($adminPassword);
$driver->findElement(WebDriverBy::cssSelector('button[type=submit]'))->click();

try {
    echo "Menunggu redirect ke /admin/dashboard ...\n";
    $driver->wait(10)->until(function($driver){ return strpos($driver->getCurrentURL(), '/admin/dashboard') !== false; });
} catch (\Exception $e) {
    echo "❌ Gagal redirect ke /admin/dashboard: " . $e->getMessage() . "\n";
    $driver->quit();
    exit(1);
}

// Langsung tes tombol dark mode setelah login ADMIN
try {
    echo "Menunggu tombol dark mode (admin)...\n";
    $driver->wait(10)->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('darkModeToggle')));
    $darkModeButton = $driver->findElement(WebDriverBy::id('darkModeToggle'));
    $driver->executeScript("arguments[0].scrollIntoView(true);", [$darkModeButton]);
    if ($darkModeButton->isDisplayed() && $darkModeButton->isEnabled()) {
        try {
            $darkModeButton->click();
            echo "Tombol dark mode admin berhasil diklik (native click).\n";
        } catch (\Exception $e) {
            $driver->executeScript("arguments[0].click();", [$darkModeButton]);
            echo "Tombol dark mode admin berhasil diklik (JS click).\n";
        }
    } else {
        echo "❌ darkModeToggle admin tidak visible atau tidak enabled\n";
    }
} catch (\Exception $e) {
    echo "❌ Tidak bisa klik tombol dark mode admin: " . $e->getMessage() . "\n";
}
sleep(1);
$bodyClass = $driver->executeScript('return document.body.className;');
if (strpos($bodyClass, 'dark-mode') !== false) {
    echo "✅ Dark mode aktif untuk admin\n";
} else {
    echo "❌ Dark mode gagal untuk admin\n";
}
$bgColor = $driver->executeScript('return window.getComputedStyle(document.body).backgroundColor;');
echo "Body background (admin): $bgColor\n";
if (strpos($bgColor, '18, 28, 36') !== false || strpos($bgColor, '24, 28, 36') !== false || strpos($bgColor, 'rgb(18, 18, 18)') !== false) {
    echo "✅ Visual dark mode aktif untuk admin\n";
} else {
    echo "❌ Visual dark mode gagal untuk admin\n";
}

$driver->get('http://127.0.0.1:8000/logout');
sleep(1);
$driver->quit();