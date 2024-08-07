<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceClnPeriods extends Model
{
    use HasFactory;


    protected $table = "finance_cln_periods";


    public $fillable = [
        'finance_calendars_id',
        'finance_yr',
        'month_id',
        'year_and_month',
        'start_date_month',
        'end_date_month',
        'number_of_days',
        'start_date_fp',
        'end_date_fp',
        'is_open',
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


    public function financeCalendars()
    {
        return $this->belongsTo(FinanceCalendar::class, 'finance_calendars_id');
    }
}
