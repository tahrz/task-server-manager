@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <div class="justify-content-center mt-4">
            <form method="POST"
                  action="{{  !empty($item) ? route('server-update', ['id' => $item->id]) : route('server-store') }}">
                <div class="card">
                    <div class="card-body">
                        @csrf

                        @if(Session::has('status'))
                            <div
                                class="alert alert-warning mb-2 mt-2 px-2 pt-1 pb-1 pr-2">{{ Session::get('status') }}</div>
                        @endif

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="provider">Provider</label>
                                    <input id="provider" type="text" name="provider"
                                           class="form-control @error('provider') is-invalid @enderror"
                                           value="{{ !empty($item) ? $item->provider : '' }}">
                                    @error('provider')
                                    <div class="alert alert-danger mb-2 mt-2 px-2 pt-1 pb-1 pr-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="brand">Brand</label>
                                    <input id="brand" type="text" name="brand"
                                           class="form-control @error('brand') is-invalid @enderror"
                                           value="{{ !empty($item) ? $item->brand : '' }}">
                                    @error('brand')
                                    <div class="alert alert-danger mb-2 mt-2 px-2 pt-1 pb-1 pr-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input id="location" type="text" name="location"
                                           class="form-control @error('location') is-invalid @enderror"
                                           value="{{ !empty($item) ? $item->location : '' }}">
                                    @error('location')
                                    <div class="alert alert-danger mb-2 mt-2 px-2 pt-1 pb-1 pr-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cpu">CPU</label>
                                    <input id="cpu" type="text" name="cpu"
                                           class="form-control @error('cpu') is-invalid @enderror"
                                           value="{{ !empty($item) ? $item->cpu : '' }}">
                                    @error('cpu')
                                    <div class="alert alert-danger mb-2 mt-2 px-2 pt-1 pb-1 pr-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="drive">Drive</label>
                                    <input id="drive" type="text" name="drive"
                                           class="form-control @error('drive') is-invalid @enderror"
                                           value="{{ !empty($item) ? $item->drive : '' }}">
                                    @error('drive')
                                    <div class="alert alert-danger mb-2 mt-2 px-2 pt-1 pb-1 pr-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input id="price" type="text" name="price"
                                           class="form-control @error('price') is-invalid @enderror"
                                           value="{{ !empty($item) ? $item->price : '' }}">
                                    @error('price')
                                    <div class="alert alert-danger mb-2 mt-2 px-2 pt-1 pb-1 pr-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('server-list') }}" class="btn btn-secondary mt-4 float-left">Back</a>
                <button class="btn btn-primary mt-4 float-right">{{ !empty($item) ? 'Update' : 'Create' }}</button>
            </form>

        </div>
@endsection
