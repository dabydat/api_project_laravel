<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponseHelper;
use App\Http\Requests\Lead\StoreLeadRequest;
use App\Http\Resources\LeadResource;
use App\Repositories\LeadRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LeadController extends Controller
{
    protected $leadRepository;

    public function __construct(LeadRepository $leadRepository)
    {
        $this->leadRepository = $leadRepository;
    }

    public function store(StoreLeadRequest $request)
    {
        $user = auth()->user();
        if ($user->role !== 'manager') {
            return JsonResponseHelper::forbidden('Unauthorized');
        }

        $lead = $this->leadRepository->create([
            'name' => $request->name,
            'source' => $request->source,
            'owner' => $request->owner,
            'created_by' => $user->id,
        ]);

        return JsonResponseHelper::resourceCreated('Lead created', new LeadResource($lead));
    }

    public function show($id)
    {
        $lead = Cache::remember("lead_{$id}", 60, function () use ($id) {
            return $this->leadRepository->find($id);
        });
        if (!$lead) {
            return JsonResponseHelper::notFound('No lead found');
        }
        
        return JsonResponseHelper::success('Lead found', new LeadResource($lead));
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'manager') {
            $leads = $this->leadRepository->all();
        } else {
            $leads = $this->leadRepository->findByOwner($user->id);
        }
        
        return JsonResponseHelper::success('Leads retrieved', LeadResource::collection($leads));
    }
}
