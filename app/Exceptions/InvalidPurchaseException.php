<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class InvalidPurchaseException extends Exception
{
    public function render(Request $request)
    {
        return redirect()
            ->route('dashboard')
            ->withInput()
            ->withErrors([
                'message' => $this->getMessage(),
            ])
            ->with('info', $this->getMessage());
    }
}
