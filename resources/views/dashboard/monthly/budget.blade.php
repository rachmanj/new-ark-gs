<div class="card">
  <div class="card-header">
    <h3 class="card-title">PO Sent vs Plant Budget</h3>
  </div>
  <div class="card-body">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Project</th>
          <th>PO Sent</th>
          <th>Budget</th>
          <th class="text-center">%</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($projects as $project)
            <tr>
              <td>{{ $project }}</td>
              <td class="text-right">
                {{ $histories->where('project_code', $project)->where('gs_type', 'po_sent')->first() ? number_format($histories->where('project_code', $project)->where('gs_type', 'po_sent')->first()->amount / 1000, 0) : '' }}
              </td>
              <td class="text-right">
                {{ $plant_budget->where('project_code', $project)->first() ? number_format($plant_budget->where('project_code', $project)->first()->amount / 1000, 0) : '' }}
              </td>
              <td class="text-right">
                {{ $histories->where('project_code', $project)->where('gs_type', 'po_sent')->first() && $plant_budget->where('project_code', $project)->first() ? number_format($histories->where('project_code', $project)->where('gs_type', 'po_sent')->first()->amount / $plant_budget->where('project_code', $project)->first()->amount * 100, 2) : '' }}
              </td>
            </tr>
        @endforeach
        <tr>
          <th>Total</th>
          <th class="text-right">{{ number_format($histories->where('gs_type', 'po_sent')->sum('amount') / 1000, 0) }}</th>
          <th class="text-right">{{ number_format($plant_budget->sum('amount') / 1000, 0) }}</th>
          <th class="text-right">{{ number_format(($histories->where('gs_type', 'po_sent')->sum('amount') / $plant_budget->sum('amount')) * 100, 2) }}</th>
        </tr>
      </tbody>
    </table>
  </div>
</div>