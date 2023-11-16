<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Project</th>
            <th>Budget</th>
            <th class="text-right">Realization</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($regulers as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item['project'] }}</td>
            <td>{{ $item['reguler_budget'] }}</td>
            <td class="text-right">{{ $item['reguler_sent_amount'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>



@foreach ($regulers as $item)
    
@endforeach