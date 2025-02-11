<x-layout>
    {{-- libreria para leer excel desde la web --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
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
    <form action="{{route('entrance.excel.upload')}}" id="excelForm" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="file" accept=".xlsx, .xls" name="excel_file" id="fileInput" style="display: none"  >
        <button type="button" id="uploadButton">Subir Excel</button>
    </form>
</div>

<script>
    document.getElementById('uploadButton').addEventListener('click', function() {
    document.getElementById('fileInput').click(); // Abre el selector de archivos
});

document.getElementById('fileInput').addEventListener('change', function(event) {
    let file = event.target.files[0];
    
    if (!file) return;

    let reader = new FileReader();
    reader.readAsBinaryString(file);

    reader.onload = function(e) {
        let data = e.target.result;
        let workbook = XLSX.read(data, { type: 'binary' });
        let sheetName = workbook.SheetNames[0]; // Obtiene la primera hoja
        let sheet = workbook.Sheets[sheetName];
        let jsonData = XLSX.utils.sheet_to_json(sheet); // Convierte a JSON

        console.log(jsonData); // 📌 Aquí ves los datos en consola (para probar)
        
        // Enviar al servidor
        // sendDataToServer(jsonData);
    };
});
</script>

</x-layout> 