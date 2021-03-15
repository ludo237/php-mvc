<?php

namespace Arcadia;

class Auth
{
    public ?Model $model = null;
    
    public function loginFromSession() : Model
    {
        $key = Application::$instance->session->get("user");
        $this->model = Application::$instance->auth->first($key);
        
        return $this->model;
    }
    
    public function login(Model $model) : void
    {
        $this->model = $model;
        Application::$instance->session->set("user", [$model->getKeyName() => $model->getKey()]);
    }
    
    public function logout() : void
    {
        $this->model = null;
        Application::$instance->session->remove("user");
    }
    
}
