@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Usuários</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
    
        <div class="box box-primary">
            
            <div class="box-body">
                <div class="search field">
                    <!-- search form (Optional) -->
                    <form action="{{ route('users.index') }}" method="get" class="">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Buscar..."/>
                            <span class="input-group-btn">
                                <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>

                </div>
                <div class="clearfix"></div>
                    @include('user.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

