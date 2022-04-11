<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Agama',
            'Bahasa',
            'Biografi',
            'Ilmu Pengetahuan',
            'Teknologi',
            'Majalah',
            'Kamus',
            'Novel',
            'Komik',
            'Cerita Bergambar'
        ];

        $insertion = [];

        foreach ($categories as $cat) {
            array_push($insertion, ['name' => $cat]);
        }

        Category::truncate();
        Category::upsert($insertion, ['name']);
    }
}
