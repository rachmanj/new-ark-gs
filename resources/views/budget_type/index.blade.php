@extends('templates.main')

@section('title_page')
    <h1>Budget Type</h1>
@endsection

@section('breadcrumb_title')
    budget-type
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
            <button href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-input"><i class="fas fa-plus"></i> Budget Type</button>
          </div> <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-striped" id="budget-type">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Display Name</th>
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
            <h4 class="modal-title"> Input Budget Type</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('budget_type.store') }}" method="POST">
            @csrf
          <div class="modal-body">
              <label for="name">Name</label>
              <div class="form-group">
                <input type="text" name='name' class="form-control" required>
              </div>
              <label for="name">Display Name</label>
              <div class="form-group">
                <input type="text" name='display_name' class="form-control" required>
              </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
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
  <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/plugins/datatables/css/datatables.min.css') }}"/>
@endsection

@section('scripts')
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables/datatables.min.js') }}"></script>

  <script>
    $(function () {
      $("#budget-type").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('budget_type.data') }}',
        columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'name'},
          {data: 'display_name'},
          {data: 'action'},
        ],
        fixedHeader: true,
      })
    });
  </script>

@endsection