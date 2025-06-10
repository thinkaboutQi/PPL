<?php

require 'vendor/autoload.php';

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverSelect;

$host = 'http://localhost:9515'; // Pastikan chromedriver aktif
$driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

// Fungsi untuk mengetik perlahan
function slowType($element, $text, $delay = 100000) {
    foreach (str_split($text) as $char) {
        $element->sendKeys($char);
        usleep($delay); // delay dalam mikrodetik (100000 = 0.1 detik)
    }
}

try {
    echo "🔐 Membuka halaman register...\n";
    $driver->get('http://127.0.0.1:8000/register');
    $driver->wait(10)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('email')));
    sleep(1);

    $uniq = time();
    $email = "user$uniq@gmail.com";
    $password = '123123';

    echo "📝 Mengisi form registrasi...\n";
    slowType($driver->findElement(WebDriverBy::id('email')), $email);
    sleep(1);
    slowType($driver->findElement(WebDriverBy::id('name')), "User $uniq");
    sleep(1);
    slowType($driver->findElement(WebDriverBy::id('password')), $password);
    sleep(1);
    slowType($driver->findElement(WebDriverBy::id('password_confirmation')), $password);
    sleep(1);

    echo "📨 Submit form registrasi...\n";
    $driver->findElement(WebDriverBy::cssSelector('button[type=submit]'))->click();

    $driver->wait(10)->until(WebDriverExpectedCondition::urlContains('/login'));
    echo "✅ Register berhasil, masuk ke halaman login\n";
    sleep(1);

    // ===================== LOGIN =====================
    echo "🔐 Mengisi form login...\n";
    $driver->wait(10)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('input[placeholder="Email"]')));
    slowType($driver->findElement(WebDriverBy::cssSelector('input[placeholder="Email"]')), $email);
    sleep(1);
    slowType($driver->findElement(WebDriverBy::cssSelector('input[placeholder="Password"]')), $password);
    sleep(1);

    echo "➡️ Submit form login...\n";
    $driver->findElement(WebDriverBy::cssSelector('button[type=submit]'))->click();

    $driver->wait(10)->until(WebDriverExpectedCondition::urlContains('/home'));
    echo "✅ Login berhasil, masuk ke /home\n";
    sleep(1);

    // ===================== PILIH PROVINSI =====================
    echo "🌍 Pilih Provinsi...\n";
    $provinsiDropdown = WebDriverBy::cssSelector('select[wire\\:model="provinsi_id"]');
    $driver->wait(10)->until(WebDriverExpectedCondition::presenceOfElementLocated($provinsiDropdown));
    $provinsiSelect = new WebDriverSelect($driver->findElement($provinsiDropdown));
    $provinsiSelect->selectByVisibleText('DKI Jakarta');
    sleep(2);

    // ===================== PILIH KABUPATEN =====================
    echo "🏙️ Pilih Kabupaten...\n";
    $kabupatenSelect = new WebDriverSelect($driver->findElement(WebDriverBy::cssSelector('select[wire\\:model="kabupaten_id"]')));
    $kabupatenSelect->selectByVisibleText('Jakarta Pusat');
    sleep(2);

    // ===================== PILIH KECAMATAN =====================
    echo "🏘️ Pilih Kecamatan...\n";
    $kecamatanSelect = new WebDriverSelect($driver->findElement(WebDriverBy::cssSelector('select[wire\\:model="kecamatan_id"]')));
    $kecamatanSelect->selectByVisibleText('Gambir');
    sleep(2);

    // ===================== CARI TOKO =====================
    echo "🔍 Mencari toko berdasarkan lokasi...\n";
    $driver->findElement(WebDriverBy::id('cari-toko'))->click();
    sleep(2);

    // ===================== PILIH TOKO =====================
    echo "🛒 Memilih toko...\n";
    $driver->wait(10)->until(
        WebDriverExpectedCondition::presenceOfElementLocated(
            WebDriverBy::xpath("//button[contains(text(), 'Pilih Toko')]")
        )
    );
    $pilihTokoBtn = $driver->findElement(WebDriverBy::xpath("//button[contains(text(), 'Pilih Toko')]"));
    $pilihTokoBtn->click();

    $driver->wait(10)->until(WebDriverExpectedCondition::urlContains('/order'));
    echo "✅ Masuk ke halaman order\n";
    echo "🎉 Pemilihan depot berhasil!\n";

} catch (Exception $e) {
    echo "❌ Terjadi error: " . $e->getMessage() . "\n";
} finally {
    $driver->quit();
}
