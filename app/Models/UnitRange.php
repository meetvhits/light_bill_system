<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitRange extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'unit_ranges';

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'start_range', 'end_range', 'price', 'deleted_at'
    ];
}
