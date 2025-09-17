<?php

namespace App\Http\Controllers\DbEntrada;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DbProgramacion\Apprentice;
use App\Models\DbProgramacion\Person;
use App\Models\DbProgramacion\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class ApprenticeController extends Controller
{
    public function index(){

        return "holi";

    }

    public function show($id)
    {
        // Obtener usuario
        $user = DB::table('users')->where('id', $id)->first();
        if (!$user) {
            abort(404, "Usuario no encontrado");
        }

        // Obtener persona con relación a position y entrances_exits
        $person = Person::with(['position'])
            ->where('document_number', $user->user_name)
            ->first();

        if (!$person) {
            abort(404, "Persona no encontrada");
        }

        // Obtener información del aprendiz con sus cohorts y programas relacionados
        $apprentice = Apprentice::with([
            'cohorts' => function ($query) {
                $query->with(['program']); // Cargar el programa relacionado con cada cohort
            }
        ])->where('id_person', $person->id)->first();

        // Obtener asistencias de hoy
        $todayEntrancesExits = $person->entrances_exits()
            ->whereDate('date_time', Carbon::today())
            ->orderBy('date_time', 'asc')
            ->get();

        // Obtener historial completo (puedes agregar paginación si es necesario)
        $historyEntrancesExits = $person->entrances_exits()
            ->orderBy('date_time', 'desc')
            ->get();

        // Formatear asistencias de hoy
        $formattedTodayEntrances = $todayEntrancesExits->map(function ($entry) {
            return [
                'date' => Carbon::parse($entry->date_time)->format('Y-m-d'),
                'time' => Carbon::parse($entry->date_time)->format('H:i:s'),
                'action' => $entry->action,
            ];
        });

        // Formatear historial completo
        $formattedHistoryEntrances = $historyEntrancesExits->map(function ($entry) {
            return [
                'date' => Carbon::parse($entry->date_time)->format('Y-m-d'),
                'time' => Carbon::parse($entry->date_time)->format('H:i:s'),
                'action' => $entry->action,
            ];
        });

        // Obtener información de ficha(s) y programa(s)
        $cohortsData = [];
        $programs = [];

        if ($apprentice && $apprentice->cohorts) {
            foreach ($apprentice->cohorts as $cohort) {
                // Almacenar todos los datos de la cohort
                $cohortsData[] = [
                    'number' => $cohort->number_cohort,
                    'start_date' => $cohort->start_date,
                    'end_date' => $cohort->end_date,
                    // Agrega aquí otros campos que necesites
                ];

                if ($cohort->program) {
                    $programs[] = $cohort->program->name;
                }
            }
        }


        $programs = array_unique($programs);

        return view('pages.entrance.apprentice.apprentice_index', compact(
            'user',
            'person',
            'formattedTodayEntrances',
            'formattedHistoryEntrances',
            'cohortsData',
            'programs'
        ));
    }

    //funciones para ver asistencias del aprendiz




    public function showChangePasswordForm()
    {
        return view('pages.entrance.apprentice.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = Auth::user();

        if (!$user) {
            abort(404, "Usuario no encontrado");
        }

        // Actualizar la contraseña
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('password.change')->with('success', '¡Contraseña actualizada correctamente!');
    }

}
