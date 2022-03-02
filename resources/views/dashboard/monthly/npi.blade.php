<div class="card">
  <div class="card-header border-transparent">
    <h3 class="card-title"><b>NPI</b></h3>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table m-0">
        <thead>
          <tr>
            <th>Project</th>
            <th class="text-right">In</th>
            <th class="text-right">Out</th>
            <th class="text-right">index</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projects as $project)
              <tr>
                <td>{{ $project }}</td>
                <td class="text-right">
                  {{ $histories->where('project_code', $project)->where('gs_type', 'incoming_qty')->first() ? number_format($histories->where('project_code', $project)->where('gs_type', 'incoming_qty')->first()->amount, 0) : '' }}
                </td>
                <td class="text-right">
                  {{ $histories->where('project_code', $project)->where('gs_type', 'outgoing_qty')->first() ? number_format($histories->where('project_code', $project)->where('gs_type', 'outgoing_qty')->first()->amount, 0) : '' }}
                </td>
                <td class="text-right">
                  {{ $histories->where('project_code', $project)->where('gs_type', 'incoming_qty')->first() &&  $histories->where('project_code', $project)->where('gs_type', 'outgoing_qty')->first() ? number_format($histories->where('project_code', $project)->where('gs_type', 'incoming_qty')->first()->amount / $histories->where('project_code', $project)->where('gs_type', 'outgoing_qty')->first()->amount, 2) : '' }}
                </td>
              </tr>
          @endforeach
          <tr>
            <th>Total</th>
            <th class="text-right">{{ number_format($histories->where('gs_type', 'incoming_qty')->sum('amount'), 0) }}</th>
            <th class="text-right">{{ number_format($histories->where('gs_type', 'outgoing_qty')->sum('amount'), 0) }}</th>
            <th class="text-right">{{ $histories->where('gs_type', 'incoming_qty')->count() > 0 && $histories->where('gs_type', 'outgoing_qty')->count() > 0 ? number_format($histories->where('gs_type', 'incoming_qty')->sum('amount') / $histories->where('gs_type', 'outgoing_qty')->sum('amount'), 2) : '-' }}</th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>