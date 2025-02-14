<x-layout>
    {{-- libreria para leer excel desde la web --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    {{-- token csrf para que se puedan pasar los datos por la url sin actualizar la pagina --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Archivo CSS de la pagina --}}
    <x-slot:page_style>css/pages/start_page.css</x:slot-page_style>
    {{-- Titulo de la pagina --}}
    <x-slot:title>CAA</x:slot-title>
    {{-- Header - Navbar --}}
    <x-entrance_navbar></x-entrance_navbar>

    <h1>Formulario de Registro para el modulo de entrada</h1>

   <form action="{{route('entrance.people.store')}}" method="POST">
    @csrf
    <div>
        <label for="id_position">Posición</label>
        <select name="id_position" id="id_position">
            <option value="">Seleccione una Posición</option>
            @foreach ($positions as $id => $position)
                <option value="{{$id}}">{{$position}}</option>
            @endforeach
        </select>
    </div>
   
    <div>
        <label for="document_number">Numero de Documento</label>
        <input type="text" name="document_number" id="document_number" >
    </div>

    <div>
        <label for="name">Nombre Completo</label>
        <input type="text" name="name" id="name">
    </div>
    
    <div>
        <label for="start_date">Fecha de Inicio</label>
        <input type="date" name="start_date" id="start_date">
    </div>
    <div>
        <label for="end_date">Fecha de Inicio</label>
        <input type="date" name="end_date" id="end_date">
    </div>
    <x-button type="submit">Enviar</x-button>
</form>

<div>
    <h5>Si desea registrar varios aprendices al mismo tiempo</h5>
    <form  id="excelForm" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="file" accept=".xlsx, .xls" name="excel_file" id="fileInput" style="display: none"  >
        <button type="button" id="uploadButton">Subir Excel</button>
    </form>
</div>

<script>
    document.getElementById('uploadButton').addEventListener('click', function() {
    document.getElementById('fileInput').click(); // Abre el selector de archivos
});
document.getElementById("fileInput").addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();

    reader.onload = function (e) {
        const data = new Uint8Array(e.target.result);
        const workbook = XLSX.read(data, { type: "array" });

        const sheet = workbook.Sheets[workbook.SheetNames[0]];
        let jsonData = XLSX.utils.sheet_to_json(sheet, { raw: false });

        // Convertir fechas al formato correcto YYYY-MM-DD
        jsonData = jsonData.map(row => {
            if (row.FECHA_INICIO && typeof row.FECHA_INICIO === "string") {
                row.FECHA_INICIO = formatDate(row.FECHA_INICIO);
            }
            if (row.FECHA_FINALIZACION && typeof row.FECHA_FINALIZACION === "string") {
                row.FECHA_FINALIZACION = formatDate(row.FECHA_FINALIZACION);
            }
            return row;
        });

        console.log("Enviando a Laravel:", jsonData); // Verifica en la consola

        // Enviar datos a Laravel con Fetch
        fetch("{{route('entrance.excel.upload')}}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content") // Token CSRF
            },
            body: JSON.stringify({ people: jsonData }) // Enviar como JSON
        })
        .then(async response => {
    const text = await response.text(); // Obtiene la respuesta como texto
    console.log("RAW RESPONSE:", text); // Muestra la respuesta en consola
    
    try {
        return JSON.parse(text); // Intenta convertirlo a JSON
    } catch (error) {
        throw new Error("No se pudo parsear JSON. Laravel devolvió HTML en vez de JSON.");
    }
    })
    .then(data => {
        console.log("Respuesta de Laravel:", data);
        alert("Importación completada correctamente!");
    })
    .catch(error => {
        console.error("Error en la importación:", error);
    });


    };

    reader.readAsArrayBuffer(file);
});

// Función para convertir fechas en formato MM/DD/YY a YYYY-MM-DD
function formatDate(fecha) {
    const date = new Date(fecha);
    return date.toISOString().split("T")[0]; // Formato YYYY-MM-DD
}

</script>

</x-layout> 