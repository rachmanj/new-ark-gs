@extends('templates.main')

@section('title_page')
    <h1>History</h1>
@endsection

@section('breadcrumb_title')
    history
@endsection

@section('content')
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Edit History</div>
            <a href="{{ route('history.index') }}" class="btn btn-sm btn-success float-right"><i class="fas fa-undo"></i> Back</a>
          </div>
          <form action="{{ route('history.update', $history->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="card-body">
              <div class="form-group">
                <label for="name">Month</label>
                <input type="date" class="form-control" name="date" value="{{ old('date', $history->date) }}">
              </div>
              <div class="form-group">
                <label for="periode">Periode</label>
                <select name="periode" id="periode" class="form-control">
                  <option value="monthly" {{ $history->periode === 'monthly' ? 'selected' : '' }}>Monthly</option>
                  <option value="yearly" {{ $history->periode === 'yearly' ? 'selected' : '' }}>Yearly</option>
                </select>
              </div>
              <div class="form-group">
                <label for="gs_type">GS Type</label>
                <select name="gs_type" id="gs_type" class="form-control">
                  <option value="po_sent" {{ $history->gs_type === 'po_sent' ? 'selected' : '' }}>PO Sent Amount</option>
                  <option value="grpo_amount" {{ $history->gs_type === 'grpo_amount' ? '' : 'selected' }}>GRPO Amount</option>
                  <option value="incoming_qty" {{ $history->gs_type === 'incoming_qty' ? '' : 'selected' }}>Incoming Inventory Qty</option>
                  <option value="outgoing_qty" {{ $history->gs_type === 'outgoing_qty' ? '' : 'selected' }}>Outgoing Inventory Qty</option>
                </select>
              </div>
              <div class="form-group">
                <label for="project_code">Project Code</label>
                <select name="project_code" id="project_code" class="form-control">Project Code
                @foreach ($projects as $project)
                    <option value="{{ $project }}" {{ $project === $history->project_code ? 'selected' : '' }}>{{ $project }}</option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" class="form-control" name='amount' value="{{ old('amount', $history->amount) }}">
              </div>
              <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea name="remarks" id="remarks" cols="30" rows="2" class="form-control">{{ old('remarks', $history->remarks) }}</textarea>
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