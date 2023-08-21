<?php

namespace App\Contracts;

interface EmailServiceContract
{
    public function sendEmail($vendor);
}
