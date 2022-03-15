@extends('adminlte::page')

@section('title', 'Create an employee')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="mr-3 text-dark">Create an employee</h1>
    </div>
@stop

@section('plugins.BsCustomFileInput', true)

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <img id="avatar" src="#" alt="your avatar" style="max-height: 300px; max-width: 300px"/>
                                <x-adminlte-input-file id="image" name="image" label="Photo"
                                    placeholder="Choose a file..." legend="Browse">
                                    <x-slot name="bottomSlot">
                                        <span class="text-sm text-gray">
                                            File format jpg, png up to 5MB, the minimum size of 300x300px
                                        </span>
                                    </x-slot>
                                </x-adminlte-input-file>
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
                                <x-adminlte-input id="phone" name="phone" label="Phone" placeholder="Enter phone of employee"
                                    type="tel" error-key="phone" value="{{ old('phone') ?? '+380'}}">
                                    <x-slot name="bottomSlot">
                                        @error('phone')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @else
                                            <span id="simbol-count" class="text-sm text-gray float-right">
                                                Required format +380 (xx) XXX XX XX
                                            </span>
                                        @enderror
                                    </x-slot>
                                </x-adminlte-input>
                                <button type="submit" class="btn btn-primary">Створити</button>
                                <a href="{{ route('employees.index') }}" class="btn btn-default">Відміна</a>
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
        image.onchange = evt => {
            const [file] = image.files;
            if (file) {
                avatar.src = URL.createObjectURL(file);
            }
        }
        var name = document.getElementById('name');
        name.oninput = function() {
            document.getElementById('simbol-count').innerHTML = name.value.length+'/256';
        };
        jQuery(function($){
            $.mask.definitions['~']='[+380]';
            $('input[type=tel]').mask('~ (99) 999 99 99', {placeholder:" "}, {autoclear: false});
        });
    });
</script>
@endpush
