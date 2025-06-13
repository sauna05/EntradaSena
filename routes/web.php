<?php

use App\Http\Controllers\DbEntrada\AbsenceController;
use App\Http\Controllers\DbEntrada\ApprenticeController;
use App\Http\Controllers\DbEntrada\AssistanceController;
use App\Http\Controllers\DbEntrada\AuthController as EntranceAuthController;
use App\Http\Controllers\DbEntrada\EntranceAdminController;
use App\Http\Controllers\DbEntrada\EntranceExitController;
use App\Http\Controllers\DbEntrada\UserController;

use App\Http\Controllers\DbProgramacion\AuthController as ProgrammingAuthController;
use App\Http\Controllers\DbProgramacion\CohortController;
use App\Http\Controllers\DbProgramacion\ProgramanController;
use App\Models\DbEntrada\User;
use Illuminate\Support\Facades\Route;
//Pagina inicial
Route::get('/', function () {
    return view('pages.start_page');
})->name('login');
//Logout universal
Route::post('logout', [EntranceAuthController::class, 'logout'])->name('logout');

//Entrada ------------------------------------------------------------------------------

//login
Route::post('entrance/login', [EntranceAuthController::class, 'login'])->name('entrance-login');

//Modulo Entrada
Route::get('/entrance', [EntranceExitController::class,  'create'])->middleware('can:entrance.create')->name('entrance.create');
Route::post('/entrance/store', [EntranceExitController::class, 'store'])->middleware('can:entrance.store')->name('entrance.store');

//Modulo Entrada - Administrador
//Primera vista del administrador-asistencia
Route::get('entrance/admin/people', [EntranceAdminController::class, 'peopleIndex'])->middleware('can:entrance.people.index')->name('entrance.people.index');
Route::get('entrance/admin/people/create', [EntranceAdminController::class, 'peopleCreate'])->middleware('can:entrance.people.create')->name('entrance.people.create');
Route::post('entrance/admin/people/store', [EntranceAdminController::class, 'peopleStore'])->middleware('can:entrance.people.store')->name('entrance.people.store');
Route::get('entrance/admin/people/{id}', [EntranceAdminController::class, 'peopleShow'])->middleware('can:entrance.people.show')->name('entrance.people.show');
Route::get('entrance/admin/people/{id}/edit', [EntranceAdminController::class, 'peopleEdit'])->middleware('can:entrance.people.edit')->name('entrance.people.edit');
Route::put('entrance/admin/people/{id}', [EntranceAdminController::class, 'peopleUpdate'])->middleware('can:entrance.people.update')->name('entrance.people.update');
Route::delete('entrance/admin/people/{id}', [EntranceAdminController::class, 'peopleDelete'])->middleware('can:entrance.people.delete')->name('entrance.people.delete');
Route::post('/entrance/upload/excel/people', [EntranceAdminController::class, 'storePeopleExcel'])->middleware('can:entrance.excel.upload')->name('entrance.excel.upload');

//Modulo Entrada - Asistencias
Route::get('/entrance/assistance/index', [AssistanceController::class, 'assistanceIndex'])->middleware('can:entrance.assistance.index')->name('entrance.assistance.index');
//Route::get('/entrance/assistance_show_history/{$id}', [AssistanceController::class, 'showPeoples_history'])->middleware('can:entrance.assistance.show_history')->name('assistance_show_history');

Route::get('/entrance/assistance_show_history/{id}', [AssistanceController::class, 'showPeoples_history'])
    ->middleware('can:entrance.assistance.show_history')
    ->name('assistance_show_history');

//ruta para exportacion en excel
Route::get('/assistance/export', [AssistanceController::class, 'exportExcel'])->name('entrance.assistance.export');


//Modulo Entrada - Aprendiz
Route::get('entrance/apprentice/{id}', [ApprenticeController::class, 'show'])->name('apprentice.show');

//Modulo Entrada - Inasistencias
Route::get('entrance/admin/absences', [AbsenceController::class, 'absenceIndex'])->middleware('can:entrance.absence.index')->name('entrance.absence.index');
Route::get('entrance/admin/absences/{id}', [AbsenceController::class, 'absenceShow'])->middleware('can:entrance.absence.show')->name('entrance.absence.show');

Route::get('entrance/justify-absence/{id}', [AbsenceController::class, 'absenceAnswer'])->name('entrance.absence.answer'); //Formulario que se le abre al arendiz para poner el motivo de su inasistencia

Route::put('entrance/justify-absence/answer/{id}', [AbsenceController::class, 'AbsenceUpdateAnswered'])->name('entrance.absence.update.answer'); //Se guarda  en base a lo responddido por el aprendiz en el formulario de inasistencia

Route::put('entrance/justify-absence/{id}', [AbsenceController::class, 'AbsenceUpdateReaded'])->name('entrance.absence.update.readed'); //Se guarda si el administrador de la entrada ya leyó la excusa de inasistencia de alguien


//  Route::get('entrance/justify-absence/{id}',[AbsenceController::class,''])
//agregar rutas para el apartado de programacion





//rutas de Asistencias Admin

Route::get('entrance/admin/assistance', [AssistanceController::class, 'assistanceIndex'])->middleware('can:entrance.assistance.index')->name('entrance.assistance.index');
Route::get('entrance/admin/assistance/{id}', [AssistanceController::class, 'showPeoples'])->middleware('can:entrance.assistance.show')->name('entrance.assistance.show');
Route::get('/entrance/assistance/all', [AssistanceController::class, 'allAssistances'])
    ->middleware('can:entrance.assistance.all')
    ->name('entrance.assistance.all');

