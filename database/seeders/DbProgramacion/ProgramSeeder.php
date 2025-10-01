<?php
namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Program;
use App\Models\DbProgramacion\Instructor;
use App\Models\DbProgramacion\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Primero creamos un array de mapeo de nombres de instructores a IDs
        $instructorsMap = $this->getInstructorsMap();

        // Programas únicos extraídos de los datos reales con instructores por nombre
        $uniquePrograms = [
            // TECNÓLOGO (id_level = 2)
            [
                "id_level" => 2,
                "program_code" => "226701",
                "program_version" => "1",
                "name" => "COORDINACION EN SISTEMAS INTEGRADOS DE GESTION",
                "instructor_id" => $instructorsMap['RUBEN DELUQUE'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "124101",
                "program_version" => "1",
                "name" => "DESARROLLO DE PROCESOS DE MERCADEO",
                "instructor_id" => $instructorsMap['GERMAN ARREGOCES'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "621201",
                "program_version" => "102",
                "name" => "GESTIÓN EMPRESARIAL",
                "instructor_id" => $instructorsMap['GERMAN ARREGOCES'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "123101",
                "program_version" => "1",
                "name" => "GESTION CONTABLE Y DE INFORMACION FINANCIERA",
                "instructor_id" => $instructorsMap['LILIBETH ROJAS'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "921318",
                "program_version" => "1",
                "name" => "CONTROL DE CALIDAD DE ALIMENTOS",
                "instructor_id" => $instructorsMap['EDILBERTO BELLO'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "228101",
                "program_version" => "102",
                "name" => "PRODUCCIÓN DE MULTIMEDIA",
                "instructor_id" => $instructorsMap['WOLLMAN MADIEDO'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "921700",
                "program_version" => "2",
                "name" => "CONTROL DE CALIDAD EN LA INDUSTRIA DE ALIMENTOS",
                "instructor_id" => $instructorsMap['EDILBERTO BELLO'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "224204",
                "program_version" => "1",
                "name" => "DESARROLLO DE PRODUCTOS ELECTRONICOS",
                "instructor_id" => $instructorsMap['MARLON FUENTES'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "124100",
                "program_version" => "1",
                "name" => "DESARROLLO PUBLICITARIO",
                "instructor_id" => $instructorsMap['LEO CARRILLO'] ?? 1  
            ],
            [
                "id_level" => 2,
                "program_code" => "217320",
                "program_version" => "1",
                "name" => "DESARROLLO MULTIMEDIA Y WEB",
                "instructor_id" => $instructorsMap['FRANCISCO VIZCAINO'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "524703",
                "program_version" => "1",
                "name" => "ANIMACION 3D",
                "instructor_id" => $instructorsMap['OLVER MEDINA'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "233104",
                "program_version" => "2",
                "name" => "PROGRAMACION DE SOFTWARE",
                "instructor_id" => $instructorsMap['JORGE LUIS DAZA PACHECO'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "723107",
                "program_version" => "100",
                "name" => "PRODUCCIÓN DE ESPECIES MENORES",
                "instructor_id" => $instructorsMap['NATALIA QUINTERO'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "723179",
                "program_version" => "1",
                "name" => "GESTION AGROEMPRESARIAL",
                "instructor_id" => $instructorsMap['ANGEL MAESTRE'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "722143",
                "program_version" => "1",
                "name" => "PRODUCCIÓN AGROPECUARIA ECOLÓGICA",
                "instructor_id" => $instructorsMap['FRANCISCO VIZCAINO'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "522309",
                "program_version" => "1",
                "name" => "DESARROLLO DE MEDIOS GRAFICOS VISUALES",
                "instructor_id" => $instructorsMap['OSCAR IVAN VEGA'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "228118",
                "program_version" => "1",
                "name" => "ANALISIS Y DESARROLLO DE SOFTWARE",
                "instructor_id" => $instructorsMap['YASSER PUSHAINA'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "121523",
                "program_version" => "2",
                "name" => "COORDINACION DE PROCESOS LOGISTICOS",
                "instructor_id" => $instructorsMap['OLVER MEDINA'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "222203",
                "program_version" => "100",
                "name" => "GESTIÓN DE RECURSOS NATURALES",
                "instructor_id" => $instructorsMap['ALVARO PERALTA'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "121524",
                "program_version" => "1",
                "name" => "GESTION INTEGRAL DEL TRANSPORTE",
                "instructor_id" => $instructorsMap['MANUEL RENE IRIARTE'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "845302",
                "program_version" => "1",
                "name" => "MECANIZACIÓN AGRÍCOLA",
                "instructor_id" => $instructorsMap['YASSER PUSHAINA'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "723106",
                "program_version" => "102",
                "name" => "PRODUCCIÓN GANADERA",
                "instructor_id" => $instructorsMap['SAMUEL CARRILLO'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "524113",
                "program_version" => "1",
                "name" => "COMUNICACIÓN COMERCIAL",
                "instructor_id" => $instructorsMap['MANUEL RENE IRIARTE'] ?? 1
            ],

            // TÉCNICO (id_level = 1)
            [
                "id_level" => 1,
                "program_code" => "635503",
                "program_version" => "103",
                "name" => "COCINA",
                "instructor_id" => $instructorsMap['HAROL ZARATE'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "836137",
                "program_version" => "1",
                "name" => "MANTENIMIENTO Y REPARACION DE EDIFICACIONES",
                "instructor_id" => $instructorsMap['ALEXANDER VANEGAS'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "135303",
                "program_version" => "1",
                "name" => "ATENCION INTEGRAL AL CLIENTE",
                "instructor_id" => $instructorsMap['JUANA RODRIGUEZ'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "633100",
                "program_version" => "1",
                "name" => "OPERACION TURISTICA LOCAL",
                "instructor_id" => $instructorsMap['DALYS PINEDO'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "733410",
                "program_version" => "101",
                "name" => "PRODUCCION AGROPECUARIA",
                "instructor_id" => $instructorsMap['MANUEL RENE IRIARTE'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "233101",
                "program_version" => "1",
                "name" => "SISTEMAS",
                "instructor_id" => $instructorsMap['WILFRIDO DESTRE CANO'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "180201",
                "program_version" => "100",
                "name" => "MANEJO INTEGRAL DE RESIDUOS SÓLIDOS",
                "instructor_id" => $instructorsMap['RUBEN DELUQUE'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "137136",
                "program_version" => "1",
                "name" => "INTEGRACION DE OPERACIONES LOGISTICAS",
                "instructor_id" => $instructorsMap['GLORIA GUTIERREZ'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "722125",
                "program_version" => "102",
                "name" => "SUPERVISION DE ACTIVIDADES BANANERAS",
                "instructor_id" => $instructorsMap['LUIS SIERRA LEIVA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "733293",
                "program_version" => "1",
                "name" => "PRODUCCION ACUICOLA",
                "instructor_id" => $instructorsMap['ENDER EGURROLA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "833100",
                "program_version" => "1",
                "name" => "INSTALACIONES HIDRAULICAS Y SANITARIAS EN EDIFICACIONES RESIDENCIALES Y COMERCIALES",
                "instructor_id" => $instructorsMap['ALVARO PERALTA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "733193",
                "program_version" => "1",
                "name" => "SISTEMAS AGROPECUARIOS ECOLOGICOS",
                "instructor_id" => $instructorsMap['ANDREA MONTERO'] ?? 2
            ],
            [
                "id_level" => 2,
                "program_code" => "217320",
                "program_version" => "1",
                "name" => "DESARROLLO MULTIMEDIA Y WEB",
                "instructor_id" => $instructorsMap['FRANCISCO VIZCAINO'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "524703",
                "program_version" => "1",
                "name" => "ANIMACION 3D",
                "instructor_id" => $instructorsMap['OLVER MEDINA'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "233104",
                "program_version" => "2",
                "name" => "PROGRAMACION DE SOFTWARE",
                "instructor_id" => $instructorsMap['JORGE LUIS DAZA PACHECO'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "723107",
                "program_version" => "100",
                "name" => "PRODUCCIÓN DE ESPECIES MENORES",
                "instructor_id" => $instructorsMap['NATALIA QUINTERO'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "723179",
                "program_version" => "1",
                "name" => "GESTION AGROEMPRESARIAL",
                "instructor_id" => $instructorsMap['ANGEL MAESTRE'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "722143",
                "program_version" => "1",
                "name" => "PRODUCCIÓN AGROPECUARIA ECOLÓGICA",
                "instructor_id" => $instructorsMap['FRANCISCO VIZCAINO'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "522309",
                "program_version" => "1",
                "name" => "DESARROLLO DE MEDIOS GRAFICOS VISUALES",
                "instructor_id" => $instructorsMap['OSCAR IVAN VEGA'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "228118",
                "program_version" => "1",
                "name" => "ANALISIS Y DESARROLLO DE SOFTWARE",
                "instructor_id" => $instructorsMap['YASSER PUSHAINA'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "121523",
                "program_version" => "2",
                "name" => "COORDINACION DE PROCESOS LOGISTICOS",
                "instructor_id" => $instructorsMap['OLVER MEDINA'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "222203",
                "program_version" => "100",
                "name" => "GESTIÓN DE RECURSOS NATURALES",
                "instructor_id" => $instructorsMap['ALVARO PERALTA'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "121524",
                "program_version" => "1",
                "name" => "GESTION INTEGRAL DEL TRANSPORTE",
                "instructor_id" => $instructorsMap['MANUEL RENE IRIARTE'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "845302",
                "program_version" => "1",
                "name" => "MECANIZACIÓN AGRÍCOLA",
                "instructor_id" => $instructorsMap['YASSER PUSHAINA'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "723106",
                "program_version" => "102",
                "name" => "PRODUCCIÓN GANADERA",
                "instructor_id" => $instructorsMap['SAMUEL CARRILLO'] ?? 1
            ],
            [
                "id_level" => 2,
                "program_code" => "524113",
                "program_version" => "1",
                "name" => "COMUNICACIÓN COMERCIAL",
                "instructor_id" => $instructorsMap['MANUEL RENE IRIARTE'] ?? 1
            ],

            // TÉCNICO (id_level = 1)
            [
                "id_level" => 1,
                "program_code" => "635503",
                "program_version" => "103",
                "name" => "COCINA",
                "instructor_id" => $instructorsMap['HAROL ZARATE'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "836137",
                "program_version" => "1",
                "name" => "MANTENIMIENTO Y REPARACION DE EDIFICACIONES",
                "instructor_id" => $instructorsMap['ALEXANDER VANEGAS'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "135303",
                "program_version" => "1",
                "name" => "ATENCION INTEGRAL AL CLIENTE",
                "instructor_id" => $instructorsMap['JUANA RODRIGUEZ'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "633100",
                "program_version" => "1",
                "name" => "OPERACION TURISTICA LOCAL",
                "instructor_id" => $instructorsMap['DALYS PINEDO'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "733410",
                "program_version" => "101",
                "name" => "PRODUCCION AGROPECUARIA",
                "instructor_id" => $instructorsMap['MANUEL RENE IRIARTE'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "233101",
                "program_version" => "1",
                "name" => "SISTEMAS",
                "instructor_id" => $instructorsMap['WILFRIDO DESTRE CANO'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "180201",
                "program_version" => "100",
                "name" => "MANEJO INTEGRAL DE RESIDUOS SÓLIDOS",
                "instructor_id" => $instructorsMap['RUBEN DELUQUE'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "137136",
                "program_version" => "1",
                "name" => "INTEGRACION DE OPERACIONES LOGISTICAS",
                "instructor_id" => $instructorsMap['GLORIA GUTIERREZ'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "722125",
                "program_version" => "102",
                "name" => "SUPERVISION DE ACTIVIDADES BANANERAS",
                "instructor_id" => $instructorsMap['LUIS SIERRA LEIVA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "733293",
                "program_version" => "1",
                "name" => "PRODUCCION ACUICOLA",
                "instructor_id" => $instructorsMap['ENDER EGURROLA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "833100",
                "program_version" => "1",
                "name" => "INSTALACIONES HIDRAULICAS Y SANITARIAS EN EDIFICACIONES RESIDENCIALES Y COMERCIALES",
                "instructor_id" => $instructorsMap['ALVARO PERALTA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "733193",
                "program_version" => "1",
                "name" => "SISTEMAS AGROPECUARIOS ECOLOGICOS",
                "instructor_id" => $instructorsMap['ANDREA MONTERO'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "222301",
                "program_version" => "1",
                "name" => "MONITOREO AMBIENTAL",
                "instructor_id" => $instructorsMap['LACIDES MOLINA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "134400",
                "program_version" => "2",
                "name" => "ASISTENCIA ORGANIZACIÓN DE ARCHIVOS",
                "instructor_id" => $instructorsMap['MARTHA BENJUMEA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "837305",
                "program_version" => "1",
                "name" => "REPARACION DE MAQUINARIA AGRICOLA",
                "instructor_id" => $instructorsMap['CARLOS ROMERO'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "233108",
                "program_version" => "1",
                "name" => "SISTEMAS TELEINFORMÁTICOS",
                "instructor_id" => $instructorsMap['YASSER PUSHAINA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "832202",
                "program_version" => "2",
                "name" => "INSTALACION DE SISTEMAS ELECTRICOS RESIDENCIALES Y COMERCIALES",
                "instructor_id" => $instructorsMap['MARLON FUENTES'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "921219",
                "program_version" => "100",
                "name" => "OPERACIÓN DE SISTEMAS DE POTABILIZACIÓN DE AGUA",
                "instructor_id" => $instructorsMap['RUTH HERNANDEZ'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "836138",
                "program_version" => "1",
                "name" => "CONSTRUCCIÓN DE EDIFICACIONES",
                "instructor_id" => $instructorsMap['EVER TONCEL'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "733402",
                "program_version" => "1",
                "name" => "PROYECTOS AGROPECUARIOS",
                "instructor_id" => $instructorsMap['ANGEL MAESTRE'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "664212",
                "program_version" => "1",
                "name" => "EJECUCION DE PROGRAMAS DEPORTIVOS",
                "instructor_id" => $instructorsMap['DIVIER DIAZ MARZAL'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "531200",
                "program_version" => "2",
                "name" => "INTERPRETACION DE INSTRUMENTOS MUSICALES",
                "instructor_id" => $instructorsMap['JORGE LUIS DAZA PACHECO'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "842200",
                "program_version" => "3",
                "name" => "ELABORACION DE PRENDAS DE VESTIR SOBRE MEDIDAS",
                "instructor_id" => $instructorsMap['GISELA SIERRA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "233105",
                "program_version" => "2",
                "name" => "MANTENIMIENTO DE EQUIPOS DE COMPUTO",
                "instructor_id" => $instructorsMap['HEBERT PEÑARANDA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "225313",
                "program_version" => "1",
                "name" => "SOPORTE DE TOPOGRAFIA Y GEORREFERENCIACION",
                "instructor_id" => $instructorsMap['ALEXANDER'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "134200",
                "program_version" => "2",
                "name" => "RECURSOS HUMANOS",
                "instructor_id" => $instructorsMap['ENKA MORENO'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "134101",
                "program_version" => "2",
                "name" => "ASISTENCIA ADMINISTRATIVA",
                "instructor_id" => $instructorsMap['MONICA ALFARO'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "133100",
                "program_version" => "2",
                "name" => "CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS",
                "instructor_id" => $instructorsMap['HEINER BRITO'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "733290",
                "program_version" => "1",
                "name" => "PRODUCCION PECUARIA",
                "instructor_id" => $instructorsMap['LUCELLY PINTO'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "761322",
                "program_version" => "1",
                "name" => "PRODUCCION DE POLLO DE ENGORDE",
                "instructor_id" => $instructorsMap['WOLMAN MADIEDO'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "733401",
                "program_version" => "1",
                "name" => "RIEGO Y DRENAJE EN CULTIVOS AGRICOLAS",
                "instructor_id" => $instructorsMap['LUCELLY PINTO'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "861100",
                "program_version" => "2",
                "name" => "CONSTRUCCION DE VIAS",
                "instructor_id" => $instructorsMap['ENDER EGURROLA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "722148",
                "program_version" => "1",
                "name" => "GESTION DE LA PRODUCCION AGRICOLA",
                "instructor_id" => $instructorsMap['JORGE DAZA ACOSTA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "134102",
                "program_version" => "1",
                "name" => "EMPRENDIMIENTO Y FOMENTO EMPRESARIAL",
                "instructor_id" => $instructorsMap['MARIA LETICIA CHICA MONTOYA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "222239",
                "program_version" => "1",
                "name" => "CONSERVACION DE RECURSOS NATURALES",
                "instructor_id" => $instructorsMap['LEONILDE PALOMINO'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "633400",
                "program_version" => "2",
                "name" => "SERVICIO DE RECEPCION HOTELERA",
                "instructor_id" => $instructorsMap['OLVER MEDINA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "122814",
                "program_version" => "1",
                "name" => "OPERACIÓN DE EVENTOS",
                "instructor_id" => $instructorsMap['JORGE DAZA ACOSTA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "632201",
                "program_version" => "1",
                "name" => "VENTA DE PRODUCTOS EN LINEA",
                "instructor_id" => $instructorsMap['FRANCISCO VIZCAINO'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "733259",
                "program_version" => "2",
                "name" => "PRODUCCIÓN DE CAPRINOS Y OVINOS",
                "instructor_id" => $instructorsMap['LUCELLY PINTO'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "632105",
                "program_version" => "100",
                "name" => "OPERACIONES COMERCIALES",
                "instructor_id" => $instructorsMap['FRANCISCO VIZCAINO'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "632305",
                "program_version" => "100",
                "name" => "OPERACIONES DE CAJA Y SERVICIOS EN ALMACENES DE CADENA",
                "instructor_id" => $instructorsMap['LUIS SIERRA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "233109",
                "program_version" => "1",
                "name" => "TRATAMIENTO DE RIESGOS DE CIBERSEGURIDAD EN LA MICRO, PEQUEÑA Y MEDIANA EMPRESA (MIPYMES)",
                "instructor_id" => $instructorsMap['MANUEL RENE IRIARTE'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "133303",
                "program_version" => "1",
                "name" => "SERVICIOS COMERCIALES Y FINANCIEROS",
                "instructor_id" => $instructorsMap['DUNIS BERMUDEZ'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "845300",
                "program_version" => "1",
                "name" => "OPERACION DE MAQUINARIA AGRICOLA",
                "instructor_id" => $instructorsMap['YASSER PUSHAINA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "231100",
                "program_version" => "1",
                "name" => "SANEAMIENTO Y SALUD AMBIENTAL",
                "instructor_id" => $instructorsMap['LACIDES MOLINA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "633200",
                "program_version" => "2",
                "name" => "SERVICIO AEROPORTUARIO A PASAJEROS",
                "instructor_id" => $instructorsMap['DIVIER DIAZ MARZAL'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "232100",
                "program_version" => "1",
                "name" => "AGROTRONICA",
                "instructor_id" => $instructorsMap['MARIA URECHE'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "733171",
                "program_version" => "1",
                "name" => "PRODUCCION DE CAFES ESPECIALES",
                "instructor_id" => $instructorsMap['ANA MARIA GONZALEZ ARIAS'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "733190",
                "program_version" => "1",
                "name" => "PRODUCCION Y COSECHA DE CULTIVO DE CACAO",
                "instructor_id" => $instructorsMap['HEINER OLIVELLA'] ?? 2
            ],
            [
                "id_level" => 1,
                "program_code" => "732208",
                "program_version" => "1",
                "name" => "OPERACIONES FORESTALES",
                "instructor_id" => $instructorsMap['VICTOR RONDON'] ?? 2
            ],

            // OPERARIO (id_level = 4)
            [
                "id_level" => 4,
                "program_code" => "935100",
                "program_version" => "1",
                "name" => "MANEJO DE MAQUINARIA DE CONFECCION INDUSTRIAL",
                "instructor_id" => $instructorsMap['GISELA SIERRA'] ?? 3
            ],
            [
                "id_level" => 4,
                "program_code" => "526600",
                "program_version" => "1",
                "name" => "BISUTERIA ARTESANAL",
                "instructor_id" => $instructorsMap['MONICA ALFARO'] ?? 3
            ],
            [
                "id_level" => 4,
                "program_code" => "761513",
                "program_version" => "2",
                "name" => "PISCICULTURA",
                "instructor_id" => $instructorsMap['WILBIS CAMARGO'] ?? 3
            ],
            [
                "id_level" => 4,
                "program_code" => "761325",
                "program_version" => "7",
                "name" => "MANEJO DE EXPLOTACION DE HUEVO COMERCIAL",
                "instructor_id" => $instructorsMap['MANUEL RENE IRIARTE'] ?? 3
            ],
            [
                "id_level" => 4,
                "program_code" => "761512",
                "program_version" => "1",
                "name" => "PRODUCCION DE CAMARON",
                "instructor_id" => $instructorsMap['YASSER PUSHAINA'] ?? 3
            ],
            [
                "id_level" => 4,
                "program_code" => "935105",
                "program_version" => "1",
                "name" => "MANEJO DE MAQUINARIA DE CONFECCION INDUSTRIAL",
                "instructor_id" => $instructorsMap['FANNER SOLANO'] ?? 3
            ],
            [
                "id_level" => 4,
                "program_code" => "761330",
                "program_version" => "1",
                "name" => "MANEJO DE LA PRODUCCION PECUARIA",
                "instructor_id" => $instructorsMap['LUCELLY PINTO'] ?? 3
            ],

            // AUXILIAR (id_level = 3)
            [
                "id_level" => 3,
                "program_code" => "733191",
                "program_version" => "1",
                "name" => "PROMOCION DE SEGURIDAD ALIMENTARIA",
                "instructor_id" => $instructorsMap['WILFRIDO DESTRE'] ?? 4
            ],
        ];

        // Insertar todos los programas únicos
        foreach ($uniquePrograms as $program) {
            Program::create($program);
        }
    }

    /**
     * Obtiene el mapeo de nombres de instructores a IDs
     */
    private function getInstructorsMap(): array
    {
        $instructorsMap = [];

        // Buscar todos los instructores y crear un mapa nombre -> id_person
        $instructors = Instructor::with('person')->get();

        foreach ($instructors as $instructor) {
            if ($instructor->person) {
                $instructorsMap[$instructor->person->name] = $instructor->id_person;
            }
        }

        return $instructorsMap;
    }
}
