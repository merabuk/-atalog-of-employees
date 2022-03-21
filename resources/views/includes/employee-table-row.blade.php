<tr>
    <td><img src="{{ asset($user->image->path) }}" class="circle" alt="Avatar"
            data-srcset="{{ asset($user->image->path) }}"
            srcset="{{ asset('images/avatar.jpg') }}"></td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->position->name }}</td>
    <td>{{ \Carbon\Carbon::parse($user->date_of_employment)->format('d.m.Y') }}</td>
    <td>{{ $user->phone }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->salary }}</td>
    <td class="text-right text-nowrap">
        <a class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit"
            href="{{ route('employees.edit', $user->id) }}">
            <i class="fa fa-lg fa-fw fa-pen"></i>
        </a>
        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete"
            data-bs-toggle="modal" data-bs-target="#deleteEmployee{{ $user->id }}" type="button">
            <i class="fa fa-lg fa-fw fa-trash"></i>
        </button>
        <div class="modal fade" id="deleteEmployee{{ $user->id }}" tabindex="-1"
            aria-labelledby="deleteEmployee{{ $user->id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteEmployee{{ $user->id }}Label">Remove employee</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to remove employee {{ $user->name }}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="{{ route('employees.destroy', $user->id) }}">Remove</a>
                    </div>
                </div>
            </div>
        </div>
        {{-- <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
            <i class="fa fa-lg fa-fw fa-eye"></i>
        </button> --}}
    </td>
</tr>
