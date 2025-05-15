<?php

declare(strict_types=1);

namespace App\Filament\Auth;

use Filament\Http\Responses\Auth\Contracts\LogoutResponse;
use Illuminate\Http\RedirectResponse;

class CustomLogoutResponse implements LogoutResponse
{

    /**
     * @inheritDoc
     */
    public function toResponse($request): RedirectResponse
    {
        return redirect('/');
    }
}
