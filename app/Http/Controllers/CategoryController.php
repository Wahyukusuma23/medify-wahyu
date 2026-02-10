<?php

namespace App\Http\Controllers;

use App\Models\MasterItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class CategoryController extends Controller
{
    public function index()
    {
        return view('master_category.index.index');
    }

    public function search(Request $request)
    {
        $kode = $request->kode;
        $nama = $request->nama;

        $data_search = Category::query();

        if (!empty($kode)) $data_search = $data_search->where('kode', $kode);
        if (!empty($nama)) $data_search = $data_search->where('name', 'LIKE', '%' . $nama . '%');

        $data_search = $data_search->select('kode', 'name')->orderBy('id')->get();


        return json_encode([
            'status' => 200,
            'data' => $data_search
        ]);
    }

    public function formView($method, $id = 0)
    {
        if ($method == 'new') {
            $item = [];
        } else {
            $item = Category::find($id);
        }
        $data['item'] = $item;
        $data['method'] = $method;
        return view('master_category.form.index', $data);
    }

    public function singleView($kode)
    {
        $data['data'] = Category::with('items')->where('kode', $kode)->first();
        return view('master_category.single.index', $data);
    }

    public function formSubmit(Request $request, $method, $id = 0)
    {
        if ($method == 'new') {
            $data_item = new Category;
            $kode = Category::count('id');
            $kode = $kode + 1;
            $kode = str_pad($kode, 5, '0', STR_PAD_LEFT);
            $data_item->kode = $kode;
            sleep(3);
        } else {
            $data_item = Category::find($id);
        }

        $data_item->name = $request->category_name;
        $data_item->save();

        return redirect('category-items');
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        return redirect('category-items');
    }

    public function updateRandomData()
    {
        $data = Category::get();
        foreach($data as $item)
        {
            $kode = $item->id;
            $kode = str_pad($kode, 5, '0', STR_PAD_LEFT);

            $item->harga_beli = rand(100,1000000);
            $item->laba = rand(10,99);
            $item->kode = $kode;
            $item->supplier = $this->getRandomSupplier();
            $item->jenis = $this->getRandomJenis();
            $item->save();
        }
    }

    private function getRandomSupplier()
    {
        $array = ['Tokopaedi','Bukulapuk','TokoBagas','E Commurz','Blublu'];
        $random = rand(0,4);
        return $array[$random];
    }

    private function getRandomJenis()
    {
        $array = ['Obat','Alkes','Matkes','Umum','ATK'];
        $random = rand(0,4);
        return $array[$random];
    }
    public function exportPdf($id)
    {
        $data = Category::with('items')->findOrFail($id);

        $pdf = Pdf::loadView('master_category.print_pdf.index', compact('data'))->setPaper('a4', 'portrait');

        return $pdf->stream('products.pdf');
    }
}
