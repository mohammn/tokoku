<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{

    protected $table = "barang";
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'netto', 'stok', 'harga', 'hargaKulak'];
}
