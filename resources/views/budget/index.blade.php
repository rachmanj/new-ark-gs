@extends('templates.main')

@section('title_page')
    <h1>Budget</h1>
@endsection

@section('breadcrumb_title')
    budget
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
                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    @can('create_budget')
                        <button href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-input"><i
                                class="fas fa-plus"></i> Budget</button>
                        <button href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-copy"><i
                                class="fas fa-plus"></i> Copy Budget</button>
                    @endcan
                </div> <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="budget">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Project</th>
                                <th>Budget Name</th>
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
                    <h4 class="modal-title"> Input Budget</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('budget.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Month</label>
                            <input type="month" name='date' class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select name="budget_type_id" class="form-control">
                                <option value="">-- select type --</option>
                                @foreach ($budget_types as $item)
                                    <option value="{{ $item->id }}">{{ $item->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Project Code</label>
                            <select name="project_code" class="form-control">
                                <option value="">-- Select Project --</option>
                                @foreach ($projects as $item)
                                    {{-- <option value="{{ $item['project_code'] }}">{{ $item['project_code'] }}</option> --}}
                                    <option value="{{ $item }}">{{ $item }}</option>
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

    <div class="modal fade" id="modal-copy">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Input Budget</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('budget.copy_budget') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label>From Month</label>
                            <input type="month" name='from_month' class="form-control">
                        </div>
                        <div class="form-group">
                            <label>To Month</label>
                            <input type="month" name='to_month' class="form-control">
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
                ajax: '{{ route('budget.data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'project_code'
                    },
                    {
                        data: 'budget_type'
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
                    "targets": [4],
                    "className": "text-right"
                }]
            })
        });
    </script>
@endsection
