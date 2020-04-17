@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Auxilio
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($auxilio, ['route' => ['auxilios.update', $auxilio->id], 'method' => 'patch']) !!}

                        @include('auxilios.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection