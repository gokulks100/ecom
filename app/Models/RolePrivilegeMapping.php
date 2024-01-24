<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePrivilegeMapping extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'role_privilege_mapping';

    protected $guarded = [];
}
