<?php

namespace App\Config;

class Pagination
{
    const SKIP = env('PAGINATION_SKIP', 0);
    const TAKE = env('PAGINATION_TAKE', 10);
}