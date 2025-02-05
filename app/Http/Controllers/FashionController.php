<?php
namespace App\Http\Controllers;

use App\Models\FashionModel;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FashionController extends Controller
{
    public function index(Request $request): View
    {
        $page = $request->input('page', 1);
        $perPage = 10;
        $data['fashion'] = FashionModel::orderBy('id', 'desc')->paginate($perPage);
        $total = FashionModel::count();
        $totalPages = ceil($total / $perPage);
        $data['totalpages'] = $totalPages;
        return view('fashion.index', $data);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $fsh = FashionModel::where('nama_fashion', 'LIKE', "%{$query}%")->limit(10)->get();
        return response()->json($fsh);
    }

    public function create(): View
    {
        return view('fashion.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'kode_fashion' => 'required|unique:fashion,kode_fashion',
            'nama_fashion' => 'required',
            'harga' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['photo'] = $imageName;
        }

        FashionModel::create($validatedData);

        return redirect()->route('fashion.index')
            ->with('success', 'Fashion item has been created successfully.');
    }

    public function show(FashionModel $fashion): View
    {
        return view('fashion.show', compact('fashion'));
    }

    public function edit(FashionModel $fashion): View
    {
        return view('fashion.edit', compact('fashion'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'kode_fashion' => 'required|unique:fashion,kode_fashion,' . $id,
            'nama_fashion' => 'required',
            'harga' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
        ]);

        $fashion = FashionModel::find($id);
        if (!$fashion) {
            return redirect()->route('fashion.index')
                ->with('error', 'Fashion item not found');
        }

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['photo'] = $imageName;
        }

        $fashion->update($validatedData);

        return redirect()->route('fashion.index')
            ->with('success', 'Fashion item has been updated successfully.');
    }

    public function destroy(FashionModel $fashion): RedirectResponse
    {
        $fashion->delete();
        return redirect()->route('fashion.index')
            ->with('success', 'Fashion item has been deleted successfully.');
    }
}
