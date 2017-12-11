<?php

namespace App\Http\Requests\Heritage;

use App\Heritage;
use App\Http\Requests\BaseRequest;

class Destroy extends BaseRequest
{
    public function authorize()
    {
        $user = $this->getUser();
        $heritage = Heritage::findOrFail($this->route('heritage'));

        return $user->can('delete', $heritage);
    }
}
