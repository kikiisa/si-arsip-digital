<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            "uuid" => Uuid::uuid4()->toString(),
            "name" => "Dokumen",
            "slug" => "dokumen",
        ]);
        Kategori::create([
            "uuid" => Uuid::uuid4()->toString(),
            "name" => "Laporan",
            "slug" => "laporan",
        ]);
        Kategori::create([
            "uuid" => Uuid::uuid4()->toString(),
            "name" => "default",
            "slug" => "default",
        ]);
    }
}
