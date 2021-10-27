@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Turma
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($turma, ['route' => ['turmas.update', $turma->id], 'method' => 'patch']) !!}

                        @include('turmas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection