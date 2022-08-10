@extends('templates.main')

@section('title_page')
    <h1>Recap <small><a href="{{ route('dashboard.other.index') }}">PO Send</a></small> | <small><b>GRPO</b></small></h1> 
@endsection

@section('breadcrumb_title')
    dashboard / other
@endsection

@section('content')
    <div class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">
            @include('dashboard.other.grpo')
          </div>
        </div>

      </div>
    </div>
@endsection