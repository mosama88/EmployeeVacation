<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Governorate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    protected $table = "cities";


    public $fillable = [
        'name',
        'governorate_id',
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


    public function governorate()
    {
        return $this->belongsTo(Governorate::class, 'governorate_id');
    }
    
}
