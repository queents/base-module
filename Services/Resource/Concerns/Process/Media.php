<?php

namespace Modules\Base\Services\Resource\Concerns\Process;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait Media
{
    public function processMediaOnCreate(Request $request, $record): void
    {
        foreach ($this->rows() as $field) {
            if($field->vue === 'ViltMedia.vue') {
                if($field->type === 'lib' && is_string($request->{$field->name})){
                    if($request->{$field->name}){
                       $record->addMediaFromUrl($request->{$field->name})
                            ->preservingOriginal()
                            ->toMediaCollection($field->name);
                    }
                }
                else {
                    if ($request->{$field->name} && is_array($request->{$field->name})) {
                        foreach ($request->{$field->name} as $item) {
                            $record->addMedia($item)
                                ->preservingOriginal()
                                ->toMediaCollection($field->name);
                        }
                    }
                }
            }
        }
    }

    public function processMediaOnUpdate(Request $request, $record): void
    {
        foreach ($this->rows() as $field) {
            if (($field->vue === 'ViltMedia.vue')) {
                if($field->type === 'lib' && is_string($request->{$field->name})){
                    if($request->{$field->name}){
                        if(!$record->getMedia($field->name)->first() || $record->getMedia($field->name)->first()->getUrl() !== $request->{$field->name}){
                            $record->clearMediaCollection($field->name);
                            $record->addMediaFromUrl($request->{$field->name})
                                ->preservingOriginal()
                                ->toMediaCollection($field->name);
                        }
                    }
                }
                else {
                    if ($request->{$field->name} && is_array($request->{$field->name})) {
                        $record->clearMediaCollection($field->name);
                        foreach ($request->{$field->name} as $key=>$item) {
                            if(!is_string($item)){
                                if($item->getClientOriginalName() === 'blob'){
                                    $record->addMedia($item)
                                        ->usingFileName(strtolower(Str::random(10).'_'.$key.'.'.$item->extension()))
                                        ->preservingOriginal()
                                        ->toMediaCollection($field->name);
                                }
                                else {
                                    $record->addMedia($item)
                                        ->preservingOriginal()
                                        ->toMediaCollection($field->name);
                                }
                            }
                        }
                    }
                    else if(empty($request->get($field->name))){
                        $record->clearMediaCollection($field->name);
                    }
                }

            }
        }
    }
}
