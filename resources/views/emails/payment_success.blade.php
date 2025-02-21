@php
$booking = \App\Models\BookTour::find($payment->p_transaction_id);
@endphp
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Thanh toán thành công</title>
    <style>
        /* Remove extra padding by defining custom cell padding */
        .no-padding td {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }

        .custom-padding td {
            padding: 4px 8px;
        }

        /* Ensure vertical alignment is middle */
        .fixed-table th,
        .fixed-table td {
            vertical-align: middle;
        }

        /* Remove top padding for summary section */
        .summary-table {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        .thank-you {
            text-align: center;
            font-size: 16px;
            color: #000;
            font-weight: bold;
            margin-top: 20px;
        }

        .fixed-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            /* Ensures fixed column widths */
        }

        .fixed-table td,
        .fixed-table th {
            border: 1px solid #ddd;
            vertical-align: middle;
            padding: 4px 8px;
            word-wrap: break-word;
        }
    </style>
</head>

<body style="background-color:rgba(166, 168, 169, 0.5); margin: 0; padding: 0;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <!-- Bọc toàn bộ nội dung vào 1 khung -->
                <table width="600" border="0" cellspacing="0" cellpadding="20" style="background-color: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: left;">
                    <tr>
                        <td align="center" style="padding-top: 0 !important; padding-bottom: 0 !important;">
                            <h1 style="color: #8e44ad;">Thanh Toán Thành Công</h1>
                            <p>Giao dịch của bạn với mã: <strong>{{ $payment->p_transaction_code }}</strong> đã được thanh toán thành công.</p>
                            <p><strong>Số tiền:</strong> {{ number_format($payment->p_money, 0, ',', '.') }} VND</p>
                        </td>
                    </tr>

                    @if($booking)
                    <tr class="no-padding">
                        <td>
                            <h2 style="color: #8e44ad;">Thông tin của quý khách</h2>
                            <table width="100%" border="1" cellspacing="0" cellpadding="0" class="fixed-table custom-padding" style="border-collapse: collapse; width: 100%;">
                                <tr>
                                    <td><strong>Tên khách hàng:</strong></td>
                                    <td>{{ $booking->b_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Điện thoại:</strong></td>
                                    <td>{{ $booking->b_phone }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $booking->b_email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Địa chỉ:</strong></td>
                                    <td>{{ $booking->b_address }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class="no-padding">
                        <td>
                            <h2 style="color: #8e44ad;">Thông tin đặt tour</h2>
                            <table width="100%" border="1" cellspacing="0" cellpadding="0" class="fixed-table custom-padding" style="border-collapse: collapse; width: 100%;">
                                <tr>
                                    <td><strong>Mã booking:</strong></td>
                                    <td>{{ $booking->id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Số người lớn:</strong></td>
                                    <td>{{ $booking->b_number_adults }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Số trẻ em (6 - 12 tuổi):</strong></td>
                                    <td>{{ $booking->b_number_children }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Số trẻ em (2 - 6 tuổi):</strong></td>
                                    <td>{{ $booking->b_number_child6 }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Số trẻ em (dưới 2 tuổi):</strong></td>
                                    <td>{{ $booking->b_number_child2 }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Ghi chú:</strong></td>
                                    <td>{{ $booking->b_note }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class="summary-table">
                        <td>
                            <h2 style="color: #8e44ad; margin-top: 0;">Tóm tắt dịch vụ</h2>
                            <table class="fixed-table" style="border-collapse: collapse; width: 100%;">
                                <colgroup>
                                    <col style="width: 70%;">
                                    <col style="width: 30%;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>Tên dịch vụ</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tour {{ $booking->b_tour_id }} - {{ $booking->tour->t_title ?? '---' }}</td>
                                        <td>{{ number_format($booking->b_total_money, 0, ',', '.') }} VND</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tổng cộng</th>
                                        <th>{{ number_format($booking->b_total_money, 0, ',', '.') }} VND</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" class="thank-you">
                            Cám ơn Quý khách đã sử dụng dịch vụ của chúng tôi!
                        </td>
                    </tr>
                    @endif
                </table>
            </td>
        </tr>
    </table>

</body>

</html>