@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <div class="justify-content-center mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provider">Provider</label>
                                <input id="provider" type="text" name="provider"
                                       class="form-control"
                                       value="{{ !empty($item) ? $item->provider : '' }}" disabled>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="brand">Brand</label>
                                <input id="brand" type="text" name="brand"
                                       class="form-control"
                                       value="{{ !empty($item) ? $item->brand : '' }}" disabled>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input id="location" type="text" name="location"
                                       class="form-control"
                                       value="{{ !empty($item) ? $item->location : '' }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cpu">CPU</label>
                                <input id="cpu" type="text" name="cpu"
                                       class="form-control"
                                       value="{{ !empty($item) ? $item->cpu : '' }}" disabled>
                                @error('cpu')
                                <div class="alert alert-danger mb-2 mt-2 px-2 pt-1 pb-1 pr-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="drive">Drive</label>
                                <input id="drive" type="text" name="drive"
                                       class="form-control"
                                       value="{{ !empty($item) ? $item->drive : '' }}" disabled>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input id="price" type="text" name="price"
                                       class="form-control"
                                       value="{{ !empty($item) ? $item->price : '' }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('server-list') }}" class="btn btn-secondary mt-4 float-left">Back</a>

        </div>
@endsection
