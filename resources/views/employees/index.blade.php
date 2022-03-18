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
            @php
            $headsEmployees = [
                'Photo',
                'Name',
                'Position',
                'Date of employment',
                'Phone number',
                'Email',
                'Salary',
                ['label' => 'Actions', 'no-export' => true, 'width' => 5],
            ];

            $configEmployees = [
                'data' => [],
                'order' => [[1, 'asc']],
                'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
            ];

            foreach ($users as $user) {
                $routeEdit = route('employees.edit', $user->id);
                $routeDelete = route('employees.destroy', $user->id);
                $btnEdit = '<a class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit"
                                href="'.$routeEdit.'">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>';
                $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete"
                                data-bs-toggle="modal" data-bs-target="#deleteEmployee'.$user->id.'" type="button">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>
                            <div class="modal fade" id="deleteEmployee'.$user->id.'" tabindex="-1" aria-labelledby="deleteEmployee'.$user->id.'Label"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteEmployee'.$user->id.'Label">Remove employee</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to remove employee '.$user->name.'?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <a class="btn btn-primary" href="'.$routeDelete.'">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                <i class="fa fa-lg fa-fw fa-eye"></i>
                            </button>';
                $row = [
                    '',
                    $user->name,
                    $user->position->name,
                    $user->date_of_employment,
                    $user->phone,
                    $user->email,
                    $user->salary,
                    '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'
                ];
                array_push($configEmployees['data'], $row);
            }
            @endphp

            <x-adminlte-datatable id="employees" :heads="$headsEmployees" head-theme="dark"
                :config="$configEmployees" striped hoverable bordered>
                @foreach($configEmployees['data'] as $row)
                    <tr>
                        @foreach($row as $cell)
                            <td>{!! $cell !!}</td>
                        @endforeach
                    </tr>
                @endforeach
            </x-adminlte-datatable>

            {{-- <x-adminlte-card>
                <div class="table-responsive">
                    <table id="employees" class="table table-sm table-striped table-bordered w-100">
                        <thead>
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
                                <tr>
                                    <td></td>
                                    <td>{{ $user->name ?? '' }}</td>
                                    <td>{{ $user->position->name ?? '' }}</td>
                                    <td>{{ $user->date_of_employment }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->salary }}</td>
                                    <td class="text-right text-nowrap">
                                        <a class="btn btn-info btn-sm" href="{{ route('employees.edit', $user->id)}}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <btn-confirm-sweet type="danger"
                                            btn-icon="fas fa-trash"
                                            title="Удалить"
                                            text="Удалить пользователя {{ $user->name ?? 'выбранного' }}?"
                                            action-url="{{ route('employees.destroy', $user->id)}}"
                                            action-method="delete"></btn-confirm-sweet>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Записи отсутствуют</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-adminlte-card> --}}
        </div>
    </div>
@stop

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@push('js')
<script>
    $(document).ready(function() {
        // $('#employees').DataTable({
        //     // language: {
        //     //     url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Russian.json'
        //     // },
        //     'aoColumnDefs': [{
        //         'bSortable': false,
        //         'aTargets': [-1] //Отключение сортировки по последнему полю (-1 - первое справа)
        //     }],
        // });
    });
</script>
@endpush
