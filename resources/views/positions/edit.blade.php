@extends('adminlte::page')

@section('title', 'Edit position')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="mr-3 text-dark">Edit position</h1>
    </div>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('positions.update', $position) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                {{-- Name --}}
                                <x-adminlte-input id="name" name="name" label="Name" placeholder="Enter name of employee"
                                    min="2" max="256" error-key="name" value="{{ old('name', $position->name) }}">
                                    <x-slot name="bottomSlot">
                                        @error('name')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @else
                                            <span id="simbol-count" class="text-sm text-gray float-right">
                                                0/256
                                            </span>
                                        @enderror
                                    </x-slot>
                                </x-adminlte-input>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="text-bold">Created at: </span>{{ $position->created_at->format('d.m.Y') }}
                                        </div>
                                        <div class="col-6">
                                            <span class="text-bold">Admin created ID: </span>{{ $position->admin_created_id }}
                                        </div>
                                        <div class="col-6">
                                            <span class="text-bold">Updated at: </span>{{ $position->updated_at->format('d.m.Y') }}
                                        </div>
                                        <div class="col-6">
                                            <span class="text-bold">Admin updated ID: </span>{{ $position->admin_updated_id }}
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ route('positions.index') }}" class="btn btn-default">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
<script>
    $(document).ready(function($) {
        var name = document.getElementById('name');
        name.oninput = function() {
            document.getElementById('simbol-count').innerHTML = name.value.length+'/256';
        };
    });
</script>
@endpush
