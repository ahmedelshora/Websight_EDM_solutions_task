<?php

namespace App\Repositories;

use App\Contracts\Models\MainModelInterface;
use App\Contracts\Repositories\MainRepositoryInterface;

abstract class MainRepository implements MainRepositoryInterface
{

    protected MainModelInterface $model;


    /**
     * @return int
     */
    public function getPrimaryKey():int
    {
        return $this->getModel()->id ?? 0;
    }

    public function getModel(): MainModelInterface
    {
        return $this->model;
    }

    public function setModel(MainModelInterface $model = null): void
    {
        if ($model == null){
//            $model =
        }

        $this->model = $model;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        $model = $this->getModel()->create($data);
        if (!empty($model)){
            $this->setModel($model);
        }
        return $model;
    }

    /**
     * @return mixed
     */
    public function getList(): mixed
    {
        return $this->getModel()->get();
    }

    /**
     * @param $id
     * @return self
     */
    public function getDetailsById($id): self
    {
        $model = $this->getModel()->findOrFail($id);
        $this->setModel($model);
        return $this;
    }
}
