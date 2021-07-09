<?php

namespace Clipsmm\Workflow\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Clipsmm\Workflow\Http\Requests\WorkflowFormRequest;
use Clipsmm\Workflow\Models\Workflow;

class WorkflowController extends Controller {

    public function index(Request $request)
    {
        $types = Workflow::getTypes();
        $items = Workflow::query()->latest()->paginate(30);

        return view('workflow::workflows.index', compact('items', 'types'))
            ->with('page_title', _("workflow.workflow_page_title"));
    }

    public function create(Request $request)
    {
        return view('workflow::workflows.new', compact('types'))
            ->with('page_title', _("Create new workflow"));
    }

    public function store(WorkflowFormRequest $request)
    {
        $item = Workflow::query()->create($request->validated());

        return response()->json($item);
    }

    public function show(Workflow $workflow)
    {
        $stages = $workflow->stages()->get();

        $types = [];

        return view('workflow::workflows.show', compact('workflow', 'stages', 'types'))
            ->with('page_title', __('workflow::workflows.show_page_title'));
    }

    public function edit(Workflow $workflow)
    {
        $types = Workflow::getTypes();

        return view('workflow::workflows.edit', compact('workflow', 'types'))
            ->with('page_title', __('workflow::workflows.show_page_title'));
    }

    public function update(WorkflowFormRequest $request, Workflow $workflow)
    {
        $workflow->update($request->validated());

        return response()->json($workflow);
    }
}
