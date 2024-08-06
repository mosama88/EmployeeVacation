<?php

namespace App\Models;

use App\Models\JobGrade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class jobCategory extends Model
{
    use HasFactory;


    protected $table = "job_categories";


    public $fillable = [
        'name',
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
