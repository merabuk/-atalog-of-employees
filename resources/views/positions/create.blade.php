@extends('adminlte::page')

@section('title', 'Create position')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="mr-3 text-dark">Create position</h1>
    </div>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form id="create-employee" action="{{ route('positions.store') }}" method="POST">
                                @csrf
                                {{-- Name --}}
                                <x-adminlte-input id="name" name="name" label="Name" placeholder="Enter name of employee"
                                    min="2" max="256" error-key="name" value="{{ old('name') }}">
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
