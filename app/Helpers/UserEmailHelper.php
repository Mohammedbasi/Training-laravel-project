<?php


     function sentWelcomeMessage($user)
    {
        dispatch(new \App\Jobs\SendWelcomeEmail($user))->onQueue('emails');
    }
