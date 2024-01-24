<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrivilageMaster extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = 'privilage_master';

    protected $guarded  = [];

}
