@extends(config('workflow.layout_view','workflow::layout'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mdNewAction">
                    New Action
                </button>

                <!-- Modal -->
                <div class="modal fade" id="mdNewAction" tabindex="-1" role="dialog" aria-labelledby="mdNewAction" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Action</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <action-form
                                    submit-url="{{ route('workflow::actions.new') }}"
                                    :stage="{{ json_encode($stage) }}"
                                    :stages="{{ json_encode($stages) }}"></action-form>
                        </div>
                    </div>
                </div>
            </div>
            Workflow Stage #{{ $stage->id }} Actions
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-sm mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Next Stage</th>
                        <th>Date Added</th>
                        <th width="40%">Action(s)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($actions as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->button }}</td>
                            <td>{{ $item->next_stage }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="First group">
                                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('workflow::actions.edit', $item->id) }}">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                        <i class="fa fa-trash text-danger"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" align="center">
                                No actions added yet
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection