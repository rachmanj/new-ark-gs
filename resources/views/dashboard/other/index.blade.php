@extends('templates.main')

@section('title_page')
    <h1>Dashboard <small>Other</small></h1> 
@endsection

@section('breadcrumb_title')
    dashboard / other
@endsection

@section('content')
    <div class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">
            @include('dashboard.other.static_v_dynamic')
          </div>
        </div>

      </div>
    </div>
@endsection