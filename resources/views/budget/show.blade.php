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
          <form>
            
            <div class="card-body">
              <div class="form-group">
                <label for="name">Month</label>
                <input type="month" class="form-control" name="date" value="{{ old('date', date('Y-m', strtotime($budget->date))) }}" readonly>
              </div>
              <div class="form-group">
                <label for="budget_type">Budget Type</label>
                <input type="text" class="form-control" value="{{ $budget->budget_type->name }}" readonly>
              </div>
              <div class="form-group">
                <label for="project_code">Project Code</label>
                <input type="text" class="form-control" value="{{ $budget->project_code }}" readonly>
              </div>
              <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" class="form-control" name='amount' value="{{ number_format($budget->amount, 2)  }}" readonly>
              </div>
              <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea name="remarks" id="remarks" cols="30" rows="2" class="form-control" readonly>{{ $budget->remarks }}</textarea>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection