@extends(config('workflow.layout_view','workflow::layout'))

@section('content')
    <div class="card">
        <div class="card-header">
            Edit Stage
        </div>
        <div class="card-body p-0">
            <stage-form
                    submit-url="{{ route('workflow::stages.edit', $stage->id) }}"
                    cancel-url="{{ route('workflow::workflows.show', $stage->workflow_id) }}"
                    :current="{{ json_encode($stage) }}"
                    :stages="[]"
                    :roles="[]"></stage-form>
        </div>
    </div>
@endsection