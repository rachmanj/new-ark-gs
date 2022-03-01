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
                  {{ $histories->where('project_code', $project)->where('gs_type', 'po_sent')->first() ? number_format($histories->where('project_code', $project)->where('gs_type', 'po_sent')->first()->amount / 1000, 0) : '' }}
                </td>
                <td class="text-right">
                  {{ $histories->where('project_code', $project)->where('gs_type', 'grpo_amount')->first() ? number_format($histories->where('project_code', $project)->where('gs_type', 'grpo_amount')->first()->amount / 1000, 0) : '' }}
                </td>
                <td class="text-right">
                  {{ $histories->where('project_code', $project)->where('gs_type', 'po_sent')->first() &&  $histories->where('project_code', $project)->where('gs_type', 'grpo_amount')->first() ? number_format($histories->where('project_code', $project)->where('gs_type', 'grpo_amount')->first()->amount / $histories->where('project_code', $project)->where('gs_type', 'po_sent')->first()->amount * 100, 2) : '' }}
                </td>
              </tr>
          @endforeach
          <tr>
            <th></th>
            <th>Total</th>
            <th class="text-right">{{ number_format($histories->where('gs_type', 'po_sent')->sum('amount') / 1000, 0) }}</th>
            <th class="text-right">{{ number_format($histories->where('gs_type', 'grpo_amount')->sum('amount') / 1000, 0) }}</th>
            <th class="text-right">{{ number_format(($histories->where('gs_type', 'grpo_amount')->sum('amount') / $histories->where('gs_type', 'po_sent')->sum('amount')) * 100, 2) }}</th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>