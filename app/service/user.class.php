<?php

class service_user extends components_baseservice{
    
    protected $id;
    protected $marter_table = 'model_user';
    function __construct($id=0) {
        parent::__construct();
        $this->id = $id;
    }

    /**
     * 添加用户
     */
    public function add($items){
        $this->model()->insert($items);
        $lastInserId = $this->model()->lastInsertId();
        if($lastInserId){
            return $lastInserId;
        }else
        {
            return false;
        }
    }
}
