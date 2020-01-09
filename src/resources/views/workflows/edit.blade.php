@extends(config('workflow.layout_view','workflow::layout'))

@section('content')
    <div class="card">
        <div class="card-header">
            Edit Workflow
        </div>
        <div class="card-body p-0">
            <workflow-form
                    submit-url="{{ route('workflow::workflows.edit', $workflow->id) }}"
                    cancel-url="{{ route('workflow::workflows.index') }}"
                    :current="{{ json_encode($workflow) }}"
                    :types="{{ json_encode($types) }}"></workflow-form>
        </div>
    </div>
@endsection