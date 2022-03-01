<div class="card">
  <div class="card-header border-transparent">
    <h3 class="card-title">NPI</h3>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table m-0">
        <thead>
          <tr>
            <th>#</th>
            <th>Project</th>
            <th class="text-right">In</th>
            <th class="text-right">Out</th>
            <th class="text-center">%</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projects as $project)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $project }}</td>
                <td class="text-right">
                  {{ $incoming_qty->where('project_code', $project) ? number_format($incoming_qty->where('project_code', $project)->sum('qty'), 0) : '' }}
                </td>
                <td class="text-right">
                  {{ $outgoing_qty->where('project_code', $project) ? number_format($outgoing_qty->where('project_code', $project)->sum('qty'), 0) : '' }}
                </td>
                <td class="text-right">
                  {{ $incoming_qty->where('project_code', $project)->count() > 0 &&  $outgoing_qty->where('project_code', $project)->count() > 0 ? number_format($incoming_qty->where('project_code', $project)->sum('qty') / $outgoing_qty->where('project_code', $project)->sum('qty'), 2) : '' }}
                </td>
              </tr>
          @endforeach
          <tr>
            <th></th>
            <th>Total</td>
            <th class="text-right">{{ number_format($incoming_qty->sum('qty'), 0) }}</th>
            <th class="text-right">{{ number_format($outgoing_qty->sum('qty'), 0) }}</th>
            <th class="text-right">{{ number_format($incoming_qty->sum('qty') / $outgoing_qty->sum('qty'), 2) }}</th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>