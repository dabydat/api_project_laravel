<?php

namespace App\Repositories\Contracts;

interface LeadRepositoryInterface
{
    public function find($id);
    public function all();
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function findByOwner($ownerId);
}
