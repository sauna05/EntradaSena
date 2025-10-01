<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Classroom;
use App\Models\DbProgramacion\Town;
use App\Models\DbProgramacion\Block;
use Illuminate\Database\Seeder;


class ClassRoomSeeder extends Seeder
{
    public function run(): void
    {
        $classroomsData = [
            // FONSECA
            ['Casa Blanca 1', 'Fonseca', 'Casa Blanca'],
            ['B1 Multimedia y Sistemas A1', 'Fonseca', 'B1'],
            ['B1 Multimedia y Sistemas B2', 'Fonseca', 'B1'],
            ['B1 Aula 3', 'Fonseca', 'B1'],
            ['B1 Aula 4', 'Fonseca', 'B1'],
            ['B1 Aula 1', 'Fonseca', 'B1'],
            ['B1 Aula 2', 'Fonseca', 'B1'],
            ['B4 Aula 1', 'Fonseca', 'B4'],
            ['B4 Aula A2', 'Fonseca', 'B4'],
            ['B4 Aula B3', 'Fonseca', 'B4'],
            ['B4 Aula 3', 'Fonseca', 'B4'],
            ['B6 Topografia 6a', 'Fonseca', 'B6'],
            ['B6 Aula Sig 6b', 'Fonseca', 'B6'],
            ['B6 Sala Tic Bilinguismo', 'Fonseca', 'B6'],
            ['B6 Aula a', 'Fonseca', 'B6'],
            ['B7 Aula 1 Producción ganadera 7b', 'Fonseca', 'B7'],
            ['B7 Aula 2', 'Fonseca', 'B7'],
            ['B7 Aula 3', 'Fonseca', 'B7'],
            ['B7 Aula 4 Acuicultura 7e', 'Fonseca', 'B7'],
            ['B7 Aula 5', 'Fonseca', 'B7'],
            ['B7 Aula 6 Construccion 7i', 'Fonseca', 'B7'],
            ['B7 Aula 7', 'Fonseca', 'B7'],
            ['B7 Aula 8 Servicios Recreativos 7g', 'Fonseca', 'B7'],
            ['B7 Aula 9 Gestion Integrada 7f (reparación)', 'Fonseca', 'B6'],
            ['B7 Aula 9', 'Fonseca', 'B7'],
            ['B7 Aula 4', 'Fonseca', 'B7'],
            ['B7 Aula 6', 'Fonseca', 'B7'],
            ['B7 Aula 1', 'Fonseca', 'B7'],
            ['B8 Aula 1', 'Fonseca', 'B8'],
            ['B8 Aula 2', 'Fonseca', 'B8'],
            ['B8 Aula 3', 'Fonseca', 'B8'],
            ['B8 Aula 4', 'Fonseca', 'B8'],
            ['B8 Aula 5', 'Fonseca', 'B8'],
            ['B8 Aula 6', 'Fonseca', 'B8'],
            ['B8 Aula 7', 'Fonseca', 'B8'],
            ['B8 Aula 8', 'Fonseca', 'B8'],
            ['B8 Aula 9', 'Fonseca', 'B8'],
            ['B8 Aula 11', 'Fonseca', 'B8'],
            ['B8 Aula 12', 'Fonseca', 'B8'],
            ['B8 Aula 13', 'Fonseca', 'B8'],
            ['B8 Aula 14', 'Fonseca', 'B8'],
            ['B8 Aula TIC 2 ADSO', 'Fonseca', 'B8'],
            ['B8 TIC 2', 'Fonseca', 'B8'],
            ['B9 Aula 1', 'Fonseca', 'B9'],
            ['B9 Aula 2', 'Fonseca', 'B9'],
            ['B9 Aula 3', 'Fonseca', 'B9'],
            ['B9 Aula TIC 1 ADSO', 'Fonseca', 'B9'],
            ['B9 Aula de Corte', 'Fonseca', 'B9'],
            ['B9 Aula 4', 'Fonseca', 'B9'],
            ['B9 TIC 1', 'Fonseca', 'B9'],
            ['B2 Taller de Confecciones', 'Fonseca', 'B2'],
            ['B9 Taller de Cocina', 'Fonseca', 'B9'],
            ['B9 Taller Mesa y Bar', 'Fonseca', 'B9'],
            ['B9 Taller de Confección', 'Fonseca', 'B9'],
            ['B9 Taller de Diseño', 'Fonseca', 'B9'],
            ['B9 Taller de Multimedia', 'Fonseca', 'B9'],
            ['Bilinguismo', 'Fonseca', 'Bilinguismo'],
            ['Comegenes 1', 'Fonseca', 'Comegenes'],
            ['Comegenes 2', 'Fonseca', 'Comegenes'],
            ['Bobino', 'Fonseca', 'Bobino'],
            ['Biblioteca CAA 1', 'Fonseca', 'Biblioteca'],
            ['Biblioteca CAA 2', 'Fonseca', 'Biblioteca'],
            ['Acuicola 1 Fonseca', 'Fonseca', 'Acuicola'],
            ['Ambiente 5', 'Fonseca', 'General'],

            // RIOHACHA
            ['104 Villa Campo Alegre', 'Riohacha', 'Villa Campo Alegre'],
            ['105 Villa Campo Alegre', 'Riohacha', 'Villa Campo Alegre'],
            ['106 Villa Campo Alegre', 'Riohacha', 'Villa Campo Alegre'],
            ['107 Villa Campo Alegre', 'Riohacha', 'Villa Campo Alegre'],
            ['108 Villa Campo Alegre', 'Riohacha', 'Villa Campo Alegre'],
            ['109 Villa Campo Alegre', 'Riohacha', 'Villa Campo Alegre'],
            ['111 Villa Campo Alegre', 'Riohacha', 'Villa Campo Alegre'],
            ['Acuicola 1 Rioacha', 'Riohacha', 'Acuicola'],
            ['Acuicola 2 Riohacha', 'Riohacha', 'Acuicola'],

            // MAICAO
            ['Alcaldia Maicao', 'Maicao', 'Alcaldia'],
            ['Biblioteca Maicao', 'Maicao', 'Biblioteca'],
            ['Alcaldia Maicao A1', 'Maicao', 'Alcaldia'],
            ['Alcaldia Maicao A2', 'Maicao', 'Alcaldia'],
            ['Alcaldia Maicao A3', 'Maicao', 'Alcaldia'],
            ['Biblioteca Maicao A1', 'Maicao', 'Biblioteca'],
            ['Biblioteca Maicao A2', 'Maicao', 'Biblioteca'],
            ['Biblioteca Maicao A3', 'Maicao', 'Biblioteca'],

            // URIBA
            ['Alcaldia Uribia', 'Uribia', 'Alcaldia'],
            ['Biblioteca Uribia', 'Uribia', 'Biblioteca'],
            ['Alcaldia Uribia A1', 'Uribia', 'Alcaldia'],
            ['Alcaldia Uribia A2', 'Uribia', 'Alcaldia'],
            ['Alcaldia Uribia A3', 'Uribia', 'Alcaldia'],
            ['Biblioteca Uribia A1', 'Uribia', 'Biblioteca'],
            ['Biblioteca Uribia A2', 'Uribia', 'Biblioteca'],
            ['Biblioteca Uribia A3', 'Uribia', 'Biblioteca'],

            // MANAURE
            ['Alcaldia Manaure', 'Manaure', 'Alcaldia'],
            ['Biblioteca Manaure', 'Manaure', 'Biblioteca'],
            ['Alcaldia Manaure A1', 'Manaure', 'Alcaldia'],
            ['Alcaldia Manaure A2', 'Manaure', 'Alcaldia'],
            ['Alcaldia Manaure A3', 'Manaure', 'Alcaldia'],
            ['Biblioteca Manaure A1', 'Manaure', 'Biblioteca'],
            ['Biblioteca Manaure A2', 'Manaure', 'Biblioteca'],
            ['Biblioteca Manaure A3', 'Manaure', 'Biblioteca'],

            // ALBANIA
            ['Alcaldia Albania', 'Albania', 'Alcaldia'],
            ['Biblioteca Albania', 'Albania', 'Biblioteca'],
            ['Alcaldia Albania A1', 'Albania', 'Alcaldia'],
            ['Alcaldia Albania A2', 'Albania', 'Alcaldia'],
            ['Alcaldia Albania A3', 'Albania', 'Alcaldia'],
            ['Biblioteca Albania A1', 'Albania', 'Biblioteca'],
            ['Biblioteca Albania A2', 'Albania', 'Biblioteca'],
            ['Biblioteca Albania A3', 'Albania', 'Biblioteca'],

            // HATONUEVO
            ['Alcaldia Hatonuevo', 'Hatonuevo', 'Alcaldia'],
            ['Biblioteca Hatonuevo', 'Hatonuevo', 'Biblioteca'],
            ['Alcaldia Hatonuevo A1', 'Hatonuevo', 'Alcaldia'],
            ['Alcaldia Hatonuevo A2', 'Hatonuevo', 'Alcaldia'],
            ['Alcaldia Hatonuevo A3', 'Hatonuevo', 'Alcaldia'],
            ['Biblioteca Hatonuevo A1', 'Hatonuevo', 'Biblioteca'],
            ['Biblioteca Hatonuevo A2', 'Hatonuevo', 'Biblioteca'],
            ['Biblioteca Hatonuevo A3', 'Hatonuevo', 'Biblioteca'],

            // BARRANCAS
            ['Alcaldia Barrancas', 'Barrancas', 'Alcaldia'],
            ['Biblioteca Barrancas', 'Barrancas', 'Biblioteca'],
            ['Alcaldia Barrancas A1', 'Barrancas', 'Alcaldia'],
            ['Alcaldia Barrancas A2', 'Barrancas', 'Alcaldia'],
            ['Alcaldia Barrancas A3', 'Barrancas', 'Alcaldia'],
            ['Biblioteca Barrancas A1', 'Barrancas', 'Biblioteca'],
            ['Biblioteca Barrancas A2', 'Barrancas', 'Biblioteca'],
            ['Biblioteca Barrancas A3', 'Barrancas', 'Biblioteca'],

            // SAN JUAN
            ['Alcaldia San Juan', 'San Juan del Cesar', 'Alcaldia'],
            ['Biblioteca San Juan', 'San Juan del Cesar', 'Biblioteca'],
            ['Alcaldia San Juan A1', 'San Juan del Cesar', 'Alcaldia'],
            ['Alcaldia San Juan A2', 'San Juan del Cesar', 'Alcaldia'],
            ['Alcaldia San Juan A3', 'San Juan del Cesar', 'Alcaldia'],
            ['Biblioteca San Juan A1', 'San Juan del Cesar', 'Biblioteca'],
            ['Biblioteca San Juan A2', 'San Juan del Cesar', 'Biblioteca'],
            ['Biblioteca San Juan A3', 'San Juan del Cesar', 'Biblioteca'],

            // EL MOLINO
            ['Alcaldia El Molino', 'El Molino', 'Alcaldia'],
            ['Biblioteca El Molino', 'El Molino', 'Biblioteca'],
            ['Alcaldia El Molino A1', 'El Molino', 'Alcaldia'],
            ['Alcaldia El Molino A2', 'El Molino', 'Alcaldia'],
            ['Alcaldia El Molino A3', 'El Molino', 'Alcaldia'],
            ['Biblioteca El Molino A1', 'El Molino', 'Biblioteca'],
            ['Biblioteca El Molino A2', 'El Molino', 'Biblioteca'],
            ['Biblioteca El Molino A3', 'El Molino', 'Biblioteca'],

            // VILLA NUEVA
            ['Alcaldia Villa Nueva', 'Villanueva', 'Alcaldia'],
            ['Biblioteca Villa Nueva', 'Villanueva', 'Biblioteca'],
            ['Alcaldia Villa Nueva A1', 'Villanueva', 'Alcaldia'],
            ['Alcaldia Villa Nueva A2', 'Villanueva', 'Alcaldia'],
            ['Alcaldia Villa Nueva A3', 'Villanueva', 'Alcaldia'],
            ['Biblioteca Villa Nueva A1', 'Villanueva', 'Biblioteca'],
            ['Biblioteca Villa Nueva A2', 'Villanueva', 'Biblioteca'],
            ['Biblioteca Villa Nueva A3', 'Villanueva', 'Biblioteca'],

            // URUMITA
            ['Alcaldia Urumita', 'Urumita', 'Alcaldia'],
            ['Biblioteca Urumita', 'Urumita', 'Biblioteca'],
            ['Alcaldia Urumita A1', 'Urumita', 'Alcaldia'],
            ['Alcaldia Urumita A2', 'Urumita', 'Alcaldia'],
            ['Alcaldia Urumita A3', 'Urumita', 'Alcaldia'],
            ['Biblioteca Urumita A1', 'Urumita', 'Biblioteca'],
            ['Biblioteca Urumita A2', 'Urumita', 'Biblioteca'],
            ['Biblioteca Urumita A3', 'Urumita', 'Biblioteca'],

            // VILLANUEVA
            ['A1 Creem Villanueva', 'Villanueva', 'Creem'],
            ['A2 Creem Villanueva', 'Villanueva', 'Creem'],
            ['A3 Creem Villanueva', 'Villanueva', 'Creem'],
            ['A4 Creem Villanueva', 'Villanueva', 'Creem'],
            ['A5 Creem Villanueva', 'Villanueva', 'Creem'],
            ['A6 Creem Villanueva', 'Villanueva', 'Creem'],

            // DISTRACCIÓN
            ['Distracción', 'Distracción', 'A'],

            // AMBIENTES VIRTUALES
            ['Virtual 1', 'Fonseca', 'Virtual'],
            ['Virtual 2', 'Fonseca', 'Virtual'],
            ['Virtual 3', 'Fonseca', 'Virtual'],
            ['Virtual 4', 'Fonseca', 'Virtual'],
            ['Virtual 5', 'Fonseca', 'Virtual'],
            ['Virtual 6', 'Fonseca', 'Virtual'],
            ['Virtual 7', 'Fonseca', 'Virtual'],
            ['Virtual 8', 'Fonseca', 'Virtual'],
            ['Virtual 9', 'Fonseca', 'Virtual'],
            ['Virtual 10', 'Fonseca', 'Virtual'],
            ['Virtual 11', 'Fonseca', 'Virtual'],
            ['Virtual 12', 'Fonseca', 'Virtual'],
            ['Virtual 13', 'Fonseca', 'Virtual'],
            ['Virtual 14', 'Fonseca', 'Virtual'],
            ['Virtual 15', 'Fonseca', 'Virtual'],
            ['Virtual 16', 'Fonseca', 'Virtual'],
            ['Virtual 17', 'Fonseca', 'Virtual'],
            ['Virtual 18', 'Fonseca', 'Virtual'],
            ['Virtual 19', 'Fonseca', 'Virtual'],
            ['Virtual 20', 'Fonseca', 'Virtual'],
            ['Virtual 21', 'Fonseca', 'Virtual'],
            ['Virtual 22', 'Fonseca', 'Virtual'],
            ['Virtual 23', 'Fonseca', 'Virtual'],
            ['Virtual 24', 'Fonseca', 'Virtual'],
            ['Virtual 25', 'Fonseca', 'Virtual'],
            ['Virtual 26', 'Fonseca', 'Virtual'],
            ['Virtual 27', 'Fonseca', 'Virtual'],
            ['Virtual 28', 'Fonseca', 'Virtual'],
            ['Virtual 29', 'Fonseca', 'Virtual'],
            ['Virtual 30', 'Fonseca', 'Virtual'],
            ['Virtual 31', 'Fonseca', 'Virtual'],
            ['Virtual 32', 'Fonseca', 'Virtual'],
            ['Virtual 33', 'Fonseca', 'Virtual'],
            ['Virtual 34', 'Fonseca', 'Virtual'],
            ['Virtual 35', 'Fonseca', 'Virtual'],
        ];

        // Obtener todos los municipios disponibles
        $towns = Town::all();
        $townIds = $towns->pluck('id', 'name')->toArray();

        foreach ($classroomsData as $classroomData) {
            $this->crearAmbiente($classroomData, $townIds);
        }
    }

    private function crearAmbiente($classroomData, $townIds)
    {
        [$name, $municipio, $blockName] = $classroomData;

        // Buscar municipio por nombre
        $townId = $townIds[$municipio] ?? $townIds['Fonseca'];

        // Buscar o crear el bloque
        $block = Block::firstOrCreate(['name' => $blockName]);

        Classroom::create([
            'id_town' => $townId,
            'id_block' => $block->id,
            'name' => $name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
