@extends('adminlte::page')

@section('title', 'Employees')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="mr-3 text-dark">Employees</h1>
        <a class="btn bg-success" href="{{ route('employees.create') }}"><i class="fas fa-plus-circle"></i> Create an employee</a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <x-adminlte-card>
                <div class="table-responsive">
                    <table id="employees" class="table table-sm table-striped table-bordered w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Date of employment</th>
                                <th>Phone number</th>
                                <th>Email</th>
                                <th>Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                @include('includes.employee-table-row', ['user' => $user])
                            @empty
                                <tr>
                                    <td colspan="8">No data available in table</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-adminlte-card>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@push('js')
    <script>
        $(document).ready(function() {
            $('#employees')
            .on('order.dt',  function () { eventFired(); })
            .on('search.dt', function () { eventFired(); })
            .on('page.dt',   function () { eventFired(); })
            .DataTable({
                stateSave: true,
                // language: {
                //     url: '{{ asset("/js/backend/plugins/datatables/lang.json") }}'
                // },
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1] //Отключение сортировки по последнему полю (-1 - первое справа)
                }],
            });

            function eventFired() {
                $(document).ready(function() {
                    lozad('img[data-srcset]').observe();
                });
            }
        });
    </script>
@endpush
