<?php

namespace MitaJunior\Workflow\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MitaJunior\Workflow\Http\Requests\StageFormRequest;
use MitaJunior\Workflow\Http\Requests\WorkflowFormRequest;
use MitaJunior\Workflow\Models\Stage;
use MitaJunior\Workflow\Models\Workflow;

class StageController extends Controller {



    public function create(Request $request)
    {
        return view('workflow::workflows.new', compact('types'))
            ->with('page_title', _("Create new workflow"));
    }

    public function store(StageFormRequest $request)
    {
        $item = Stage::query()->create($request->validated());

        return response()->json($item);
    }

    public function show(Stage $stage)
    {
        $stages = $stage->workflow->stages()->whereNotIn('m_stages.id', [$stage->id])->get();

        $actions = $stage->actions()->get();

        return view('workflow::stages.actions', compact('stage', 'actions','stages'))
            ->with('page_title', __('workflow::workflows.show_page_title'));
    }

    public function edit(Stage $stage)
    {
        return view('workflow::stages.edit', compact('stage'))
            ->with('page_title', __('workflow::stage.show_page_title'));
    }

    public function update(WorkflowFormRequest $request, Workflow $workflow)
    {
        $workflow->update($request->validated());

        return response()->json($workflow);
    }
}