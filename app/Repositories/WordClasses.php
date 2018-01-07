<?php

namespace App\Repositories;

use App\Models\WordClass;

class WordClasses
{
    /**
     * Get all records
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return WordClass::query()->get();
    }

    /**
     * Get all name value
     *
     * @return array
     */
    public function getAllValue()
    {
        return WordClass::query()->pluck('name')->toArray();
    }

    /**
     * Get record by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return WordClass::query()->where('id', $id)->first();
    }
}