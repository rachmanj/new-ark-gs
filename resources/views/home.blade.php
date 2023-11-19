@extends('templates.main')

@section('title_page')
    <h1>Dashboard</h1>
@endsection

@section('breadcrumb_title')
    dashboard
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Welcome to</h5>
  
          <p class="card-text">
            <h2><b>ARKA</b> Goal Setting</h2>
            Report Date : {{ \Carbon\Carbon::now()->subDay()->format('d-M-Y'), }}
          </p>
  
        </div>
      </div>
    </div>
    <!-- /.col-md-6 -->
  </div>
  <!-- /.row -->

  @include('charts.budget')
@endsection

@section('scripts')
<script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
@include('charts.budget-script')
@endsection
