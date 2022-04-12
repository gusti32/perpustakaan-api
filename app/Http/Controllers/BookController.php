<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function list(Request $request)
    {
        $listQuery = DB::table('books');

        // Search with title
        if ($request->title) {
            $listQuery->orWhere('title', 'like', "%{$request->title}%");
        }

        // Search with writer name
        if ($request->writer) {
            $listQuery->orWhere('writer', 'like', "%{$request->writer}%");
        }

        // Search with publisher name
        if ($request->publisher) {
            $listQuery->orWhere('publisher', 'like', "%{$request->publisher}%");
        }

        // Search with category id
        if ($request->category_id) {
            $listQuery->orWhere('category_id', $request->category_id);
        }

        $limit = $request->limit ? $request->limit : 25;
        $page = $request->page ? (int)$request->page : 0;

        // Apply page position & limit
        $bookList = $listQuery->offset($page * $limit)
                              ->limit($limit)
                              ->get();

        return [
            'msg' => 'Berhasil',
            'page' => $page,
            'count' => $bookList->count(),
            'list' => $bookList
        ];
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'title' => 'required|string|max:255',
                'writer' => 'required|string|max:255',
                'publisher' => 'required|string|max:255',
                'publication_year' => 'required|date_format:Y',
                'category_id' => 'required|numeric|exists:categories,id',
            ],
            [
                'title.required' => 'Field title harus diisi.',
                'title.max' => 'Judul buku terlalu panjang (maksimal 255 karakter).',

                'writer.required' => 'Field writer harus diisi.',
                'writer.max' => 'Nama penulis buku terlalu panjang (maksimal 255 karakter).',

                'publisher.required' => 'Field publisher harus diisi.',
                'publisher.max' => 'Nama penerbit buku terlalu panjang (maksimal 255 karakter).',

                'publication_year.required' => 'Field publication_year harus diisi',
                'publication_year.date_format' => 'Tahun terbit tidak valid',

                'category_id.required' => 'Field category_id harus diisi.',
                'category_id.numeric' => 'ID kategori tidak valid.',
                'category_id.exists' => 'ID kategori tidak ditemukan.',
            ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        $book = Book::create($validator->validated());

        return ['msg' => 'Buku berhasil ditambahkan.', 'added' => $book];
    }

    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'id' => 'required|numeric|exists:books,id',
                'title' => 'string|max:255',
                'writer' => 'string|max:255',
                'publisher' => 'string|max:255',
                'publication_year' => 'date_format:Y',
                'category_id' => 'numeric|exists:categories,id',
            ],
            [
                'id.required' => 'Field id harus diisi.',
                'id.numeric' => 'ID buku tidak valid.',
                'id.exists' => 'ID buku tidak ditemukan.',

                'title.max' => 'Judul buku terlalu panjang (maksimal 255 karakter).',
                'writer.max' => 'Nama penulis buku terlalu panjang (maksimal 255 karakter).',
                'publisher.max' => 'Nama penerbit buku terlalu panjang (maksimal 255 karakter).',
                'publication_year.date_format' => 'Tahun terbit tidak valid',
                'category_id.numeric' => 'ID kategori tidak valid.',
                'category_id.exists' => 'ID kategori tidak ditemukan.',
            ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        Book::find($request->id)
            ->update(collect($validator->validated())
                     ->except('id')
                     ->toArray());

        return ['msg' => 'Buku berhasil diubah', 'updated' => Book::find($request->id)];
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(),
            ['id' => 'required|numeric|exists:books,id'],
            [
                'id.required' => 'Field id harus diisi.',
                'id.numeric' => 'ID buku tidak valid.',
                'id.exists' => 'ID buku tidak ditemukan.',
            ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        $book = Book::find($request->id);
        $bookData = $book;
        $book->delete();

        return ['msg' => 'Buku berhasil dihapus', 'deleted' => $bookData];
    }
}
