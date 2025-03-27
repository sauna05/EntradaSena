<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\LinkType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinkTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      LinkType::create([
        "name" => "Instructor de Planta"
      ]);

      LinkType::create([
        "name" => "Instructor Contratista"
      ]);

      LinkType::create([
        "name" => "Carrera Administrativa"
      ]);
  }
}
