<?php

namespace App\Http\Requests\StoryAsset;

use App\Patient;
use App\Http\Requests\BaseRequest;

class Store extends BaseRequest
{
    public function authorize()
    {
        $user = $this->getUser();
        $patient = Patient::findOrFail($this->route('patient'));
        return $user->can('view', $patient);
    }
}
