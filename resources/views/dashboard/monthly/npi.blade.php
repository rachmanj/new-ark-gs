<div class="card">
  <div class="card-header">
    <h3 class="card-title">NPI</h3>
  </div>
  <div class="card-body">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Project</th>
          <th>In</th>
          <th>Out</th>
          <th class="text-center">%</th>
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
          <th class="text-right">{{ number_format($histories->where('gs_type', 'incoming_qty')->sum('amount') / $histories->where('gs_type', 'outgoing_qty')->sum('amount'), 2) }}</th>
        </tr>
      </tbody>
    </table>
  </div>
</div>