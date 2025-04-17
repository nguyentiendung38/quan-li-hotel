<?php

namespace App\Helpers;

use Carbon\Carbon;

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
        
        // Kiểm tra nếu $dates đã là array thì không cần decode
        $datesArray = is_array($dates) ? $dates : json_decode($dates, true);
        if (!is_array($datesArray)) return '';
        
        sort($datesArray);
        
        // Group dates by month and year
        $grouped = [];
        foreach ($datesArray as $date) {
            $carbon = Carbon::parse($date);
            $month = $carbon->format('m');
            $year = $carbon->format('Y');
            $day = $carbon->format('d');
            $grouped[$month][] = ['day' => $day, 'year' => $year];
        }
        
        // Format output
        $result = [];
        $lastMonth = array_key_last($grouped);
        
        foreach ($grouped as $month => $dates) {
            $days = collect($dates)->pluck('day')->implode(',');
            if ($month === $lastMonth) {
                $result[] = $days . '/' . $month . '/' . $dates[0]['year'];
            } else {
                $result[] = $days . '/' . $month;
            }
        }
        
        return implode('; ', $result);
    }

    public static function getAvailableDates($dates)
    {
        if (empty($dates)) {
            return [];
        }
        
        // Kiểm tra kiểu dữ liệu và xử lý tương ứng
        $datesArray = is_array($dates) ? $dates : json_decode($dates, true);
        
        if (!is_array($datesArray)) {
            return [];
        }

        // Filter và format dates
        $validDates = array_filter($datesArray, function($date) {
            return !empty($date) && strtotime($date);
        });

        sort($validDates);
        return array_values($validDates);
    }
}
