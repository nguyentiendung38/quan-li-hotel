<?php

namespace App\Helpers;

class Date
{
    public static function getListDayInMonth($month = null, $year = null)
    {
        $arrayDay = [];
        // Lấy tất cả các ngày trong tháng
        for ($day = 1; $day <= 31; $day++) {
            $time = mktime(12, 0, 0, $month, $day, $year);
            if (date('m', $time) == $month)
                $arrayDay[] = date('Y-m-d', $time);
        }

        return $arrayDay;
    }

    // Example of another date-related function you could add:
    public static function getDayOfWeek($date)
    {
        $dateTime = \DateTime::createFromFormat('Y-m-d', $date);
        if ($dateTime) {
            return $dateTime->format('l'); // Returns the full name of the day (e.g., Monday, Tuesday)
        }
        return null;
    }

    public static function formatDepartureDates($dates)
    {
        if (empty($dates)) return '';
        
        try {
            if (is_string($dates)) {
                $dates = json_decode($dates);
            }
            
            $grouped = collect($dates)->groupBy(function($date) {
                return date('m/Y', strtotime($date));
            })->map(function($dates) {
                return $dates->map(function($date) {
                    return date('d', strtotime($date));
                })->sort()->join(',');
            });

            return $grouped->map(function($days, $monthYear) use ($grouped) {
                [$month, $year] = explode('/', $monthYear);
                return $days . '/' . $month . ($monthYear === $grouped->keys()->last() ? '/' . $year : '');
            })->join('; ');
            
        } catch (\Exception $e) {
            return '';
        }
    }
}
