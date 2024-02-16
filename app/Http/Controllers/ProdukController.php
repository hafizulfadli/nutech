<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Exports\ProdukExport;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;


class ProdukController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
     public function index()
    {
        $data['kategori'] = DB::table('kategoris')->get();
        $data['produk']   = DB::table('produks')
                            ->select('*','produks.id as id')
                            ->join('kategoris','kategoris.id','produks.id_kategori')
                            ->get();

        return view('admin.produk.index',$data);
    }
     public function produkKategori($id)
    {
        $data['kategori'] = DB::table('kategoris')->get();
        $data['produk']   = DB::table('produks')
                            ->select('*','produks.id as id')
                            ->join('kategoris','kategoris.id','produks.id_kategori')
                            ->where('produks.id_kategori',$id)
                            ->get();

        return view('admin.produk.index',$data);
    }

    public function exportExcel(){
        return Excel::download(new ProdukExport, 'produk.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['kategori'] = DB::table('kategoris')->get();
        return view('admin.produk.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request ->validate([
            'id_kategori' => 'required',
            'nama_produk' => 'required|unique:produks,nama_produk',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'image' => 'required|mimes:jpg,png|max:100',

        ],[
            'id_kategori.required' => 'Kategori wajib diisi.',
            'nama_produk.required' => 'Nama barang wajib diisi.',
            'nama_produk.unique' => 'Nama barang harus unik.',
            'harga_beli.required' => 'Harga beli wajib diisi.',
            'harga_beli.numeric' => 'Harga beli harus dalam bentuk numerik.',
            'harga_jual.required' => 'Harga jual wajib diisi.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.numeric' => 'Stok harus dalam bentuk numerik.',
            'image.required' => 'Gambar wajib diunggah.',
            'image.mimes' => 'Format gambar hanya boleh PNG atau JPG.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 100 KB.',
        ]);
        $file = Request()->image;
        $fileName = time() . '.' . $file->extension();
        $file->move(public_path('image'), $fileName);

        DB::table('produks')->insert([
            'id_kategori' => $request->id_kategori,
            'nama_produk' => $request->nama_produk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'image' => $fileName
        ]);
        return redirect()->route('produk.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['kategori'] = DB::table('kategoris')->get();
        $data['produk']   = DB::table('produks')
                            ->where('id',$id)
                            ->first();
        return view('admin.produk.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama_produk' => ['required', Rule::unique('produks')->ignore($id)],
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'image' => 'nullable|mimes:jpg,png|max:100',
        ], [
            'id_kategori.required' => 'Kategori wajib diisi.',
            'nama_produk.required' => 'Nama barang wajib diisi.',
            'nama_produk.unique' => 'Nama barang harus unik.',
            'harga_beli.required' => 'Harga beli wajib diisi.',
            'harga_beli.numeric' => 'Harga beli harus dalam bentuk numerik.',
            'harga_jual.required' => 'Harga jual wajib diisi.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.numeric' => 'Stok harus dalam bentuk numerik.',
            'image.mimes' => 'Format gambar hanya boleh PNG atau JPG.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 100 KB.',
        ]);

        $data = [
            'id_kategori' => $request->id_kategori,
            'nama_produk' => $request->nama_produk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
        ];

        if ($request->hasFile('image')) {
            $imageLama = DB::table('produks')->where('id', $id)->value('image');
            if ($imageLama) {
                Storage::delete('public/image/' . $imageLama);
            }
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/image', $fileName);
            $data['image'] = $fileName;
        }

        DB::table('produks')->where('id', $id)->update($data);

        return redirect()->route('produk.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = DB::table('produks')->where('id', $id)->first();

    if ($produk) {
        if ($produk->image && File::exists(public_path('image') . '/' . $produk->image)) {
            File::delete(public_path('image') . '/' . $produk->image);
        }
        DB::table('produks')->where('id', $id)->delete();
        return redirect()->route('produk.index');
    } else {
        return redirect()->route('produk.index')->with('error', 'gagal menghapus data');
    }
    }
}
