<div class="card">
  <div class="card-header border-transparent">
    <h3 class="card-title">PO Sent vs GRPO</h3>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table m-0">
        <thead>
          <tr>
            <th>#</th>
            <th>Project</th>
            <th class="text-right">PO Sent (IDR 000)</th>
            <th class="text-right">GRPO (IDR 000)</th>
            <th class="text-center">%</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projects as $project)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $project }}</td>
                <td class="text-right">
                  {{ $po_sent->where('project_code', $project) ? number_format($po_sent->where('project_code', $project)->sum('item_amount') / 1000, 0) : '' }}
                </td>
                <td class="text-right">
                  {{ $grpo_amount->where('project_code', $project) ? number_format($grpo_amount->where('project_code', $project)->sum('item_amount') / 1000, 0) : '' }}
                </td>
                <td class="text-right">
                  {{ $po_sent->where('project_code', $project) &&  $grpo_amount->where('project_code', $project)->count() > 0 ? number_format($grpo_amount->where('project_code', $project)->sum('item_amount') / $po_sent->where('project_code', $project)->sum('item_amount') * 100, 2) : '' }}
                </td>
              </tr>
          @endforeach
          <tr>
            <th></th>
            <th>Total</th>
            <th class="text-right">{{ number_format($po_sent->sum('item_amount') / 1000, 0) }}</th>
            <th class="text-right">{{ number_format($grpo_amount->sum('item_amount') / 1000, 0) }}</th>
            <th class="text-right">{{ number_format(($grpo_amount->sum('item_amount') / $po_sent->sum('item_amount')) * 100, 2) }}</th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>