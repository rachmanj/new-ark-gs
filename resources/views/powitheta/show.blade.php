@extends('templates.main')

@section('title_page')
    <h1>PO With ETA</h1>
@endsection

@section('breadcrumb_title')
    powitheta
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">PO Detail</div>
            <a href="{{ route('powitheta.index') }}" class="btn btn-sm btn-success float-right"><i class="fas fa-undo"></i> Back</a>
          </div>
          <div class="card-body">
            <dl class="row">
              <dt class="col-sm-4 text-right">PO No</dt>
              <dd class="col-sm-8">{{ $powitheta->po_no }}</dd>
              <dt class="col-sm-4 text-right">Create Date</dt>
              <dd class="col-sm-8">{{ $powitheta->create_date }}</dd>
              <dt class="col-sm-4 text-right">Posting Date</dt>
              <dd class="col-sm-8">{{ $powitheta->posting_date }}</dd>
              <dt class="col-sm-4 text-right">Vendor Code</dt>
              <dd class="col-sm-8">{{ $powitheta->vendor_code }}</dd>
              <dt class="col-sm-4 text-right">Item Code</dt>
              <dd class="col-sm-8">{{ $powitheta->item_code }}</dd>
              <dt class="col-sm-4 text-right">Item Desc</dt>
              <dd class="col-sm-8">{{ $powitheta->description }}</dd>
              <dt class="col-sm-4 text-right">Budget Type</dt>
              <dd class="col-sm-8">{{ $powitheta->budget_type }}</dd>
              <dt class="col-sm-4 text-right">UOM</dt>
              <dd class="col-sm-8">{{ $powitheta->uom }}</dd>
              <dt class="col-sm-4 text-right">Qty</dt>
              <dd class="col-sm-8">{{ $powitheta->qty }}</dd>
              <dt class="col-sm-4 text-right">Unit No</dt>
              <dd class="col-sm-8">{{ $powitheta->unit_no }}</dd>
              <dt class="col-sm-4 text-right">Project Code</dt>
              <dd class="col-sm-8">{{ $powitheta->project_code }}</dd>
              <dt class="col-sm-4 text-right">Dept Code</dt>
              <dd class="col-sm-8">{{ $powitheta->dept_code }}</dd>
              <dt class="col-sm-4 text-right">Currency</dt>
              <dd class="col-sm-8">{{ $powitheta->po_currency }}</dd>
              <dt class="col-sm-4 text-right">Unit Price</dt>
              <dd class="col-sm-8">{{ $powitheta->unit_price }}</dd>
              <dt class="col-sm-4 text-right">Item Amount</dt>
              <dd class="col-sm-8">{{ $powitheta->item_amount }}</dd>
              <dt class="col-sm-4 text-right">Total PO Price</dt>
              <dd class="col-sm-8">{{ $powitheta->total_po_price }}</dd>
              <dt class="col-sm-4 text-right">PO + VAT</dt>
              <dd class="col-sm-8">{{ $powitheta->po_with_vat }}</dd>
              <dt class="col-sm-4 text-right">PO Status</dt>
              <dd class="col-sm-8">{{ $powitheta->po_status }}</dd>
              <dt class="col-sm-4 text-right">Delivery Status</dt>
              <dd class="col-sm-8">{{ $powitheta->po_delivery_status }}</dd>
              <dt class="col-sm-4 text-right">Delivery Date</dt>
              <dd class="col-sm-8">{{ $powitheta->po_delivery_date }}</dd>
              <dt class="col-sm-4 text-right">ETA</dt>
              <dd class="col-sm-8">{{ $powitheta->po_eta }}</dd>
              <dt class="col-sm-4 text-right">Remarks</dt>
              <dd class="col-sm-8">{{ $powitheta->remarks }}</dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
@endsection