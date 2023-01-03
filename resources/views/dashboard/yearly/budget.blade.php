<div class="card card-info">
  <div class="card-header border-transparent">
    <h3 class="card-title"><b>PO Sent vs Plant Budget</b> <small>(IDR 000)</small></h3>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table m-0 table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Project</th>
            <th class="text-right">PO Sent</th>
            <th class="text-right">Budget</th>
            <th class="text-right">%</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projects as $project)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $project }}</td>
                <td class="text-right">
                  {{ $histories->where('project_code', $project)->where('gs_type', 'po_sent')->first() ? number_format($histories->where('project_code', $project)->where('gs_type', 'po_sent')->first()->amount / 1000, 2) : '-' }}
                </td>
                <td class="text-right">
                  {{ $plant_budget->where('project_code', $project)->first() ? number_format($plant_budget->where('project_code', $project)->first()->budget_amount / 1000, 2) : '-' }}
                </td>
                <td class="text-right">
                  {{ $histories->where('project_code', $project)->where('gs_type', 'po_sent')->first() && $plant_budget->where('project_code', $project)->first() ? number_format($histories->where('project_code', $project)->where('gs_type', 'po_sent')->first()->amount / $plant_budget->where('project_code', $project)->first()->budget_amount * 100, 2) : '-' }}
                </td>
              </tr>
          @endforeach
          <tr>
            <th></th>
            <th>Total</th>
            <th class="text-right">{{ number_format($histories->where('gs_type', 'po_sent')->sum('amount') / 1000, 2) }}</th>
            <th class="text-right">{{ number_format($plant_budget->sum('budget_amount') / 1000, 2) }}</th>
            <th class="text-right">{{ number_format(($histories->where('gs_type', 'po_sent')->sum('amount') / $plant_budget->sum('budget_amount')) * 100, 2) }}</th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>