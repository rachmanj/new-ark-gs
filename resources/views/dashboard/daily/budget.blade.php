<div class="card card-info">
  <div class="card-header border-transparent">
    <h3 class="card-title"><b>PO Sent vs Plant Budget</b> <small>(IDR 000)</small></h3>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table m-0 table-striped">
        <thead>
          <tr>
            <th>Project</th>
            <th class="text-right">PO Sent</th>
            <th class="text-right">Budget</th>
            <th class="text-right">%</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projects as $project)
              <tr>
                <td>{{ $project }}</td>
                <td class="text-right">
                  {{ $po_sent->where('project_code', $project)->count() > 0 ? number_format($po_sent->where('project_code', $project)->sum('item_amount') / 1000, 2) : '-' }}
                </td>
                <td class="text-right">
                  {{ $plant_budget->where('project_code', $project)->first() ? number_format($plant_budget->where('project_code', $project)->first()->amount / 1000, 2) : '-' }}
                </td>
                <td class="text-right">
                  {{ $po_sent->where('project_code', $project)->count() > 0 && $plant_budget->where('project_code', $project)->first() ? number_format($po_sent->where('project_code', $project)->sum('item_amount') / $plant_budget->where('project_code', $project)->first()->amount * 100, 2) : '-' }}
                </td>
              </tr>
          @endforeach
          <tr>
            <th>Total</th>
            <th class="text-right">{{ number_format($po_sent->sum('item_amount') / 1000, 2) }}</th>
            <th class="text-right">{{ number_format($plant_budget->sum('amount') / 1000, 2) }}</th>
            <th class="text-right">{{ number_format(($po_sent->sum('item_amount') / $plant_budget->sum('amount')) * 100, 2) }}</th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>