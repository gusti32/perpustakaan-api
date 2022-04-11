<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function get(Request $request)
    {
        if ($request->name) {
            return Category::where('name', 'like', "%{$request->name}%")->get();
        }

        return Category::get();
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(),
                ['name' => 'required|string|unique:categories,name'],
                [
                    'name.required' => 'Field name harus diisi.',
                    'name.unique' => 'Nama kategori sudah terdaftar, silakan masukkan nama yang berbeda.',
                ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        $cat = Category::create(['name' => $request->name]);

        return [
            'msg' => 'Kategori berhasil ditambahkan.',
            'added' => $cat
        ];
    }

    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'id' => 'required|numeric|exists:categories,id',
                'name' => 'required|string|unique:categories,name'
            ],
            [
                'id.required' => 'Field id harus diisi.',
                'id.numeric' => 'ID tidak valid.',
                'id.exists' => 'ID tidak ditemukan.',

                'name.required' => 'Field name harus diisi.',
                'name.unique' => 'Nama kategori sudah terdaftar, silakan masukkan nama yang berbeda.'
            ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        $cat = Category::where('id', $request->id);
        $cat->update(['name' => $request->name]);

        return ['msg' => 'Kategori berhasil diubah.', 'updated' => $cat->get()];
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(),
            ['id' => 'required|numeric|exists:categories,id'],
            [
                'id.required' => 'Field id harus diisi.',
                'id.numeric' => 'ID tidak valid.',
                'id.exists' => 'ID tidak ditemukan.',
            ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        $cat = Category::find($request->id);
        $catData = $cat;
        $cat->delete();

        return ['msg' => 'Kategori berhasil dihapus', 'deleted' => $catData];
    }
}
