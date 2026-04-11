<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default role for self-registered users
    |--------------------------------------------------------------------------
    |
    | Must match an existing roles.role_id. Seed at least one role before
    | opening registration, or set DEFAULT_ROLE_ID in your environment.
    |
    */

    'default_role_id' => (int) env('DEFAULT_ROLE_ID', 1),

];
