<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Speciality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialities = [
            "Ingeniería de Sistemas",
            "Administración de Empresas",
            "Contaduría Pública",
            "Psicología",
            "Diseño Gráfico",
            "Medicina",
            "Arquitectura",
            "Derecho",
            "Ingeniería Electrónica",
            "Marketing Digital",
            "Salud Ocupacional",
            "Licenciatura en Música",
            "Diseño Web",
            "Comercio Internacional",
            "Agroindustria",
            "Logística",
            "Economía",
            "Gestión Integrada",
            "Análisis y Desarrollo de Sistemas de Información (ADSI)",
            "Producción Agropecuaria Ecológica",
            "Ingeniería Industrial",
            "Bilingüismo",
            "Ingeniería Ambiental",
            "Gestión Documental",
            "Multimedia",
            "Seguridad y Salud en el Trabajo",
            "Agronomía",
            "Comunicación Social",
            "Publicidad y Mercadeo",
            "Cultura Física",
            "Administración Agropecuaria",
            "Turismo",
            "Administración Financiera",
            "Mecanización Agrícola",
            "Medicina Veterinaria Zootecnia",
            "Ingeniería Agrícola",
            "Ingeniería Civil",
            "Ingeniería Mecánica",
            "Control de Calidad de Alimentos",
            "Cocina",
            "Administración Turística y Hotelera",
            "Bacteriología",
            "Finanzas y Comercio Exterior",
            "Pesquero",
            "Etnoeducación",
            "Biología",
            "Medio Ambiente",
            "Pedagogía Infantil",
            "Lenguas Modernas",
            "Trabajo Social",
            "Fisioterapia",
            "Enfermería",
            "Diseño de Modas",
            "Topografía",
            "Psicopedagogía",
            "Educación Física",
            "Construcción",
            "Mecatrónica",
            "Microbiología",
            "Acuicultura",
            "Zootecnia",
            "Química de Alimentos",
            "Filosofía",
            "Ciencias Sociales",
            "Ciencias Religiosas",
            "Ingeniería Química",
            "Gestión del Talento Humano",
            "Normalista Superior",
            "Gerencia",
            "Ingeniería de Minas",
            "Confeciones",
            "Producción Agropecuaria",
            "Especies Menores",
            "Especies Mayores",
            "Artesanías",
            "Operaciones Forestales",
            "Producción Acuícola",
            "Producción Ganadera",
            "Producción Pecuaria",
            "Animación 3D",
            "Gastronomía",
            "Electricidad",
            "Instalaciones Hidráulicas y Sanitarias",
            "Construcción de Edificaciones",
            "Mantenimiento de Equipos de Computo",
            "Sistemas Teleinformáticos",
            "Ciberseguridad",
            "Producción Multimedia",
            "Desarrollo de Software",
            "Programación de Software",
            "Gestión Logística",
            "Gestión Empresarial",
            "Gestión Contable",
            "Coordinación de Procesos Logísticos",
            "Producción Audiovisual",
            "Desarrollo Publicitario",
            "Gestión Agroempresarial",
            "Monitoreo Ambiental",
            "Operación Turística",
            "Atención al Cliente",
            "Asistencia Administrativa",
            "Recursos Humanos",
            "Emprendimiento",
            "Operaciones Comerciales",
            "Ventas Online",
            "Eventos",
            "Recepción Hotelera",
            "Servicio Aeroportuario",
            "Programas Deportivos",
            "Interpretación Musical",
            "Confección Industrial",
            "Piscicultura",
            "Avicultura",
            "Camaronicultura",
            "Cafés Especiales",
            "Cultivo de Cacao",
            "Seguridad Alimentaria",
            "Riego y Drenaje",
            "Topografía y Georreferenciación",
            "Potabilización de Agua",
            "Manejo de Residuos Sólidos",
            "Conservación de Recursos Naturales"
        ];

        // Ordenar alfabéticamente
        sort($specialities);

        // Insertar especialidades únicas
        foreach ($specialities as $speciality) {
            Speciality::create([
                "name" => $speciality
            ]);
        }
    }
}
