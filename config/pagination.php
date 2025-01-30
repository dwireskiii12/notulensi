<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Pagination Values
    |--------------------------------------------------------------------------
    |
    | This option controls the default number of items that should be shown
    | per page when using the pagination methods. Of course, you may
    | change these values as needed, and they will be honored.
    |
    */

    'default' => env('PAGINATION_DEFAULT', 15),

    /*
    |--------------------------------------------------------------------------
    | Maximum Pagination Values
    |--------------------------------------------------------------------------
    |
    | This option controls the maximum number of items that may be returned
    | via pagination. This limit is only used when the "simple" methods
    | are used for pagination and when the API consumers request it.
    |
    */

    'max' => env('PAGINATION_MAX', 50),

];
