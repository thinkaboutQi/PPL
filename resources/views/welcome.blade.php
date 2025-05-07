@extends('layouts.app')

@section('content')

{{-- Section home --}}
<section id="home" class="py-5 d-flex align-items-center" style="min-height: 100vh; background-color: #1E388D;">
    <div class="container">
        <div class="row align-items-center">
            <!-- gambar -->
            <div class="col-md-5 mb-5 mb-md-0">
  <img
    src="https://assets.onecompiler.app/432w6j563/43e8728yh/Keran%20Air%20Mengalir%20-%20Foto%20gratis%20di%20Pixabay.jfif"
    class="rounded float-start"
    alt="Solusi Air Bersih"
    style="max-width: 300px; margin-left:50px; margin-top: 30px;">
</div>

            <!-- Text -->
            <div class="col-md-6 text-white">
                <p class="text-uppercase small">SIBESI</p>
                <h1 class="fw-bold display-4 mb-3">Solusi Air Bersih<br>untuk<br>Kebutuhan<br> Anda</h1>
                <p class="mb-4">Kami hadir untuk memastikan setiap tetes air yang Anda gunakan aman, bersih, dan berkualitas.</p>
                <a href="#about" class="btn btn-light fw-semibold">About Us<i class="bi bi-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
</section>

{{-- Section Order --}}
<section id="order" class="py-5 text-center d-flex align-items-center" style="scroll-margin-top: 150px; background: #FFF">
    <div class="container">
        <div>
            <span class="px-4 py-2 fw-semibold" style="border: 2px solid #1E388D; border-radius: 50px; color: #1E388D; display: inline-block;">
                Tersedia Di Berbagai Daerah!
            </span>
        </div>

        <h1 id="typewriter" class="fw-bold display-4 mb-4" style="color: #1e1e1e; padding: 10px 0;"></h1>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="#" class="btn btn-primary px-4 py-2 fw-semibold" style="background-color:#3328BF;">Info Selengkapnya</a>
            <a href="{{ route('register') }}" class="btn px-4 py-2 fw-semibold"
               style="background-color: rgba(255, 255, 255, 0.3);
                      backdrop-filter: blur(8px);
                      -webkit-backdrop-filter: blur(8px);
                      color: #1E388D;
                      border: 2px solid rgba(30, 56, 141, 0.4);
                      border-radius: 50px;">
                Pesan<i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</section>

<!-- JavaScript -->
<script>
  const target = document.getElementById("typewriter");
  const text1 = "Tunggu apalagi?";
  const text2 = " Pesan Sekarang Disini!";

  let animated = false;

  function startTyping() {
    let i = 0;
    function typeFirst() {
      if (i < text1.length) {
        target.innerHTML += text1.charAt(i);
        i++;
        setTimeout(typeFirst, 60);
      } else {
        setTimeout(typeSecond, 700); // jeda setelah tanda tanya
      }
    }

    let j = 0;
    function typeSecond() {
      if (j < text2.length) {
        target.innerHTML += text2.charAt(j);
        j++;
        setTimeout(typeSecond, 60);
      }
    }

    typeFirst();
  }

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !animated) {
        animated = true; // biar gak ke-trigger dua kali
        startTyping();
        observer.unobserve(entry.target); // stop observe setelah aktif
      }
    });
  }, { threshold: 0.3 }); // aktif saat 30% elemen terlihat

  observer.observe(document.getElementById("order"));
</script>

{{-- Section About Us --}}
<section id="about" class="d-flex align-items-center py-5" style="min-height: 100vh; background: linear-gradient(90deg, #1E388D 0%, #2A4BA0 100%); color: white;">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Left: Gambar -->
            <div class="col-lg-6" data-aos="fade-right">
                <img src="https://assets.onecompiler.app/43gzrskdv/43gzrsp5x/developer%20sibesi.jpg" class="img-fluid rounded" alt="Tentang Kami" style="max-width: 400px; margin: 0 auto; display: block;">
            </div>

            <!-- Right: Text -->
            <div class="col-lg-6" data-aos="fade-left">
                <h2 class="fw-bold display-5" style="margin-top:60px;">SIBESI : Sistem <br>Informasi Air Bersih</h2>
                <p class="mt-3 mb-4" style="max-width: 500px;">
                    Kami siap memberikan solusi terbaik sesuai dengan kebutuhan Anda. Bersama kami, nikmati kemudahan akses air bersih untuk kehidupan yang lebih sehat dan berkelanjutan.
                </p>
            </div>
        </div>

        <!--Garis Pembatas -->
