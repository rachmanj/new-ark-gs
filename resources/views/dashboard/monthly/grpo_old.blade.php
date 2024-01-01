<div class="card card-info">
  <div class="card-header border-transparent">
    <h3 class="card-title"><b>PO Sent vs GRPO</b> <small>(IDR 000)</small></h3>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table m-0 table-striped">
        <thead>
          <tr>
            <th>Project</th>
            <th class="text-right">PO Sent</th>
            <th class="text-right">GRPO</th>
            <th class="text-right">%</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projects as $project)
              <tr>
                <td>{{ $project }}</td>
                <td class="text-right">
                  {{ $histories->where('project_code', $project)->where('gs_type', 'po_sent')->first() ? number_format($histories->where('project_code', $project)->where('gs_type', 'po_sent')->first()->amount / 1000, 2) : '' }}
                </td>
                <td class="text-right">
                  {{ $histories->where('project_code', $project)->where('gs_type', 'grpo_amount')->first() ? number_format($histories->where('project_code', $project)->where('gs_type', 'grpo_amount')->first()->amount / 1000, 2) : '' }}
                </td>
                <td class="text-right">
                  {{ $histories->where('project_code', $project)->where('gs_type', 'po_sent')->first() &&  $histories->where('project_code', $project)->where('gs_type', 'grpo_amount')->first() ? number_format($histories->where('project_code', $project)->where('gs_type', 'grpo_amount')->first()->amount / $histories->where('project_code', $project)->where('gs_type', 'po_sent')->first()->amount * 100, 2) : '' }}
                </td>
              </tr>
          @endforeach
          <tr>
            <th>Total</th>
            <th class="text-right">{{ number_format($histories->where('gs_type', 'po_sent')->sum('amount') / 1000, 2) }}</th>
            <th class="text-right">{{ number_format($histories->where('gs_type', 'grpo_amount')->sum('amount') / 1000, 2) }}</th>
            <th class="text-right">{{ $histories->where('project_code', $project)->where('gs_type', 'po_sent')->count() > 0 && $histories->where('gs_type', 'grpo_amount')->count() > 0 ? number_format(($histories->where('gs_type', 'grpo_amount')->sum('amount') / $histories->where('gs_type', 'po_sent')->sum('amount')) * 100, 2) : '-' }}</th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>