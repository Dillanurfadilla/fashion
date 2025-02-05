<?php
/*
 Nama file: App\Http\Controllers\PenjualanController.php
 Tools : LaravelGhost v1
 Created By : Freddy Wicaksono, M.Kom
 Tanggal : 17-Jun-2024
*/
namespace App\Http\Controllers;
use App\Models\PenjualanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
class PenjualanController extends Controller
{
    public function index(Request $request) : view
    {
        $page = $request->input('page', 1);
        $perPage = 5;
        $data['penjualan'] = PenjualanModel::orderBy('id','desc')->paginate(5); 
        $total = PenjualanModel::count();
        $totalPages = ceil($total / $perPage); 
        $data['totalpages']=$totalPages;
        return view('penjualan.index', $data);
    }
    public function create() : view
    {
        $today = carbon::today()->toDateString();
        $timestamp = time();
        $nomor_bukti = 'FS-'. $timestamp;
        return view('penjualan.create', compact('today','nomor_bukti'));
    }
     
    
    public function store(Request $request) : RedirectResponse
    {
        // Ensure that the fields are set to 0 if they are not provided
        $request->merge([
            'total_pembelian' => $request->input('total_pembelian', 0),
           
            'status_pembayaran' => 'PIUTANG',
        ]);

        // Validate the request data
        $validatedData = $request->validate([
            'nomor_bukti' => 'required',
            'tanggal' => 'required',
            
            'total_pembelian' => 'nullable|numeric',
            
            'status_pembayaran' => 'nullable',
        ]);

        // Create and save the PenjualanModel instance
        $penjualan = new PenjualanModel; 
        $penjualan->nomor_bukti = $validatedData['nomor_bukti'];
        $penjualan->tanggal = $validatedData['tanggal'];
        $penjualan->total_pembelian = $validatedData['total_pembelian'];
        $penjualan->status_pembayaran = $validatedData['status_pembayaran'];
        $penjualan->save();     

        return redirect()->route('penjualan.index')
                        ->with('success','penjualan has been created successfully.');
    }

       
    public function show(PenjualanModel $penjualan) : view
    {
        return view('penjualan.show',compact('penjualan'));
    } 
      
    
    public function edit(PenjualanModel $penjualan) : view
    {
        return view('penjualan.edit',compact('penjualan'));
    }
     
    
    public function update(Request $request, $id) : RedirectResponse
    {
        $request->validate([
          'nomor_bukti' => 'required',
          'tanggal' => 'required',
         
          'total_pembelian' => 'required',
          
          'status_pembayaran' => 'required',
        ]);

        
        $penjualan = PenjualanModel::find($id); 
        // Check if penjualan exists
        if (!$penjualan) {
            return redirect()->route('penjualan.index')
                            ->with('error', 'Penjualan not found');
        }
        $penjualan->nomor_bukti= $request->nomor_bukti;
        $penjualan->tanggal= $request->tanggal;
        
        $penjualan->total_pembelian= $request->total_pembelian;
        
        $penjualan->status_pembayaran= $request->status_pembayaran;
        $penjualan->save();
     
        return redirect()->route('penjualan.index')
                         ->with('success','penjualan Has Been updated successfully');
    }
     
    
    public function destroy(PenjualanModel $penjualan) : RedirectResponse
    {
        $penjualan->delete();    
        return redirect()->route('penjualan.index')
                        ->with('success','penjualan has been deleted successfully');
    }
}