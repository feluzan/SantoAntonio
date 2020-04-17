@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gerenciamento de Auxílios
        </h1>
        <h2>
            {{ $user->name }} - {{ $user->username }}
        </h2>
   </section>

   <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        <div class="box box-primary">
            <div class="box-body">
                    @include('auxilios.individual_table')
            </div>
        </div>
    </div>

   
@endsection