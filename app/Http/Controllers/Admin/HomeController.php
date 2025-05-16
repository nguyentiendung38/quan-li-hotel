<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Date;
use App\Models\Article;
use App\Models\User;
use App\Models\BookTour;
use App\Models\Tour;
use App\Models\BookRoom;
use App\Models\Hotel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        view()->share([
            'home_active' => 'active',
        ]);
    }

    public function index(Request $request)
    {
        $user = User::count();
        $article = Article::count();
        $bookTour = BookTour::count();
        $tour = Tour::count();

        $transactionDefault = BookTour::where('b_status', 1)->count();
        $transactionProcess = BookTour::where('b_status', 2)->count();
        $transactionSuccess = BookTour::where('b_status', 3)->count();
        $transactionFinish = BookTour::where('b_status', 4)->count();
        $transactionCancel = BookTour::where('b_status', 5)->count();

        $statusTransaction = [
            ['Tiếp nhận', $transactionSuccess, false],
            ['Đã xác nhận', $transactionProcess, false],
            ['Đã thanh toán', $transactionDefault, false],
            ['Đã kết thúc', $transactionFinish, false],
            ['Huỷ bỏ', $transactionCancel, false]
        ];

        $currentDate = date('Y-m-d');
        $month = $request->select_month ?: date('m');
        $year = $request->select_year ?: date('Y');
        $listDay = Date::getListDayInMonth($month, $year);

        $totalMoneyDay = BookTour::whereDate('created_at', $currentDate)->whereIn('b_status', [3, 4])->sum('b_total_money');
        $totalMoneyMonth = BookTour::whereMonth('created_at', $month)->whereYear('created_at', $year)->whereIn('b_status', [3, 4])->sum('b_total_money');
        $totalMoneyYear = BookTour::whereYear('created_at', $year)->whereIn('b_status', [3, 4])->sum('b_total_money');

        // Doanh thu khách sạn
        $hotelMoneyDay = BookRoom::whereDate('created_at', $currentDate)->whereIn('status', [1, 2])->sum('total_price');
        $hotelMoneyMonth = BookRoom::whereMonth('created_at', $month)->whereYear('created_at', $year)->whereIn('status', [1, 2])->sum('total_price');
        $hotelMoneyYear = BookRoom::whereYear('created_at', $year)->whereIn('status', [1, 2])->sum('total_price');

        $totalMoneyDay += $hotelMoneyDay;
        $totalMoneyMonth += $hotelMoneyMonth;
        $totalMoneyYear += $hotelMoneyYear;

        $revenueTransactionMonth = BookTour::whereMonth('created_at', $month)->whereYear('created_at', $year)
            ->select(DB::raw('sum(b_number_adults) as totalMoney'), DB::raw('DATE(created_at) day'))
            ->groupBy('day')->get()->toArray();

        $revenueTransactionMonthDefault = BookTour::whereMonth('created_at', $month)->whereYear('created_at', $year)
            ->select(DB::raw('(sum(b_number_children)+sum(b_number_child6)+sum(b_number_child2)) as totalMoney'), DB::raw('DATE(created_at) day'))
            ->groupBy('day')->get()->toArray();

        $money = BookTour::where('b_status', 3)->whereMonth('created_at', $month)->whereYear('created_at', $year)
            ->select(DB::raw('(sum(b_price_adults*b_number_adults)+sum(b_price_children*b_number_children)+sum(b_price_child6*b_number_child6)+sum(b_price_child2*b_number_child2)) as totalMoney'), DB::raw('DATE(created_at) day'))
            ->groupBy('day')->get()->toArray();

        $arrmoney = [];
        $arrRevenueTransactionMonth = [];
        $arrRevenueTransactionMonthDefault = [];

        foreach ($listDay as $day) {
            $total = 0;
            foreach ($revenueTransactionMonth as $revenue) {
                if ($revenue['day'] == $day) {
                    $total = $revenue['totalMoney']; break;
                }
            }
            $arrRevenueTransactionMonth[] = (int)$total;

            $total = 0;
            foreach ($revenueTransactionMonthDefault as $revenue) {
                if ($revenue['day'] == $day) {
                    $total = $revenue['totalMoney']; break;
                }
            }
            $arrRevenueTransactionMonthDefault[] = (int)$total;

            $total = 0;
            foreach ($money as $revenue) {
                if ($revenue['day'] == $day) {
                    $total = $revenue['totalMoney']; break;
                }
            }
            $arrmoney[] = (int)$total;
        }

        $tours = Tour::orderByDesc('t_follow')->limit(3)->get();
        $newHotels = Hotel::orderByDesc('created_at')->limit(3)->get();
        $totalRooms = Hotel::sum('h_rooms');
        $bookedRooms = BookRoom::sum('rooms');
        $totalHotels = Hotel::count();

        $viewData = [
            'user' => $user,
            'article' => $article,
            'bookTour' => $bookTour,
            'tour' => $tour,
            'tours' => $tours,
            'newHotels' => $newHotels,
            'totalMoneyDay' => $totalMoneyDay,
            'totalMoneyMonth' => $totalMoneyMonth,
            'totalMoneyYear' => $totalMoneyYear,
            'statusTransaction' => json_encode($statusTransaction),
            'listDay' => json_encode($listDay),
            'arrRevenueTransactionMonth' => json_encode($arrRevenueTransactionMonth),
            'arrRevenueTransactionMonthDefault' => json_encode($arrRevenueTransactionMonthDefault),
            'arrmoney' => json_encode($arrmoney),
            'totalRooms' => $totalRooms,
            'bookedRooms' => $bookedRooms,
            'totalHotels' => $totalHotels,
        ];

        return view('admin.home.index', $viewData);
    }

    public function create() {}
    public function store(Request $request) {}
    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}
