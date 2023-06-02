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
                  {{ $po_sent->where('project_code', $project)->count() > 0 ? number_format($po_sent->where('project_code', $project)->sum('item_amount') / 1000, 2) : '-' }}
                </td>
                <td class="text-right">
                  {{ $grpo->where('project_code', $project)->count() > 0 ? number_format($grpo->where('project_code', $project)->sum('item_amount') / 1000, 2) : '-' }}
                </td>
                <td class="text-right">
                  {{ $grpo->where('project_code', $project)->count() > 0 &&  $po_sent->where('project_code', $project)->count() > 0 ? number_format($grpo->where('project_code', $project)->sum('item_amount') / $po_sent->where('project_code', $project)->sum('item_amount') * 100, 2) : '-' }}
                </td>
              </tr>
          @endforeach
          <tr>
            <th>Total</th>
            <th class="text-right">{{ number_format($po_sent->sum('item_amount') / 1000, 2) }}</th>
            <th class="text-right">{{ number_format($grpo->sum('item_amount') / 1000, 2) }}</th>
            <th class="text-right">{{ $grpo->sum('item_amount') > 0 && $po_sent->sum('item_amount') > 1 ? number_format(($grpo->sum('item_amount') / $po_sent->sum('item_amount')) * 100, 2) : '-' }}</th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>