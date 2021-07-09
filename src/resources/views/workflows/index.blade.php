@extends(config('workflow.layout_view', 'workflow::layout'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    New Workflowddd
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Workflow</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <workflow-form submit-url="{{ route('workflow:workflows.store') }}" :types="{{ json_encode($types) }}"></workflow-form>
                        </div>
                    </div>
                </div>
            </div>
            {{ $page_title }}
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-sm mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Date Added</th>
                        <th width="40%">Action(s)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="First group">
                                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('workflow::workflows.edit', $item->id) }}">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ route('workflow::workflows.show', $item->id) }}">
                                        <i class="fa fa-crosshairs"></i> Stages
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                        <i class="fa fa-trash text-danger"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" align="center">
                                No workflows added yet
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
