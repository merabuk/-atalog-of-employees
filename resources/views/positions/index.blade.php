@extends('adminlte::page')

@section('title', 'Positions')

@section('content_header')
    @include('includes.flash')
    <div class="d-flex justify-content-between">
        <h1 class="mr-3 text-dark">Positions</h1>
        <a class="btn bg-success" href="{{ route('positions.create') }}"><i class="fas fa-plus-circle"></i> Create position</a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <x-adminlte-card>
                <div class="table-responsive">
                    <table id="positions" class="table table-sm table-striped table-bordered w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th>Name</th>
                                <th>Last update</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($positions as $position)
                                @include('includes.position-table-row', ['position' => $position])
                            @empty
                                <tr>
                                    <td colspan="3">No data available in table</td>
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
            $('#positions').DataTable({
                stateSave: true,
                // language: {
                //     url: '{{ asset("/js/backend/plugins/datatables/lang.json") }}'
                // },
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1] //Отключение сортировки по последнему полю (-1 - первое справа)
                }],
            });

            $('.delete-position').on('submit', function(e) {
              e.preventDefault();

              $.ajax({
                  type: 'post',
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: $(this).data('route'),
                  data: {
                    '_method': 'delete'
                  },
                  success: function (response, textStatus, xhr) {
                    if (response == 'deleted') {
                        document.location.reload();
                    };
                  }
              });
            });
        });
    </script>
@endpush
