<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftsType extends Model
{
    use HasFactory;


    protected $table = "shifts_types";


    public $fillable = [
        'type',
        'from_time',
        'to_time',
        'total_hours',
        'status',
        'created_by',
        'updated_by',
    ];


    public function createdByAdmin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
}
