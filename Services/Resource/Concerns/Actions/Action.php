<?php

namespace Modules\Base\Services\Resource\Concerns\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Base\Services\Components\Base\Alert;

trait Action
{
    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Inertia\Response|void|null
     */
    public function action(Request $request, $id)
    {
        /*
        * Check if user has role to create a new record
        */
        if ($this->checkRoles('canEdit') && !$this->isAPI($request)) {
            return $this->checkRoles('canEdit');
        }

        /*
         * Check Request validation
         */
        $validator = Validator::make($request->all(), [
            "action" => "required|string",
            "value" => "required"
        ]);

        if (!$validator->fails()) {

            /*
             * Select Record By ID
             */
            $record = $this->model::find($id);

            /*
             * Process Select to be ID
             */
            $record->{$request->get('action')} = $request->get('value');
            $record->save();
            /*
             * Return Redirect Response if request is not API
             */
            return Alert::make(__($this->generateName(true, true) . " Updated Success"))->fire();
        }
    }
}
