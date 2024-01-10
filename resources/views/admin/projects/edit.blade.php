@extends('layouts.app')

@section('content')
    <section>
        <h1>Projects Edit</h1>
    </section>
    <form action="{{route('admin.projects.update', $project)}}" method="POST">
        @csrf
        @method('PUT')
    
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Modifica Titolo" value="{{old('title', $project->title)}}">
        </div>        
        
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control" name="description" id="description" rows="3" placeholder="Modifica descrizione"> {{ old('description', $project->description) }} </textarea>
        </div>    
        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input type="text" class="form-control" name="image" id="image" placeholder="Modifica immagine al tuo progetto" value="{{old('image', $project->image)}}">
    
        </div>
        <div class="mb-3">
            <select name="type_id" class="form-control" id="type_id">
                <option>Seleziona una categoria</option>
                @foreach($types as $type)
                  <option @selected( old('type_id', optional($project->type)->id) == $type->id ) value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
    
        </div>
    
        <div>
            <input type="submit" class="btn btn-primary" value="Modifica">
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