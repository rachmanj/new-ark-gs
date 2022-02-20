@extends('templates.main')

@section('title_page')
    <h1>Dashboard <small>(Monthly)</small></h1>
@endsection

@section('breadcrumb_title')
    dashboard / monthly
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <form action="{{ route('dashboard.monthly.display') }}" method="POST">
              @csrf
              <div class="col-6">
                <label>Select month</label>
                <div class="input-group mb-3">
                  <input type="month" name="month" class="form-control rounded-0">
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