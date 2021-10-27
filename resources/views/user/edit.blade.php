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
                        {!! Form::label('name', 'Nome:') !!}
                        <p>{{ $user->getName() }}</p>
                    </div>

                    <div class="col-xs-3">
                        {!! Form::label('username', 'Usuário/Matrícula:') !!}
                        <p>{{ $user->getUsername() }}</p>
                    </div>
                </div>
                
                <br>
                
                {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'patch', 'files' => true,'enctype'=>'multipart/form-data']) !!}
                <div class="row">
                    <div class="col-xs-3">
                        {!! Form::label('avatar', 'Foto de Perfil:') !!}
                        <img style="display:block;max-width: 200px;" src="/uploads/avatars/{{ $user->getAvatar() }} "/>
                    </div>

                    <div class="col-xs-3">
                        {!! Form::label('', 'Alterar Foto de Perfil:') !!}
                        {!! Form::file('avatar') !!}
                        <br>
                    </div>

                    <div class="col-xs-12" style="margin-top:30px">
                        {!! Form::label('', 'Turma:') !!}
                        {!! Form::select('turma', $turmas, $user->turma) !!}
                    </div>

                    <div class="col-xs-12" style="margin-top:30px">
                        {!! Form::submit('Salvar Alterações', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('users.index') }}" class="btn btn-default">Voltar</a>
                    </div>

                    
               </div>
               {{ Form::close() }}

               <div class="row">
                    @include('user.fields')
               </div>
           </div>
       </div>
   </div>
@endsection