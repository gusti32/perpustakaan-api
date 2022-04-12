<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function list(Request $request)
    {
        if ($request->id) {
            return [
                'msg' => 'Berhasil',
                'list' => Category::find($request->id)
            ];
        }
        else if ($request->name) {
            return [
                'msg' => 'Berhasil',
                'list' => Category::where('name', 'like', "%{$request->name}%")->get()
            ];
        }

        return ['msg' => 'Berhasil', 'list' => Category::get()];
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
                'name' => 'required|string'
            ],
            [
                'id.required' => 'Field id harus diisi.',
                'id.numeric' => 'ID kategori tidak valid.',
                'id.exists' => 'ID kategori tidak ditemukan.',

                'name.required' => 'Field name harus diisi.'
            ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        // Find category with similar name
        $sameCategory = Category::where('id', '!=', $request->id)
            ->where('name', $request->name)
            ->count() > 0;

        // Reject editing if a category with a similar name is found
        if ($sameCategory) {
            return ['errors' => ['name' => 'Nama kategori sudah terdaftar, silakan masukkan nama yang berbeda.']];
        }

        $cat = Category::find($request->id);
        $cat->update(['name' => $request->name]);

        return ['msg' => 'Kategori berhasil diubah.', 'updated' => Category::find($request->id)];
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(),
            ['id' => 'required|numeric|exists:categories,id'],
            [
                'id.required' => 'Field id harus diisi.',
                'id.numeric' => 'ID kategori tidak valid.',
                'id.exists' => 'ID kategori tidak ditemukan.',
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
