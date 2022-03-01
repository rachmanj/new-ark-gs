@extends('templates.main')

@section('title_page')
    <h1>Dashboard <small>(Yearly)</small></h1>
@endsection

@section('breadcrumb_title')
    dashboard / yearly
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <form action="{{ route('dashboard.yearly.display') }}" method="POST">
              @csrf
              <div class="col-6">
                <label>Select year</label>
                <div class="input-group mb-3">
                  <select class="form-control" name="year">
                    <option value="">-- select year --</option>
                    <option value="this_year">This Year</option>
                    @foreach ($years as $year)
                      <option value="{{ $year->date }}">{{ date('Y', strtotime($year->date)) }}</option>
                    @endforeach
                  </select>
                  <span class="input-group-append">
                    <button type="submit" class="btn btn-info btn-flat">Go!</button>
                  </span>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection