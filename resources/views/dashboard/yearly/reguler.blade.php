<div class="card card-info">
  <div class="card-header border-transparent">
    <h3 class="card-title"><b>REGULER</b> <small>(IDR 000)</small></h3>
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
          @foreach ($data['reguler']['reguler_yearly'] as $item)
              <tr>
                <td>{{ $item['project'] }}</td>
                <td class="text-right">{{ number_format($item['sent_amount'] / 1000, 2) }}</td>
                <td class="text-right">{{ number_format($item['budget'] / 1000, 2) }}</td>
                <td class="text-right">{{ number_format($item['percentage'] * 100, 2) }}</td>
              </tr>
          @endforeach
          <tr>
            <th>Total</th>
            <th class="text-right">{{ number_format($data['reguler']['sent_total'] / 1000, 2) }}</th>
            <th class="text-right">{{ number_format($data['reguler']['budget_total'] / 1000, 2) }}</th>
            <th class="text-right">{{ number_format($data['reguler']['percentage'] * 100, 2) }}</th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>