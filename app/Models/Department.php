<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $table = "departments";


    public $fillable = [
        'name',
        'branch_id',
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


    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
