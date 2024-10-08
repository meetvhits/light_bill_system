<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillCharge extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bill_charges';

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'govt_duty_percentage', 'fixed_charge', 'deleted_at'
    ];
}
