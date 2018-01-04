<?php

namespace App\Repositories;

use App\Models\Entry;

class Entries extends Repository
{
    /**
     * Entries constructor.
     */
    public function __construct()
    {
        parent::__construct(new Entry());
    }

}