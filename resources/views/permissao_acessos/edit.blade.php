@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Permissao Acesso
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($permissaoAcesso, ['route' => ['permissaoAcessos.update', $permissaoAcesso->id], 'method' => 'patch']) !!}

                        @include('permissao_acessos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection