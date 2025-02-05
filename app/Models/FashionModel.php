<?php
/*
 Nama file: App/Models/BarangModel.php
 Tools : LaravelGhost v1
 Created By : Freddy Wicaksono, M.Kom
 Tanggal : 17-Jun-2024
*/
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class FashionModel extends Model
{
    use HasFactory;
    protected $table = 'fashion';    
    public $timestamps = false;
    protected $fillable = ['kode_fashion','nama_fashion','harga','photo'];

}