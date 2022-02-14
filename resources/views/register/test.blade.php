{{-- {{ $projects['data'] }} --}}

@foreach ($projects as $item)
    <li>{{ $item['project_code'] }}</li>
@endforeach