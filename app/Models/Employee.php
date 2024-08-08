<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $table = "employees";

    protected $guarded = [];


    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }


    public function createdByAdmin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class, 'governorate_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function branche()
    {
        return $this->belongsTo(Branch::class, 'branche_id');
    }

    public function jobCategory()
    {
        return $this->belongsTo(jobCategory::class, 'job_category_id');
    }

    public function jobGrade()
    {
        return $this->belongsTo(jobGrade::class, 'job_grade_id');
    }

    public function shiftsType()
    {
        return $this->belongsTo(ShiftsType::class, 'shifts_type_id');
    }
    
}
