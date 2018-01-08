<?php

namespace App\Repositories;

use App\Models\DefinitionExample;

class DefinitionExamples
{
    /**
     * Get all records
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return DefinitionExample::query()->get();
    }

    /**
     * Get record by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return DefinitionExample::query()->where('id', $id)->first();
    }

    /**
     * Insert a new record
     *
     * @param array $input
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $input)
    {
        return DefinitionExample::query()->create($input);
    }

    /**
     * Update record by id
     *
     * @param $id
     * @param array $input
     * @return bool|int
     */
    public function update($id, array $input)
    {
        return DefinitionExample::query()->find($id)->update($input);
    }

    /**
     * Delete record by id
     *
     * @param $id
     * @return bool|mixed|null
     */
    public function delete($id)
    {
        DefinitionExample::query()->destroy($id);
    }
}