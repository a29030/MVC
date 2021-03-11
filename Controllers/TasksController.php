<?php

namespace MVC\Controllers;

use MVC\Core\Controller;
use MVC\Models\TaskModel;
use MVC\Models\TaskRepository;


class TasksController extends Controller
{
    function index()
    {

        $tasks = new TaskRepository();

        $d['tasks'] = $tasks->getAll();
        $this->set($d);
        $this->render("index");
    }

    function create()
    {
        if (isset($_POST["title"]))
        {
            $task = new TaskRepository();
            $tmp = new TaskModel();
            $tmp->setTitle($_POST["title"]);
            $tmp->setDescription($_POST["description"]);
            $tmp->setCreatedAt(date("Y-m-d H:i:s"));
            $tmp->setUpdatedAt(date("Y-m-d H:i:s"));

            if ($task->add($tmp))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }

        $this->render("create");
    }

    function edit($id)
    {
        $task= new TaskRepository();

        $d["task"] = $task->getModel($id);
        if (isset($_POST["title"]))
        {
            $tmp = new TaskModel();
            $tmp->setId($id);
            $tmp->setTitle($_POST["title"]);
            $tmp->setDescription($_POST["description"]);
            $tmp->setCreatedAt($d["task"]["created_at"]);
            $tmp->setUpdatedAt(date("Y-m-d H:i:s"));
            if ($task->edit($tmp))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    function delete($id)
    {
        $task = new TaskRepository();
        if ($task->delete($id))
        {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}