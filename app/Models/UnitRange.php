<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitRange extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'unit_ranges';

    protected $guarded = ['id'];
}
