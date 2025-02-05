<?php
/*
 Nama file: App\Http\Controllers\PenjualandetailController.php
 Tools : LaravelGhost v1
 Created By : Freddy Wicaksono, M.Kom
 Tanggal : 20-Jun-2024
*/
namespace App\Http\Controllers;

use App\Models\PenjualandetailModel;
use App\Models\PenjualanModel;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
class PenjualandetailController extends Controller
{
    public function list(Request $request, $id)
    {
        // Enable query log
        DB::enableQueryLog();

        // Build the query
        $query = PenjualandetailModel::where('penjualan_id', $id)->with('fashion');
        $penjualan = PenjualanModel::where('id', $id)->get();
        // Get the SQL query string and bindings
        $sql = $query->toSql();
        $bindings = $query->getBindings();

        // Execute the query
        $data['penjualandetail'] = $query->get();
        if ($data['penjualandetail']->isEmpty()) {
            $empty = 'Belum ada Data';
        } else {
            $empty = '';
        }
        // Get the executed queries
        $queries = DB::getQueryLog();
        
        // Pass the data to the view
        return view('penjualandetail.list', [
            'penjualandetail' => $data['penjualandetail'],
            'penjualan' => $penjualan,
            'sql' => $sql,
            'id' => $id,
            'empty' => $empty,
            'bindings' => $bindings,
            'queries' => $queries
        ]);
    }

    public function create($id) : view
    {
        return view('penjualandetail.create',['id' => $id]);
    }    
    
    public function store(Request $request) : RedirectResponse
    {
        $validatedData = $request->validate([
          'penjualan_id' => 'required',
          'kode_fashion' => 'required',
          'qty' => 'required',
          'harga' => 'required',
          'subtotal' => 'required',

        ]);


        $penjualandetail = new PenjualandetailModel; 
        $penjualandetail->penjualan_id = $request->penjualan_id;
        $penjualandetail->kode_fashion = $request->kode_fashion;
        $penjualandetail->qty = $request->qty;
        $penjualandetail->harga = $request->harga;
        $penjualandetail->subtotal = $request->subtotal;

        $penjualandetail->save();  
        
        // Update total_pembelian in PenjualanModel
        $this->updateTotalPembelian($penjualandetail->penjualan_id, $penjualandetail->subtotal);


        return redirect()->route('penjualandetail.list', ['id' => $request->penjualan_id])
                        ->with('success', 'penjualandetail has been created successfully.');
    }

    private function updateTotalPembelian($penjualanId, $subtotal)
    {
        $penjualan = PenjualanModel::findOrFail($penjualanId);

        // Get the current value of total_pembelian
        $currentTotalPembelian = $penjualan->total_pembelian;

        // Add the new subtotal to the current total_pembelian
        $newTotalPembelian = $currentTotalPembelian + $subtotal;

        // Update the total_pembelian field
        $penjualan->total_pembelian = $newTotalPembelian;
        $penjualan->save();
    }

    public function setLunas($penjualanId)
    {
        $penjualan = PenjualanModel::findOrFail($penjualanId);

        // Update the status_pembayaran field
        $penjualan->status_pembayaran = 'LUNAS';
        $penjualan->save();

        return redirect()->route('penjualandetail.list', ['id' => $penjualanId])
                     ->with('success', 'Penjualan has been set to Lunas successfully.');
    }
        
    public function destroy($detail_id, $penjualan_id): RedirectResponse
    {
        $penjualandetail = PenjualandetailModel::where('id', $detail_id)->first();
        $subtotal = -1 * $penjualandetail->subtotal;
        $penjualandetail->delete();  
        // Update total_pembelian in PenjualanModel
        $this->updateTotalPembelian($penjualandetail->penjualan_id, $subtotal);  
        return redirect()->route('penjualandetail.list', ['id' => $penjualan_id])
                        ->with('success', 'penjualandetail has been deleted successfully.');
    }
}