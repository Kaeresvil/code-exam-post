<?php

namespace App\Repository\Base;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * Get all records.
     */
    public function all();

    //Get records with pagination

    public function list();

    /**
     * Find a record by its ID.
     */
    public function find(int $id): ?Model;

    /**
     * Create a new record.
     */
    public function create(array $data): Model;

    /**
     * Update an existing record.
     */
    public function update(int $id, array $data): Model;

    /**
     * Delete a record by its ID.
     */
    public function delete(int $id);
    
    /**
     * Delete a record by its ID.
     */
    public function restore(int $id);
}

