<?php

namespace App\Repositories;


abstract class Repository
{
    protected $query;

    /**
     * Constructor
     *
     * Repository constructor.
     * @param null $instance
     */
    public function __construct($instance = null)
    {
        $this->query = $instance->newQuery();
    }

    /**
     * Get all records (objects)
     *
     * @return array
     */
    public function getAll()
    {
        return $this->query->get();
    }

    /**
     * Get object by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->query->find($id);
    }

    /**
     * Create record
     *
     * @param array $input
     * @return mixed
     */
    public function create(array $input)
    {
        return $this->query->create($input);
    }

    /**
     * Update record
     *
     * @param $id
     * @param array $input
     * @return mixed
     */
    public function update($id, array $input)
    {
        return $this->query->find($id)->update($input);
    }

    /**
     * Delete record
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->query->find($id)->delete();
    }
}
