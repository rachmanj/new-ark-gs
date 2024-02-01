@extends('templates.main')

@section('title_page')
    <h1>History</h1>
@endsection

@section('breadcrumb_title')
    history
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <button href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-input"><i
                            class="fas fa-plus"></i> History</button>
                    <button href="#" class="btn btn-sm btn-warning" data-toggle="modal"
                        data-target="#modal-generate">Generate Monthly
                        Histories</button>
                </div> <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="budget">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Period</th>
                                <th>GS Type</th>
                                <th>Project</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div> <!-- /.card-body -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-input">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Input History</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('history.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name='date' class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Periode</label>
                            <select id="periode" name="periode" class="form-control">
                                <option value="">-- select --</option>
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gs_type">GS Type</label>
                            <select id="gs_type" name="gs_type" class="form-control">
                                <option value="">-- select --</option>
                                <option value="po_sent">PO Sent Amount</option>
                                <option value="grpo_amount">GRPO Amount</option>
                                <option value="incoming_qty">Incoming Inventory Qty</option>
                                <option value="outgoing_qty">Outgoing Inventory Qty</option>
                                <option value="capex">Capex</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Project Code</label>
                            <select name="project_code" class="form-control">
                                <option value="">-- Select Project --</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project }}">{{ $project }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" name='amount' class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea name="remarks" cols="30" rows="2" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer float-left">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"> Close</button>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-generate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Generate Monthly Histories</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('history.generate_monthly') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Capture Date</label>
                            <input type="date" name='capture_date'
                                class="form-control @error('capture_date') is-invalid @enderror">
                            @error('capture_date')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer float-left">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"> Close</button>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/plugins/datatables/css/datatables.min.css') }}" />
@endsection

@section('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables/datatables.min.js') }}"></script>

    <script>
        $(function() {
            $("#budget").DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('history.data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'periode'
                    },
                    {
                        data: 'gs_type'
                    },
                    {
                        data: 'project_code'
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: 'action'
                    },
                ],
                fixedHeader: true,
                columnDefs: [{
                    "targets": [5],
                    "className": "text-right"
                }]
            })
        });
    </script>
@endsection
