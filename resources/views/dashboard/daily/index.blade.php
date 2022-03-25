@extends('templates.main')

@section('title_page')
    <h1>Dashboard <small>(This Month)</small></h1>
    Report Date: {{ $report_date }} 
@endsection

@section('breadcrumb_title')
    dashboard / daily
@endsection

@section('content')
    <div class="content">
      <div class="container-fluid">

        <div class="row">
          @include('dashboard.daily.row1')
        </div>

        <hr>

        <div class="row">
          <div class="col-6">
            @include('dashboard.daily.budget')
          </div>

          <div class="col-6">
            @include('dashboard.daily.grpo')
          </div>

        </div>

        <hr>

        <div class="row">
          <div class="col-6">
            @include('dashboard.daily.npi')
          </div>
        </div>

      </div>
    </div>
@endsection