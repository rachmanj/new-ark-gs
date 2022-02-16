@extends('templates.main')

@section('title_page')
    <h1>Budget Type</h1>
@endsection

@section('breadcrumb_title')
    budget-type
@endsection

@section('content')
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Edit Budget Type</div>
            <a href="{{ route('budget_type.index') }}" class="btn btn-sm btn-success float-right"><i class="fas fa-undo"></i> Back</a>
          </div>
          <form action="{{ route('budget_type.update', $budget_type->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="card-body">
              <div class="form-group">
                <label for="name">Budget Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $budget_type->name) }}">
              </div>
              <div class="form-group">
                <label for="display_name">Display Name</label>
                <input type="text" class="form-control" name='display_name' value="{{ old('display_name', $budget_type->display_name) }}">
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection