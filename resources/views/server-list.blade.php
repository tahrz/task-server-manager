@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        <a href="{{ route('server-add') }}" class="btn btn-primary">Add new server</a>
        <a href="{{ route('server-import') }}" class="btn btn-secondary">Import from *.json</a>
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        @if($items->total() !== 0)
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">Provider</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">CPU</th>
                                    <th scope="col">Drive</th>
                                    <th scope="col">Price</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->provider }}</td>
                                        <td>{{ $item->brand }}</td>
                                        <td>{{ $item->location }}</td>
                                        <td>{{ $item->cpu }}</td>
                                        <td>{{ $item->drive }}</td>
                                        <td>{{ FormatHelper::toMoney($item->price) }}</td>
                                        <td style="width: 150px">
                                            <a href="{{ route('server-edit', ['id' => $item->id]) }}"><i
                                                    class="fa fa-edit px-2"></i></a>
                                            <a href="{{ route('server-view', ['id' => $item->id]) }}"><i
                                                    class="fa fa-eye px-2"></i></a>
                                            <form method="POST"
                                                  action="{{ route('server-delete', ['id' => $item->id]) }}"
                                                  style="display: inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-link px-0" style="display: inline"><i
                                                        class="fa fa-trash px-2"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            Empty
                        @endif
                    </div>
                </div>
                <div style="display: table" class="mx-auto">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
