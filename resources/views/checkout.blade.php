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
            <input type="text" name="provinsi" class="form-control" placeholder="Provinsi" required />
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-white">Alamat Lengkap</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
              <input type="text" name="alamat" class="form-control" placeholder="Alamat Lengkap" required />
            </div>
          </div>
          <input type="hidden" name="quantity" id="inputQuantity" value="1" />
          <button type="submit" class="btn btn-primary w-100 mt-3">Place Order</button>
        </form>
      </div>

      <!-- Product Card -->
      <div class="col-md-5">
        <div class="card p-3">
          <div class="d-flex">
            <img src="https://assets.onecompiler.app/42vbxdd3a/43feyvfsw/images.jpg" alt="Galon" class="img-fluid rounded me-3" />
            <div class="card-content">
              <h5>Galon Air Bersih</h5>
              <div class="d-flex align-items-center mb-2">
                <label class="me-2">Pembelian:</label>
                <button id="btn-minus" class="btn btn-sm btn-outline-secondary" type="button">-</button>
                <input type="text" id="quantity" class="form-control text-center mx-1" value="1" style="width: 50px;" />
                <button id="btn-plus" class="btn btn-sm btn-outline-secondary" type="button">+</button>
              </div>
              <p id="subtotal">Subtotal: -</p>
              <p id="total">Total: -</p>
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

    const hargaPerGalon = 10000;

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
