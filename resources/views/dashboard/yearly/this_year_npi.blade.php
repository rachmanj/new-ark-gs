<div class="card card-info">
  <div class="card-header border-transparent">
    <h3 class="card-title">NPI</h3>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table m-0 table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Project</th>
            <th class="text-right">In</th>
            <th class="text-right">Out</th>
            <th class="text-right">index</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projects as $project)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $project }}</td>
                <td class="text-right">
                  {{ $incoming_qty->where('project_code', $project)->first() ? number_format($incoming_qty->where('project_code', $project)->first()->quantity, 0) : '' }}
                </td>
                <td class="text-right">
                  {{ $outgoing_qty->where('project_code', $project)->first() ? number_format($outgoing_qty->where('project_code', $project)->first()->quantity, 0) : '' }}
                </td>
                <td class="text-right">
                  {{ $incoming_qty->where('project_code', $project)->first() && $outgoing_qty->where('project_code', $project)->first() ? number_format($incoming_qty->where('project_code', $project)->first()->quantity / $outgoing_qty->where('project_code', $project)->first()->quantity, 2) : '' }}
                </td>
              </tr>
          @endforeach
          <tr>
            <th></th>
            <th>Total</td>
            <th class="text-right">{{ number_format($incoming_qty->sum('quantity'), 0) }}</th>
            <th class="text-right">{{ number_format($outgoing_qty->sum('quantity'), 0) }}</th>
            <th class="text-right">{{ $incoming_qty->sum('quantity') && $outgoing_qty->sum('quantity') ? number_format($incoming_qty->sum('quantity') / $outgoing_qty->sum('quantity'), 2) : '-' }}</th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>