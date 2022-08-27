{{-- MOSTRA DETERMINADOS ERROS AO REGISTRAR DE ACORDO COM A VALIDACAO (StoreUpdadeUserForm ) --}}
@if($errors->any())
@foreach ($errors->all() as $erro)
    <div class="alert alert-danger" id="alert" role="alert">
        <button type="button" class="close" data-dismiss="alert" onclick="fechaModal()">x</button>
        {{ $erro }}
    </div>                 
@endforeach
@endif