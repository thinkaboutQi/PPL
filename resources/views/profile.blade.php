@extends('layouts.appuser')

@section('content')
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile - SIBESI</title>

  <!-- Bootstrap 5 CSS & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f5f5f5;
      color: #000000;
    }

    .nav-link.active {
      color: white !important;
    }

    .profile-card, .settings-card {
      background-color: #133D91;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      color: white;
    }

    .profile-img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
    }

    .edit-btn {
      background-color: white;
      color: #133D91;
      border: none;
      border-radius: 8px;
      font-weight: bold;
    }

    .edit-btn:hover {
      background-color: #e0e0e0;
    }

    .setting-item i {
      width: 25px;
    }

    .order-box {
      background-color: #ffffff;
      color: #000000;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .setting-button {
      background: none;
      border: none;
      color: white;
      display: flex;
      align-items: center;
      width: 100%;
      padding: 0.75rem 1rem;
      margin-bottom: 1rem;
      text-align: left;
      border-radius: 0.5rem;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .setting-button:hover {
      background-color: rgba(255, 255, 255, 0.1);
      transform: scale(1.02);
      cursor: pointer;
    }

    .setting-button:active {
      transform: scale(0.98);
    }


    /* ===================== DARK MODE ===================== */
    body.dark-mode {
      background-color: #121212;
      color: #ffffff;
    }

    .dark-mode .profile-card,
    .dark-mode .settings-card,
    .dark-mode .order-box {
      background-color: #1e1e1e;
      color: #ffffff;
    }

    .dark-mode .edit-btn {
      background-color: #ffffff;
      color: #133D91;
    }

    .dark-mode .form-control {
      background-color: #2c2c2c;
      color: #ffffff;
      border: 1px solid #444;
    }

    .dark-mode .form-label,
    .dark-mode label,
    .dark-mode .setting-item {
      color: #ffffff;
    }

    .dark-mode .form-control::placeholder {
      color: #cccccc;
    }

    .dark-mode .btn-light {
      background-color: #ffffff;
      color: #133D91;
    }
  </style>
</head>

<body>
<div class="container mt-4">
  <h3 class="mb-3 fw-bold">Profile</h3>

  <div class="p-4 profile-card d-flex justify-content-between align-items-center flex-wrap mb-4">
    <div class="d-flex align-items-center">
      <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://via.placeholder.com/120' }}" alt="Foto Profil" class="profile-img me-4">
      <div>
        <h4 class="mb-1 fw-bold">{{ $user->name }}</h4>
        <p class="mb-1">{{ $user->email }}</p>
        <p class="mb-1">{{ $user->phone_number ?? '-' }}</p>
        <small>ID MEMBER : {{ $user->member_id ?? '-' }}</small>
      </div>
    </div>
    <button class="btn edit-btn mt-3 mt-md-0" onclick="toggleEditForm()">Edit Profile</button>
  </div>

  <!-- Form Edit -->
  <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-4 profile-card mb-4" style="display: none;">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" name="name" class="form-control" value="{{ $user->name }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="{{ $user->email }}">
    </div>
    <div class="mb-3">
      <label class="form-label">No Telepon</label>
      <input type="text" name="phone_number" class="form-control" value="{{ $user->phone_number }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Foto Profil</label>
      <input type="file" name="profile_image" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <input type="text" name="alamat" class="form-control" value="{{ $user->alamat }}">
    </div>
    <button type="submit" class="btn btn-light">Simpan Perubahan</button>
  </form>

  <h3 class="mb-3 fw-bold">Pengaturan</h3>
  <div class="p-4 settings-card mb-4">
    <button id="darkModeBtn" class="btn text-white d-flex align-items-center p-0 setting-item w-100 mb-3" style="background: none; border: none;">
      <i class="bi bi-moon-fill me-2"></i> Dark mode
    </button>
    <button id="addressBtn" class="setting-button flex-column align-items-start text-white">
      <div>
        <i class="bi bi-geo-alt-fill me-2"></i> Alamat Tersimpan
      </div>
      <small id="addressContainer" class="ms-4 text-white-50"></small>
    </button>
    <button id="helpCenterBtn" class="btn text-white d-flex align-items-center p-0 setting-item w-100 mb-3" style="background: none; border: none;">
      <i class="bi bi-question-circle-fill me-2"></i> Pusat Bantuan
    </button>
    <button id="securityBtn" class="btn text-white d-flex align-items-center p-0 setting-item w-100 mb-3" style="background: none; border: none;">
      <i class="bi bi-shield-lock-fill me-2"></i> Keamanan akun
    </button>
    <button id="termsBtn" class="btn text-white d-flex align-items-center p-0 setting-item w-100 mb-3" style="background: none; border: none;">
      <i class="bi bi-file-earmark-text-fill me-2"></i> Syarat & Ketentuan
    </button>
    <button id="logoutBtn" class="btn text-white d-flex align-items-center p-0 setting-item w-100" style="background: none; border: none;">
      <i class="bi bi-box-arrow-right me-2"></i> Log out
    </button>

    <!-- Form Logout -->
    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </div>

  <!-- Order Saya -->
  <div class="order-box mb-4">
    <h4 class="fw-bold">Order Saya</h4>
    <p>Belum ada pesanan yang diproses.</p>
  </div>
</div>

<!-- JS Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  function toggleEditForm() {
    const form = document.getElementById('editProfileForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
  }

  // Dark Mode Toggle
  document.getElementById('darkModeBtn').addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
  });

  // Alamat Tersimpan
  document.getElementById('addressBtn').addEventListener('click', () => {
  const addressContainer = document.getElementById('addressContainer');
  const isVisible = addressContainer.textContent.trim() !== '';

  if (!isVisible) {
    addressContainer.textContent = '{{ $user->alamat }}'; // ganti dengan $user->alamat jika pakai Blade
  } else {
    addressContainer.textContent = '';
  }
});


  // Pusat Bantuan
  document.getElementById('helpCenterBtn').addEventListener('click', () => {
    alert('Membuka pusat bantuan...');
  });

  // Keamanan Akun
  document.getElementById('securityBtn').addEventListener('click', () => {
    alert('Membuka pengaturan keamanan...');
  });

  // Syarat & Ketentuan
  document.getElementById('termsBtn').addEventListener('click', () => {
    alert('Menampilkan syarat & ketentuan...');
  });

  // Logout
  document.getElementById('logoutBtn').addEventListener('click', () => {
    if (confirm('Apakah Anda yakin ingin logout?')) {
      document.getElementById('logoutForm').submit();
    }
  });

  // Load dark mode preference
  document.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem('darkMode') === 'true') {
      document.body.classList.add('dark-mode');
    }
  });
</script>
</body>
@endsection
