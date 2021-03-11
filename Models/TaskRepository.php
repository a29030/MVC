<?php

namespace MVC\Models;

use MVC\Models\TaskResourceModel;

class TaskRepository
{
    public $taksResourceModel;

    public function __construct()
    {
        return $this->taksResourceModel = new TaskResourceModel();
    }

    public function add($model)
    {
        return $this->taksResourceModel->save($model);
    }
    
    public function edit($model)
    {
        return $this->taksResourceModel->save($model);
    }

    public function delete($id)
    {
        return $this->taksResourceModel->delete($id);
    }

    public function getAll()
    {
        return $this->taksResourceModel->getList();
    }

    public function getModel($id)
    {
        return $this->taksResourceModel->getModelById($id);
    }
}