@if(isset($error))

<div class="alert alert-danger" id="resposta" category="alerta" role="alert">
    {{ $error}}
  </div>

@endif

@if(isset($success))
<div class="alert alert-success"id="resposta" category="alerta" role="alert">
    {{ $success}}
  </div>
@endif

@if(session()->has('success'))
<div class="alert alert-success"id="resposta" category="alerta" role="alert"> 
        {{ session()->get('success') }}
    </div>
@endif

@if(session()->has('error'))
<div class="alert  alert-danger"id="resposta" category="alerta" role="alert"> 
        {{ session()->get('error') }}
    </div>
@endif




