@extends('layouts.admin')

@section('page_tools')
    <a class="btn btn-secondary btn-sm" href="{{ route('admin.tasks.queue') }}">
        <i class="fa fa-arrow-left"></i> Back to Tasks
    </a>
    @permission(['pick_tasks'])
    <a href="{{ route('admin.tasks.pick') }}" class="btn btn-danger btn-sm">
        <i class="fa fa-hand-grab-o"></i> Pick Task
    </a>
    @endpermission
@endsection
@section('content')
    <div class="card card-default card-inner">
        <div class="card-header">
            <div class="pull-right">
                <a href="{{ $task->item->getTaskViewLink() }}" target="_blank" class="btn btn-secondary btn-sm">
                    <i class="mdi mdi-eye"></i> View Questionnaire
                </a>
                @if($task->status == "pending" && $task->isMine)
                    <modal
                            title="Approve Task"
                            btn-type="success"
                            btn-title="Approve"
                            btn-size="sm"
                            btn-icon="fa fa-check-circle"
                            :show-footer="false"
                            :padded="false">
                        <approve-task-form
                                submit-url="{{ route('admin.tasks.approve', [$task->id]) }}"></approve-task-form>
                    </modal>

                    <modal
                            title="Reject Task"
                            btn-type="danger"
                            btn-title="Reject"
                            btn-size="sm"
                            btn-icon="fa fa-times"
                            :show-footer="false"
                            :padded="false">
                        <reject-task-form
                                submit-url="{{ route('admin.tasks.approve', [$task->id]) }}"></reject-task-form>
                    </modal>
                @endif
            </div>
            <div class="card-title">
                Task Details
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-condensed" width="100%">
                    <thead>
                    <tr>
                        <th>Task No.</th>
                        <th>Type</th>
                        <th>Submitted On</th>
                        <th>Status</th>
                        <th>Assigned To</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->type }}</td>
                        <td>{{ $task->created_at }}</td>
                        <td>{!! status_label($task) !!}</td>
                        <td>{{ $task->user ? : ' - ' }} </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card card-default card-inner">
        <div class="card-header">
            <div class="card-title">
                Revision History
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-condensed" width="100%">
                    <thead>
                    <tr>
                        <th>Type of Task</th>
                        <th>Date Created</th>
                        <th>Assigned To</th>
                        <th>Processed At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->type }}</td>
                            <td>{{ $task->created_at }}</td>
                            <td>{{ $task->user }}</td>
                            <td>{{ $task->completed_at }}</td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card card-default card-inner">
        <div class="card-header">
            <div class="pull-right">
                <modal
                        title="Add Comment"
                        btn-type="info"
                        btn-title="New Comment"
                        btn-size="sm"
                        btn-icon="fa fa-plus-circle"
                        :show-footer="false"
                        :padded="false">
                    <task-comment-form submit-url="{{ route('admin.tasks.comment', [$task->id]) }}"></task-comment-form>
                </modal>
            </div>
            <div class="card-title">
                Comments
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-condensed" width="100%">
                    <thead>
                    <tr>
                        <th>Comment</th>
                        <th>Comment By</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td>{{ $comment->comment }}</td>
                            <td>{{ $comment->commentator }}</td>
                            <td>{{ $comment->created_at }}</td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop