<div>
    <form wire:submit.prevent="submit">
        <div class="mb-3">
            <label for="fromLocation" class="form-label">Alamat</label>
            <input type="text" id="fromLocation" name="alamat" class="form-control"
                wire:model="alamat" placeholder="Enter location" required>
        </div>
        <div class="mb-3">
            <label for="toko_pengirim" class="form-label">Toko Pengirim</label>
            <input type="text" id="toko_pengirim" name="toko_pengirim" class="form-control"
                wire:model="toko_pengirim" readonly>
        </div>
        <!-- Produk dan quantity, dsb -->
        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
    <div>
        {{-- The best athlete wants his opponent at his best. --}}
    </div>
</div>
