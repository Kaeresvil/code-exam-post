<?php

namespace App\Repository\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;


abstract class BaseRepository implements BaseRepositoryInterface
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /**
     * Get all records.
     */
    public function all()
    {
        return $this->model->all();
    }

    public function list(array $search = [], array $relations = [], string $sortByColumn = 'created_at', string $sortBy = 'DESC')
    {

        if($relations) {
            $this->model = $this->model->with($relations);
        }

        return $this->model->filter($search)->orderBy($sortByColumn, $sortBy)->paginate(request('limit') ?? 10);
    }

    /**
     * Find a record by its ID.
     */
    public function find(int $id, $with = []): ?Model
    {
       $record = $this->model->with($with)->find($id);
        if ($record) {
            return $record;
        } else{
            $this->notFound();
        }
    }

    /**
     * Create a new record.
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing record.
     */
    public function update(int $id, array $data): Model
    {
        $record = $this->find($id);
        $record->update($data);
        return $record;
    }

    /**
     * Delete a record by its ID.
     */
    public function delete(int $id)
    {
        $model = $this->model->find($id);
        if ($model) {
            $model->delete();
        } else{
            $this->notFound();
        }
    }

        public function restore(int $id)
    {
        $model = $this->model->onlyTrashed()->find($id);
        if ($model) {
            return $model->restore();
        } else{
            $this->notFound();
        }
    }

    public function notFound(){
        throw ValidationException::withMessages([
            'record_not_found' => "Record not found"
        ]);
    }
}