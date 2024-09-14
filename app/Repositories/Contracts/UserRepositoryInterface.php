<?php
namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function find($id);
    public function all();
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}