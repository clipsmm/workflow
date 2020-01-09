<?php

namespace MitaJunior\Workflow\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MitaJunior\Workflow\Http\Requests\ActionFormRequest;
use MitaJunior\Workflow\Http\Requests\StageFormRequest;
use MitaJunior\Workflow\Http\Requests\WorkflowFormRequest;
use MitaJunior\Workflow\Models\Action;
use MitaJunior\Workflow\Models\Stage;
use MitaJunior\Workflow\Models\Workflow;

class ActionController extends Controller {


    public function store(ActionFormRequest $request)
    {
        $item = Action::query()->create($request->validated());

        return response()->json($item);
    }


    public function edit(Action $action)
    {
        $stage = $action->stage;
        $stages = $stage->workflow->stages()->whereNotIn('m_stages.id', [$stage->id])->get();

        return view('workflow::actions.edit', compact('action', 'stages'))
            ->with('page_title', __('workflow::stage.show_page_title'));
    }

    public function update(ActionFormRequest $request, Action $action)
    {
        $action->update($request->validated());

        return response()->json($action);
    }
}