<?php

namespace App\Repositories;

use App\Models\Lead;
use App\Repositories\Contracts\LeadRepositoryInterface;

class LeadRepository implements LeadRepositoryInterface
{
    public function find($id)
    {
        return Lead::find($id);
    }

    public function all()
    {
        return Lead::all();
    }

    public function create(array $data)
    {
        return Lead::create($data);
    }

    public function update($id, array $data)
    {
        $lead = Lead::find($id);
        if ($lead) {
            $lead->update($data);
            return $lead;
        }
        return null;
    }

    public function delete($id)
    {
        $lead = Lead::find($id);
        if ($lead) {
            $lead->delete();
            return true;
        }
        return false;
    }

    public function findByOwner($ownerId)
    {
        return Lead::where('owner', $ownerId)->get();
    }
}
