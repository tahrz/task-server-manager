@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <form method="POST" action="{{ route('server-import-post') }}" enctype="multipart/form-data">
            <div class="justify-content-center mt-4">
                <div class="card">
                    <div class="card-body">
                        @csrf

                        @if(Session::has('status'))
                            <div
                                class="alert alert-info mb-2 mt-2 px-2 pt-1 pb-1 pr-2">{{ Session::get('status') }}</div>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="dump">Server items dump <span
                                            class="badge badge-warning">*.json only</span></label><br>
                                    <input id="dump" type="file" name="dump"
                                           class="@error('dump') is-invalid @enderror">
                                </div>

                                @error('dump')
                                <div class="alert alert-danger mb-2 mt-2 px-2 pt-1 pb-1 pr-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('server-list') }}" class="btn btn-secondary mt-4 float-left">Back</a>
            <button class="btn btn-primary mt-4 float-right">Import</button>
        </form>

    </div>
@endsection
