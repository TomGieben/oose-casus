<?php

namespace App\Repositories;

use App\Models\Resource;

class ResourceRepository
{
    public function getResourceById(int $id): Resource
    {
        return Resource::find($id);
    }
}