// Ruta para cambiar la contraseña
Route::get('/password', [UserController::class, 'showChangeForm'])->name('password.change');
Route::post('/changePassword', [UserController::class, 'changePassword'])->name('password.update');
//rutas para asistencias agregadas


//Programación ------------------------------------------------------------------------

//login
Route::post('programming/login', [ProgrammingAuthController::class, 'login'])->name('programming-login');

//Modulo Programación

Route::get('programming/admin/Cohort', [CohortController::class, 'indexCohort'])->middleware('can:programmig.programming_cohort_index')->name('programing.cohort_index');

//ruta de registro de fichas programmig.programming_cohort_Register
//ruta para registrar fichas
Route::post('programming/admin/cohort', [CohortController::class, 'registerCohort'])
    ->middleware('can:programmig.programming_cohort_Register')->name('programming.Register');

//ruta para agregar programa
// Route::get('programming/admin/programan', [ProgramanController::class, 'indexPrograman'])
//     ->middleware('can:programing.programan_add')->name('programming.Programan_add');


Route::get('programming/admin', [ProgrammingAuthController::class, 'dashboard'])->middleware('can:programming.admin')
    ->name('programming.admin');

Route::post('programming/admin', [ProgramanController::class, 'register_programan'])
    ->middleware('can:programing.programan_store_add')->name('programing.programan_store_add');



//ruta para listar aprendicez en programaciom
Route::get('programming/admin/programan', [ProgramanController::class, 'asignarAprendiz_index'])
    ->middleware('can:programing.add_apprentices_cohorts')->name('programing.add_apprentices_cohorts');


Route::post('programming/admin/programan', [ProgramanController::class, 'asignarAprendiz_Add'])
    ->middleware('can:programing.add_apprentices_store')->name('programing.add_apprentices_store');



Route::get('programming/admin/apprentices', [ProgramanController::class, 'ListAprenticesxcohorts'])
    ->middleware('can:programing.apprentices_list')->name('programing.list_apprentices');



Route::get('programming/admin/apprentices_cohorts', [ProgramanController::class, 'ListAprenticesxcohorts'])
    ->middleware('can:programing.apprentices_cohorts_list')->name('programing.list_apprentices_cohorts');



Route::get('programming/admin/competenciesIndex', [ProgramanController::class, 'Listcompetencies'])
    ->middleware('can:programing.competencies_index')->name('programing.competencies_index');



Route::post('programming/admin/competenciesStore', [ProgramanController::class, 'competencies_Store'])
    ->middleware('can:programing.competencies_store')->name('programing.competencies_store');

//ruta para asignar competencias a un programa

Route::get('programming/admin/competenciesIndex_programmig', [ProgramanController::class, 'asignarCompetences_index'])
    ->middleware('can:programing.competencies_programming_index')->name('programing.competencies_index_program');



Route::post('programming/admin/competenciesStore_porgramming', [ProgramanController::class, 'competenciesAdd_store'])
    ->middleware('can:programing.competencies_programming_store')->name('programing.competencies_store_program');


Route::get('programming/admin/competencies_programan_index', [ProgramanController::class, 'list_competencias_program'])
    ->middleware('can:programing.competencies_programan_index')->name('programing.competencies_program_index');





Route::get('programming/admin/instructor_programan_index', [ProgramanController::class, 'instructores_index'])
    ->middleware('can:programing.instructor_programan_index')->name('programing.instructor_programan_index');


//ruta para la vista programacion de instructor

Route::get('programming/admin/instructor_programming_index', [ProgramanController::class, 'registerProgramming_index'])
    ->middleware('can:programing.register_programming_instructor_index')->name('programming.register_programming_instructor_index');

//RUTAS DE PROGRAMACIONES Y DEMAS
//ruta para listar las programaciones con sus estados

Route::get('programming/admin/programmig_programming_index', [ProgramanController::class, 'programming_index'])
    ->middleware('can:programing.programming_index_states')->name('programming.programming_index_states');

    //ruta para registrar programacion

Route::post('programming/admin/programmig_programming_store', [ProgramanController::class, 'register_programmig'])
    ->middleware('can:programing.register_programming_instructor_store')->name('programming.register_programming_instructor_store');



//ruta para retornar la vista de programaciones y sus estado ok o sin registrar
Route::get('programming/admin/programmig_update_index', [ProgramanController::class, 'programming_update_index'])
    ->middleware('can:programing.programming_update_index')->name('programming.programming_update_index');

//ruta para registrar programacion
Route::put('programming/admin/programmig_update/{id}', [ProgramanController::class, 'updateStatus'])
    ->middleware('can:programing.programming_update')
    ->name('programing.programming_update');




Route::get('programming/admin/programmig_instructors_profile', [ProgramanController::class, 'asignarCompetences_index_instructor'])
    ->middleware('can:programing.instructors_competences_profile')->name('programming.programming_instructors_profiles');


Route::post('programming/admin/programmig_instructors_profile_store', [ProgramanController::class, 'competenciesAdd_store_profile_instructor'])
    ->middleware('can:programing.instructors_competencies_profile_store')->name('programming.instructors_competencies_profile_store');


Route::get('programming/admin/Ambientes_classrom_index', [ProgramanController::class, 'index_classroom'])
    ->middleware('can:programing.classrooms_programming_classrooms_index')->name('ambientes_index');
