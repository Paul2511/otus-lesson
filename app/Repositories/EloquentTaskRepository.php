<?php 
namespace App\Repositories;

use App\Models\Task;

class EloquentTaskRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    public function __construct(){
        $this->model = new Task();
    }
    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // update record in the database
    public function update(array $data, int $id)
    {
        $record = $this->model->find($id);
        return $record->update($data);
    }
    //update several records
    public function updateSeveral(array $data, array $id){
        $records = $this->model->find($id);
        foreach($records as $theRecord){
            $theRecord->update($data);
        }
        return $records;
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }
}