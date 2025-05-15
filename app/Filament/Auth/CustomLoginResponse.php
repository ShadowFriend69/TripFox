<?php

declare(strict_types=1);

namespace App\Filament\Auth;

use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Routing\Redirector;

class CustomLoginResponse implements LoginResponse
{

    /**
     * @inheritDoc
     */
    public function toResponse($request): Redirector
    {
        return redirect('/');
    }
}
