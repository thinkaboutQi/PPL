@extends('layouts.appuser')

@section('content')
<div class="container-fluid bg-primary-custom min-vh-100 py-5">
  <div class="container">
    <div class="row g-4">
      <!-- Form Section -->
      <div class="col-md-7">
        <form method="POST" action="{{ route('checkout.store') }}">
          @csrf
          <div class="mb-3">
            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required />
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-white">Telephone</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
              <input type="tel" name="telepon" class="form-control" placeholder="08xxxx" required />
            </div>
          </div>
          <div class="mb-3">
  <label class="form-label fw-bold text-white">Provinsi</label>
  <select name="provinsi" class="form-select" required>
    <option value="">-- Pilih Provinsi --</option>
    <option value="Aceh">Aceh</option>
    <option value="Sumatera Utara">Sumatera Utara</option>
    <option value="Sumatera Barat">Sumatera Barat</option>
    <option value="Riau">Riau</option>
    <option value="Jambi">Jambi</option>
    <option value="Sumatera Selatan">Sumatera Selatan</option>
    <option value="Bengkulu">Bengkulu</option>
    <option value="Lampung">Lampung</option>
    <option value="Kepulauan Bangka Belitung">Kepulauan Bangka Belitung</option>
    <option value="Kepulauan Riau">Kepulauan Riau</option>
    <option value="DKI Jakarta">DKI Jakarta</option>
    <option value="Jawa Barat">Jawa Barat</option>
    <option value="Jawa Tengah">Jawa Tengah</option>
    <option value="DI Yogyakarta">DI Yogyakarta</option>
    <option value="Jawa Timur">Jawa Timur</option>
    <option value="Banten">Banten</option>
    <option value="Bali">Bali</option>
    <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
    <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
    <option value="Kalimantan Barat">Kalimantan Barat</option>
    <option value="Kalimantan Tengah">Kalimantan Tengah</option>
    <option value="Kalimantan Selatan">Kalimantan Selatan</option>
    <option value="Kalimantan Timur">Kalimantan Timur</option>
    <option value="Kalimantan Utara">Kalimantan Utara</option>
    <option value="Sulawesi Utara">Sulawesi Utara</option>
    <option value="Sulawesi Tengah">Sulawesi Tengah</option>
    <option value="Sulawesi Selatan">Sulawesi Selatan</option>
    <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
    <option value="Gorontalo">Gorontalo</option>
    <option value="Sulawesi Barat">Sulawesi Barat</option>
    <option value="Maluku">Maluku</option>
    <option value="Maluku Utara">Maluku Utara</option>
    <option value="Papua">Papua</option>
    <option value="Papua Barat">Papua Barat</option>
    <option value="Papua Selatan">Papua Selatan</option>
    <option value="Papua Tengah">Papua Tengah</option>
    <option value="Papua Pegunungan">Papua Pegunungan</option>
    <option value="Papua Barat Daya">Papua Barat Daya</option>
  </select>
</div>

          <div class="mb-3">
            <label class="form-label fw-bold text-white">Alamat Lengkap</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
              <input type="text" name="alamat" class="form-control" placeholder="Alamat Lengkap" required />
            </div>
          </div>
          <input type="hidden" name="quantity" id="inputQuantity" value="{{ request('quantity') }}" />
          <input type="hidden" name="produk_id" value="{{ request('produk_id') }}" />
          <input type="hidden" name="nama_produk" value="{{ request('nama_produk') }}" />
          <input type="hidden" name="harga" value="{{ request('harga') }}" />
          <button type="submit" class="btn btn-primary w-100 mt-3">Place Order</button>
        </form>
      </div>

      <!-- Product Card -->
      <div class="col-md-5">
        <div class="card p-3">
          <div class="d-flex">
          <img src="{{ asset(request('gambar')) }}" alt="Gambar Produk" class="img-fluid rounded me-3" style="max-width: 150px; height: auto;" />
            <div class="card-content">
              <h5>{{ request('nama_produk') }}</h5>
              <div class="d-flex align-items-center mb-2">
                <label class="me-2">Pembelian:</label>
                <button id="btn-minus" class="btn btn-sm btn-outline-secondary" type="button">-</button>
                <input type="text" id="quantity" class="form-control text-center mx-1" value="{{ request('quantity') }}" style="width: 50px;" />
                <button id="btn-plus" class="btn btn-sm btn-outline-secondary" type="button">+</button>
              </div>
              <p id="subtotal">Subtotal: Rp {{ number_format(request('harga') * request('quantity'), 0, ',', '.') }}</p>
              <p id="total">Total: Rp {{ number_format(request('harga') * request('quantity'), 0, ',', '.') }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const minusBtn = document.getElementById("btn-minus");
    const plusBtn = document.getElementById("btn-plus");
    const quantityInput = document.getElementById("quantity");
    const inputQuantity = document.getElementById("inputQuantity");
    const subtotalElem = document.getElementById("subtotal");
    const totalElem = document.getElementById("total");

    const hargaPerGalon = {{ request('harga') }};  // Menggunakan harga dari query parameter

    function updateHarga() {
      let jumlah = parseInt(quantityInput.value);

      if (isNaN(jumlah) || jumlah < 1) {
        jumlah = 1;
      }

      quantityInput.value = jumlah;
      inputQuantity.value = jumlah;

      const subtotal = jumlah * hargaPerGalon;
      subtotalElem.textContent = "Subtotal: Rp " + subtotal.toLocaleString("id-ID");
      totalElem.textContent = "Total: Rp " + subtotal.toLocaleString("id-ID");
    }

    minusBtn.addEventListener("click", function () {
      let jumlah = parseInt(quantityInput.value);
      if (isNaN(jumlah) || jumlah <= 1) {
        jumlah = 1;
      } else {
        jumlah -= 1;
      }
      quantityInput.value = jumlah;
      updateHarga();
    });

    plusBtn.addEventListener("click", function () {
      let jumlah = parseInt(quantityInput.value);
      if (isNaN(jumlah) || jumlah < 1) {
        jumlah = 1;
      } else {
        jumlah += 1;
      }
      quantityInput.value = jumlah;
      updateHarga();
    });

    quantityInput.addEventListener("input", updateHarga);

    updateHarga();
  });
</script>
@endsection
