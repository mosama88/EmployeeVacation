<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Holiday extends Model
{
    use HasFactory;

    protected $table = "holidays";


    public $fillable = [
        'name',
        'from',
        'to',
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
