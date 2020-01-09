@extends(config('workflow.layout_view','workflow::layout'))

@section('content')
    <div class="card">
        <div class="card-header">
            Edit Action
        </div>
        <div class="card-body p-0">
            <action-form
                    submit-url="{{ route('workflow::actions.edit', $action->id) }}"
                    cancel-url="{{ route('workflow::stages.show', $action->stage_id) }}"
                    :current="{{ json_encode($action) }}"
                    :stages="{{ json_encode($stages) }}"></action-form>
        </div>
    </div>
@endsection