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

                    <div class="col-xs-3">
                        <!-- Created At Field -->
                        {!! Form::label('avatar', 'Foto de Perfil:') !!}
                        <img style="display:block;max-width: 200px;" src="/uploads/avatars/{{ $user->getAvatar() }} "/>
                    </div>

                    <div class="col-xs-3">
                    {!! Form::label('', 'Alterar Foto de Perfil:') !!}
                    {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'patch', 'files' => true,'enctype'=>'multipart/form-data']) !!}
                        {!! Form::file('avatar') !!}
                        <br>
                        {!! Form::submit('Alterar foto', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('users.index') }}" class="btn btn-default">Voltar</a>
                    {{ Form::close() }}
                    </div>

                    
                    




               </div>

               <div class="row">
                    @include('user.fields')
               </div>
           </div>
       </div>
   </div>
@endsection