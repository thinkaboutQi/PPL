<?php

namespace App\Livewire;

use Livewire\Component;

class OrderForm extends Component
{
    public $toko_pengirim = '';
    public $alamat = '';
    public $produk = [];

    protected $listeners = ['setTokoPengirim'];

    public function mount($produk = [])
    {
        $this->produk = $produk;
        $this->toko_pengirim = session('order.toko_pengirim', '');
    }

    public function setTokoPengirim($detailToko)
    {
        $this->toko_pengirim = $detailToko;
        session(['order.toko_pengirim' => $detailToko]);
    }

    public function submit()
    {
        session([
            'order.alamat' => $this->alamat,
            'order.toko_pengirim' => $this->toko_pengirim,
            'order.detail_toko' => $this->toko_pengirim, // WAJIB ADA
            // ...data order lain...
        ]);

        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.order-form');
    }
}
