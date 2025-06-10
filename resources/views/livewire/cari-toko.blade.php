<div>
    <h4 class="fw-bold mb-3 text-white">Temukan Toko Terdekat!</h4>
    <div class="row g-3 mb-4">

        <!-- Dropdown Provinsi -->
        <div class="col-md-3">
            <select wire:model="provinsi_id" class="form-select" style="border-radius: 10px;">
                <option value="">Pilih Provinsi</option>
                @foreach ($provinsis as $prov)
                    <option value="{{ $prov->id }}">{{ $prov->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown Kabupaten -->
        <div class="col-md-3">
            <select wire:model="kabupaten_id" class="form-select" style="border-radius: 10px;">
                <option value="">Pilih Kabupaten</option>
                @foreach ($kabupatens as $kab)
                    <option value="{{ $kab->id }}">{{ $kab->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown Kecamatan -->
        <div class="col-md-3">
            <select wire:model="kecamatan_id" class="form-select" style="border-radius: 10px;">
                <option value="">Pilih Kecamatan</option>
                @foreach ($kecamatans as $kec)
                    <option value="{{ $kec->id }}">{{ $kec->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Cari -->
        <div class="col-md-3">
        <button id="cari-toko" wire:click="cariToko" class="btn w-100"
        style="background-color: #ffffff; color: #1E38BD; border-radius: 10px;">
        Cari 🔍
    </button>
        </div>

    </div>

    <!-- Tampilkan hasil toko -->
<div>
    @if($tokos->count())
        <ul class="list-group">
            @foreach ($tokos as $toko)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $toko->nama_toko }}</strong><br>
                        {{ $toko->alamat }}<br>
                        Telp: {{ $toko->telepon }}
                    </div>
                    <div>
                        <button
                            wire:click="pilihToko({{ $toko->id }})"
                            class="btn btn-sm"
                            style="background-color: #1E388D; color: #fff;">
                            Pilih Toko
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-white">Belum ada toko yang ditemukan.</p>
    @endif
</div>

