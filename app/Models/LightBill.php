<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LightBill extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'light_bills';

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'customer_id', 'supply_type', 'reading_date', 'present_reading', 'past_reading', 'past_amount', 'base_rate', 'total_units', 'govt_duty', 'govt_duty_charge', 'fixed_charge', 'total_amount', 'deleted_at'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
