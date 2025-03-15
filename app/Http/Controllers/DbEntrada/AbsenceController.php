<?php

namespace App\Http\Controllers\DbEntrada;

use App\Http\Controllers\Controller;
use App\Models\DbEntrada\NotificationAbsence;
use App\Models\DbEntrada\Person;
use App\Notifications\AbsenceNotification;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    public function absenceIndex(Request $request)
    {
        $search = $request->input('search');
        $answeredYes = $request->has('answered-yes'); // Respuesta marcada como "respondida"
        $answeredNo = $request->has('answered-no');   // Respuesta marcada como "pendiente"
        $readedYes = $request->has('readed-yes');     // Leída
        $readedNo = $request->has('readed-no');       // No leída

        $absences = NotificationAbsence::with("person.position")
            ->whereHas('person', function ($query) use ($search) {
                if (!empty($search)) {
                    $query->where('document_number', 'like', "%$search%")
                        ->orWhere('name', 'like', "%$search%");
                }
            });

        // Filtrar por estado (pendiente o respondida)
        if ($answeredYes && !$answeredNo) {
            $absences->where('state', 'respondida');
        } elseif (!$answeredYes && $answeredNo) {
            $absences->where('state', 'pendiente');
        }

        // Filtrar por "Leídas"
        if ($readedYes && !$readedNo) {
            $absences->where('readed', 1);
        } elseif (!$readedYes && $readedNo) {
            $absences->where('readed', 0);
        }

        // Paginar resultados y mantener filtros en la URL
        $absences = $absences->paginate(20)->appends([
            'search' => $search,
            'answered-yes' => $answeredYes,
            'answered-no' => $answeredNo,
            'readed-yes' => $readedYes,
            'readed-no' => $readedNo,
        ]);

        return view('pages.entrance.admin.absence.absence_index', ['absences' => $absences]);
    }

    public function absenceShow($id){
        $absence = NotificationAbsence::with("person.position")->findOrFail($id);

        return view('pages.entrance.admin.absence.absence_show',['absence' => $absence]);
    }

    public function AbsenceAnswer($id){

            $absence = NotificationAbsence::with('person.position')
            ->where('id_person',$id)->first();

        return view('pages.entrance.admin.absence.absence_answer',['absence'=>$absence]);
    }

    public function AbsenceUpdateAnswered(Request $request,$id)
    {
        $data = $request->validate([
            'motive' => 'required'
        ]);

        $absence = NotificationAbsence::first()->where('id_person',$id);

        $absence->update([
            'state' => 'respondida',
            'motive' => $data["motive"]
        ]);

        return redirect()->route('login')->with("message", "Respondido Exitosamente");

    }


    public function AbsenceUpdateReaded(Request $request, $id)
    {
        $absence = NotificationAbsence::first()->where('id_person',$id);
        
        $absence->update([
            'readed' => '1'
        ]);

        return redirect()->route('entrance.absence.index');
    }
}
