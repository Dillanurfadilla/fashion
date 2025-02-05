<?php
/*
 Nama file: App/Models/PenjualandetailModel.php
 Tools : LaravelGhost v1
 Created By : Freddy Wicaksono, M.Kom
 Tanggal : 17-Jun-2024
*/
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class PenjualandetailModel extends Model
{
    use HasFactory;
    protected $table = 'penjualandetail';    
    public $timestamps = false;
    protected $fillable = ['penjualan_id','kode_fashion','qty','harga','subtotal'];
    
    public function fashion()
    {
        return $this->belongsTo(FashionModel::class, 'kode_fashion','kode_fashion');
    }
    public function penjualan()
    {
        return $this->belongsTo(PenjualanModel::class, 'penjualan_id','id');
    }
}