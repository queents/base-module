<?php

namespace Modules\Base\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Base\Services\Components\Base\Alert;
use Modules\Base\Services\Components\Base\Render;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Index');
    }

    public function logout()
    {
        auth('web')->logout();
        return redirect()->route('login');
    }

    public function getMedia(){
        $media = Media::all()->groupBy('model_type');
        $mediaCollection = [];
        foreach ($media as $key=>$value){
            $getKey = collect(explode("\\",$key))->last();
            $mediaCollection[$getKey] = $value->toArray();
        }

        return response()->json([
            "data" =>$mediaCollection
        ]);
    }

    public function destroy(Media $media){
        $media->delete();

        return Alert::make(__('Your Media Item Has Been deleted'))->fire();
    }

    public function select(Request $request){
        $request->validate([
           "model_type" => "required",
           "model_id" => "sometimes",
            "query" => "sometimes|boolean",
            "key" => "sometimes|string",
            "value" => "sometimes"
        ]);

        if($request->has('model_id')){
            $records = $request->get('model_type')::find($request->get('model_id'));
        }
        else if($request->has('query') && $request->has('query') == true){
            $records = $request->get('model_type')::where($request->get('key'), 'LIKE', '%' .$request->get('value').'%')->paginate(10);
        }
        else {
            $records = $request->get('model_type')::orderBy('id', 'desc')->paginate(10);
        }

        if($records){
            return response()->json([
                "success" => true,
                "message" => "Record loaded success",
                "data" => $records
            ]);
        }
        else {
            return response()->json([
                "success" => false,
                "message" => "Record not found"
            ], 404);
        }
    }

    public  function create(Request $request){
        $request->validate([
           "model" => "required"
        ]);

        $model = $request->get('model');
        $model::create($request->all());

        return Alert::make(__('Your Record Has Been Added'))->fire();
    }
}
