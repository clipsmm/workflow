@extends('layouts.admin')

@section('page_tools')
    @permission(['pick_tasks'])
    <a href="{{ route('admin.tasks.pick') }}" class="btn btn-danger btn-sm">
        <i class="fa fa-hand-grab-o"></i> Pick Task
    </a>
    @endpermission
@endsection
@section('content')

    <div class="card">

        <div class="card-header bg-light ">

            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link {{menu_current_route('admin.tasks.queue','active')}}" href=" {{ route('admin.tasks.queue') }}">
                        <i class="fa fa-list"></i> <strong>Queued</strong></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{menu_current_route('admin.tasks.inbox','active')}}" href="{{ route('admin.tasks.inbox') }}">
                        <i class="fa fa-envelope"></i> <strong>My Tasks</strong></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{menu_current_route('admin.tasks.complete','active')}}" href="{{ route('admin.tasks.complete') }}">
                        <i class="fa fa-check-square"></i> <strong>Completed</strong></a>
                </li>
                @if(user('admin')->hasRole('Super Administrator'))
                    <li class="nav-item">
                        <a class="nav-link {{menu_current_route('admin.tasks.index','active')}}" href="{{ route('admin.tasks.index') }}">
                            <i class="fa fa-list"></i> <strong>All</strong></a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm table-hover dt-responsive" width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th style="width: 30%">Name</th>
                        <th>Assigned To</th>
                        <th>Date Submitted</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>
                                {{$item->name }}
                                <small class="d-block text-muted">{{ $item->type }}</small>
                            </td>
                            <td>{{$item->user}}</td>
                            <td>{{date('M d, Y', strtotime($item->created_at))}}</td>
                            <td>{!! status_label($item) !!}</td>
                            <td>
                                <a href="{{ route('admin.tasks.show',[$item->id]) }}" class="action-icon"><i class="fa fa-eye"></i>  </a>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7">No records found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {!! $items->render() !!}
            </div>
        </div>
    </div>
@stop
