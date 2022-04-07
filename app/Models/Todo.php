<?php

namespace App\Models;

use Attribute;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    public function getCreatedAtAttribute($date)
    {
        $timezone_name = timezone_name_from_abbr("",      request()->session()->get('current_time_zone') * 60, false);
        $dt = new DateTime($date, new DateTimeZone('UTC'));
        $dt->setTimezone(new DateTimeZone($timezone_name));
        // return $dt->format('Y-m-d H:i:s T');
        return $dt->format('g:ia \o\n l jS F Y');
    }
}
