@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Usuário
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
               <div class="col-xs-3">
                        <!-- Created At Field -->
                        {!! Form::label('name', 'Nome:') !!}
                        <p>{{ $user->getName() }}</p>
                    </div>

                    <div class="col-xs-3">
                        <!-- Created At Field -->
                        {!! Form::label('username', 'Usuário/Matrícula:') !!}
                        <p>{{ $user->getUsername() }}</p>
                    </div>
                    
                   {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'patch']) !!}

                        @include('user.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection