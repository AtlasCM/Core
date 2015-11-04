<?php namespace Atlas\Routing;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs;
    
    use ValidatesRequests {
        buildFailedValidationResponse as traitBuildFailedValidationResponse;
    }
    
    protected function throwValidationException(Request $request, $validator)
    {
        throw new HttpResponseException($this->buildFailedValidationResponse(
            $request, $validator, $this->formatValidationErrors($validator)
        ));
    }
    
    protected function buildFailedValidationResponse(Request $request, $validator, array $errors)
    {
        return $this->traitBuildFailedValidationResponse($request, $errors)->with('failed', $validator->failed());
    }
}
