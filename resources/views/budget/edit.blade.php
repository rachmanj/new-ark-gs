@extends('templates.main')

@section('title_page')
    <h1>Budget</h1>
@endsection

@section('breadcrumb_title')
    budget
@endsection

@section('content')
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Edit Budget</div>
            <a href="{{ route('budget.index') }}" class="btn btn-sm btn-success float-right"><i class="fas fa-undo"></i> Back</a>
          </div>
          <form action="{{ route('budget.update', $budget->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="card-body">
              <div class="form-group">
                <label for="name">Month</label>
                <input type="month" class="form-control" name="date" value="{{ old('date', date('Y-m', strtotime($budget->date))) }}">
              </div>
              <div class="form-group">
                <label for="budget_type">Budget Type</label>
                <select name="budget_type_id" id="budget_type" class="form-control">
                  @foreach ($budget_types as $budget_type)
                    <option value="{{ $budget_type->id }}" {{ $budget->budget_type_id == $budget_type->id ? 'selected' : '' }}>{{ $budget_type->display_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="project_code">Project Code</label>
                <select name="project_code" id="project_code" class="form-control">Project Code
                @foreach ($projects as $project)
                    <option value="{{ $project['project_code'] }}" {{ $project['project_code'] === $budget->project_code ? 'selected' : '' }}>{{ $project['project_code'] }}</option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" class="form-control" name='amount' value="{{ old('amount', $budget->amount) }}">
              </div>
              <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea name="remarks" id="remarks" cols="30" rows="2" class="form-control">{{ old('remarks', $budget->remarks) }}</textarea>
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