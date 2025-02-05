<?php
/*
 Nama file: App/Models/PenjualanModel.php
 Tools : LaravelGhost v1
 Created By : Freddy Wicaksono, M.Kom
 Tanggal : 17-Jun-2024
*/
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class PenjualanModel extends Model
{
    use HasFactory;
    protected $table = 'penjualan';    
    public $timestamps = false;
    protected $fillable = ['nomor_bukti','tanggal','total_pembelian','status_pembayaran'];
}