@extends('layouts.admin')
@section('contenido')
@if(Session::has('Mensaje')){{
    
    Session::get('Mensaje')
}}
@endif
    <input type="text" id="codigoBarrasInput" placeholder="Escanea el código de barras">
<!--  END CONTENT AREA  -->
@endsection

<script>
    $('#codigoBarrasInput').on('change', function() {

        var codigoBarras = $(this).val();

        $.ajax({
            url: '/buscar-producto/' + codigoBarras,
            type: 'GET',
            success: function(data) {
                // Manejar la respuesta de la base de datos
                console.log(data);
            },
            error: function(error) {
                console.error(error);
            }
        });
    });
</script>
