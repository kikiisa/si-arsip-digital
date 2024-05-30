<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pegawai::create([
            "uuid" => Uuid::uuid4()->toString(),
            "nip" => "T3119051",
            "name" => "Mohamad Rizky Isa S.Kom",
            "username" => "kiki",
            "email" => "kikiisa89@gmail.com",
            "password" => bcrypt("kiki123"),
            "status" => "active",
        ]);

        User::create([
            "uuid" => Uuid::uuid4()->toString(),
            "name" => "Admin",
            "username" => "admin",
            "email" => "admin@admin",
            "password" => bcrypt("admin123"),
        ]);

        // 


    }
}
