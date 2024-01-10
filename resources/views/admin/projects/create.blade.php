@extends('layouts.app')

@section('content')
    <section>
        <h1>Projects Create</h1>
    </section>

<form action="{{route('admin.projects.store')}}" method="POST">
    @csrf

  
    
    <div class="mb-3">
        <label for="title" class="form-label">Titolo</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Aggiungi un titolo per il progetto">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Descrizione</label>
        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Aggiungi una descrizione"></textarea>
    </div>    
    <div class="mb-3">
        <label for="image" class="form-label">Immagine</label>
        <input type="text" class="form-control" name="image" id="image" placeholder="Aggiungi un immagine al tuo progetto">

    </div>
    <div class="mb-3">
        <select name="type_id" class="form-control" id="type_id">
            <option>Seleziona una categoria</option>
            @foreach($types as $type)
              <option @selected( old('type_id') == $type->id ) value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>

    </div>

    <div>
        <input type="submit" class="btn btn-primary" value="Aggiungi">
    </div>
    

</form>
<div class="text-center">
    <button><a href="{{route('admin.projects.index')}}">Torna al Catalogo</a></button>

</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection

