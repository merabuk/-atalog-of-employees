<tr>
    <td>{{ $position->name }}</td>
    <td>{{ $position->updated_at->format('d.m.Y') }}</td>
    <td class="text-right text-nowrap">
        <a class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit"
            href="{{ route('positions.edit', $position->id) }}">
            <i class="fa fa-lg fa-fw fa-pen"></i>
        </a>
        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete"
            data-bs-toggle="modal" data-bs-target="#deletePosition{{ $position->id }}" type="button">
            <i class="fa fa-lg fa-fw fa-trash"></i>
        </button>
        <div class="modal fade" id="deletePosition{{ $position->id }}" tabindex="-1"
            aria-labelledby="deletePosition{{ $position->id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletePosition{{ $position->id }}Label">Remove position</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to remove position {{ $position->name }}?
                    </div>
                    <div class="modal-footer">
                        <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form method="post" class="delete-position" data-route="{{ route('positions.destroy', $position) }}">
                            @method('delete')
                            <button class="btn btn-danger" type="submit">Remove</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
            <i class="fa fa-lg fa-fw fa-eye"></i>
        </button> --}}
    </td>
</tr>
