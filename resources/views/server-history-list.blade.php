@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        <div class="row justify-content-center mt-4">
            <div class="col-md-3">
                <div class="list-group">
                    @foreach($navList as $key => $item)
                        <a href="{{ route('server-history-list', ['key' => $key]) }}"
                           class="list-group-item list-group-item-action{{ $key === $selectedKey ? ' active' : '' }}"
                        >{{ FormatHelper::nameFromPath($item) }}</a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-9">
                <div class="card {{ $selectedData->total() !== 0 ? 'mb-4' : '' }}">
                    <div class="card-body">
                        @if($selectedData->total() !== 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Provider</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">CPU</th>
                                    <th scope="col">Drive</th>
                                    <th scope="col">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($selectedData as $data)
                                    <tr>
                                        <td>{{ $data->provider }}</td>
                                        <td>{{ $data->brand }}</td>
                                        <td>{{ $data->location }}</td>
                                        <td>{{ $data->cpu }}</td>
                                        <td>{{ $data->drive }}</td>
                                        <td>{{ FormatHelper::toMoney($data->price) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="mb-0">Empty</p>
                        @endif
                    </div>
                </div>
                <div style="display: table;" class="mx-auto">
                    {{ $selectedData->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
