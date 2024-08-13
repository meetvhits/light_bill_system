<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customers';

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'service_no', 'phone', 'gender', 'address', 'deleted_at'
    ];

    public function lightBills()
    {
        return $this->hasMany(LightBill::class);
    }
}