<hr class="my-5" style="border-color: rgba(255,255,255,0.3);">
<!-- carousel testimoni -->
<div class="overflow-hidden position-relative" data-aos="fade-up" data-aos-delay="300">
    <div class="d-flex gap-5 slide-track" style="animation: scroll 20s linear infinite;">
        <div class="d-flex align-items-start gap-2">
            <i class="bi bi-star-fill text-white"></i>
            <p class="mb-0 text-white" style="max-width: 300px;">
                Nggak perlu telepon lagi, tinggal klik dan tracking pesanan secara real-time.
            </p>
        </div>
        <div class="d-flex align-items-start gap-2">
            <i class="bi bi-star-fill text-white"></i>
            <p class="mb-0 text-white" style="max-width: 300px;">
                Pembayaran mudah via Virtual Account, layanan makin modern dan efisien.
            </p>
        </div>
        <div class="d-flex align-items-start gap-2">
            <i class="bi bi-star-fill text-white"></i>
            <p class="mb-0 text-white" style="max-width: 300px;">
                Praktis dan cepat! Pesan lewat website, bayar pakai QRIS, langsung diproses!
            </p>
        </div>
        {{-- Duplikasi supaya loop kelihatan mulus --}}
        <div class="d-flex align-items-start gap-2">
            <i class="bi bi-star-fill text-white"></i>
            <p class="mb-0 text-white" style="max-width: 300px;">
                Nggak perlu telepon lagi, tinggal klik dan tracking pesanan secara real-time.
            </p>
        </div>
        <div class="d-flex align-items-start gap-2">
            <i class="bi bi-star-fill text-white"></i>
            <p class="mb-0 text-white" style="max-width: 300px;">
                Pembayaran mudah via Virtual Account, layanan makin modern dan efisien.
            </p>
        </div>
        <div class="d-flex align-items-start gap-2">
            <i class="bi bi-star-fill text-white"></i>
            <p class="mb-0 text-white" style="max-width: 300px;">
                Praktis dan cepat! Pesan lewat website, bayar pakai QRIS, langsung diproses!
            </p>
        </div>
    </div>
</div>

<style>
    .slide-track {
        width: max-content;
    }

    @keyframes scroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }
</style>
    </div>
</section>
<!-- section kontak -->
<section id="contact" class="py-5" style="background-color: #fff;">
  <div class="container">
    <div class="row">
      <!-- Logo SIBESI -->
      <div class="col-md-3 d-flex align-items-center justify-content-center" style="min-height: 100%;">
        <h2 class="fw-bold m-0" style="color: #1E388D;">SIBESI</h2>
      </div>

      <!-- Konten Contact dan Office -->
      <div class="col-md-9">
        <div class="row">
          <!-- Contact -->
          <div class="col-md-5 ms-md-5">
            <h6 class="fw-bold mb-3" style="color: #1E388D;">Contact us !</h6>
            <p class="mb-3">
              <i class="bi bi-envelope me-2" style="color: #1E388D;"></i>
              <a href="mailto:cs@sibesi.co.id" class="text-decoration-none" style="color: #1E388D;">cs@sibesi.co.id</a>
            </p>
            <p class="mb-3">
              <i class="bi bi-telephone me-2" style="color: #1E388D;"></i>
              <a href="tel:02122553321" class="text-decoration-none" style="color: #1E388D;">021-22553321</a>
            </p>
            <p>
              <i class="bi bi-instagram me-2" style="color: #1E388D;"></i>
              <a href="https://instagram.com/sibesi.id" target="_blank" class="text-decoration-none" style="color: #1E388D;">sibesi.id</a>
            </p>
          </div>

          <!-- Office -->
          <div class="col-md-6">
            <h6 class="fw-bold mb-3" style="color: #1E388D;">Office :</h6>
            <p class="mb-0" style="color: #1E388D;">
              Telkom University Kampus C (Manggarai)<br>
              Jl. Manggarai No. 60 Setiabudi, Jakarta<br>
              Selatan, DKI Jakarta
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



@endsection
