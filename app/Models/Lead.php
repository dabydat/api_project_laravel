<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table = 'leads';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'source', 'owner', 'created_by'];

    public function get_owner()
    {
        return $this->belongsTo(User::class, 'owner', 'id');
    }

    public function get_creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
