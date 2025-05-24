<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Depot;

class CariToko extends Component
{
    public $provinsis;
    public $kabupatens;
    public $kecamatans;
    public $tokos;

    public $provinsi_id = null;
    public $kabupaten_id = null;
    public $kecamatan_id = null;

    public function mount()
    {
        // Load semua data sekaligus
        $this->provinsis = Provinsi::all();
        $this->kabupatens = Kabupaten::all();
        $this->kecamatans = Kecamatan::all();
        $this->tokos = collect(); // kosong di awal
    }

    public function cariToko()
    {
        $query = Depot::query();

        if ($this->provinsi_id) {
            $query->where('provinsi_id', $this->provinsi_id);
        }

        if ($this->kabupaten_id) {
            $query->where('kabupaten_id', $this->kabupaten_id);
        }

        if ($this->kecamatan_id) {
            $query->where('kecamatan_id', $this->kecamatan_id);
        }

        $this->tokos = $query->get();
    }

    public function render()
    {
        return view('livewire.cari-toko');
    }
}
