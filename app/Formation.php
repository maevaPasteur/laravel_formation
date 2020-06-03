<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function sessions()
    {
        return $this->morphMany('App\Session', 'formation')->lastest();
    }

    /**
     * The categories that belong to the categorie.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    /**
     * @param $j
     * @param $z
     * @param $i
     * @param $monthnb
     * @param $year
     * @param $calendar
     * @return string
     *
     * Return the day class : 'currentday' or 'jourVide' or 'otherDay
     */
    public function day_class($j, $z, $i, $monthnb, $year, $calendar) {
        if($j-$z+1+(($i*7)-7) == date("j") && $monthnb == date("n") && $year == date("Y")) {
            return 'currentday';
        } else {
            if ( $calendar[$i][$j] == "" ) {
                return 'jourVide';
            } else {
                return 'otherDay';
            }
        }
    }

    /**
     * @param $j
     * @param $z
     * @param $i
     * @param $monthnb
     * @param $year
     * @param $calendar
     * @return string
     *
     * Return the day if exist
     */
    public function day_current($j, $z, $i, $monthnb, $year, $calendar) {
        if($j-$z+1+(($i*7)-7) == date("j") && $monthnb == date("n") && $year == date("Y")) {
            return $calendar[$i][$j];
        } else {
            if ( $calendar[$i][$j] == "" ) {
                return '';
            } else {
                return $calendar[$i][$j];
            }
        }
    }

    public function sessions_this_day($sessions, $day_current, $monthnb, $year)
    {
        $session_date = date_create_from_format('j/m/Y', $day_current.'/'.$monthnb.'/'.$year);
        return $sessions->where("start",  "=", $session_date->format('Y-m-d'));
    }

    public function has_session($user_sessions, $session_date) {
        $has_session = false;
        foreach ($user_sessions as $session_active) {
            if($session_active->start == $session_date->format('Y-m-d'))
            {
                $has_session = true;
            }
        }
        return $has_session;
    }
}
