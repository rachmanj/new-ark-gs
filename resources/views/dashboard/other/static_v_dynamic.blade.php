<div class="card card-info">
  <div class="card-header border-transparent">
    <h3 class="card-title"><b>PO Sent: Static vs Dynamic Data</b> <small>(IDR 000)</small></h3>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table m-0 table-striped table-bordered">
        <thead>
          <tr>
            <th class="text-center" rowspan="2">Month</th>
            @foreach ($projects as $project)
              <th class="text-center" colspan="2">{{ $project }}</th>
            @endforeach
          </tr>
          <tr>
            @foreach ($projects as $project)
              <th class="text-center">S</th>
              <th class="text-center">D</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @foreach ($months as $item)
              <tr>
                <td>{{ date('F', strtotime('2022-' . $item->month . '-01')) }}</td>
                @foreach ($projects as $project)
                  <td class="text-right">
                    {{ $static_posent->where('project_code', $project)->where('month', $item->month)->first() ? number_format($static_posent->where('project_code', $project)->where('month', $item->month)->first()->amount / 1000, 0) : '-' }}
                  </td>
                  <td class="text-right
                  {{ $static_posent->where('project_code', $project)->where('month', $item->month)->first() ?
                     $static_posent->where('project_code', $project)->where('month', $item->month)->first()->amount - $dynamic_posent->where('project_code', $project)->where('month', $item->month)->sum('item_amount') > 100 ? 'text-red' : '' : ''
                  }} ">
                    {{ $dynamic_posent->where('project_code', $project)->where('month', $item->month)->count() > 0 ? number_format($dynamic_posent->where('project_code', $project)->where('month', $item->month)->sum('item_amount') / 1000, 0) : '-' }}
                  </td>
                @endforeach
              </tr>
          @endforeach
        </tbody>
        {{-- <tfoot>
          <tr>
            <th>Total</th>
            @foreach ($projects as $project)
            <th class="text-right">
              {{ number_format($static_posent->where('project_code', $project)->sum('amount') / 1000, 0) }}
            </th>
            <th class="text-right">
              {{ number_format($dynamic_posent->where('project_code', $project)->sum('item_amount') / 1000, 0) }}
            </th>
            @endforeach
          </tr>
        </tfoot> --}}
      </table>
    </div>
  </div>
</div>