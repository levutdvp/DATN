<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class RevenueExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $revenue;
    protected $revenueToday;
    protected $billToday;
    protected $bill;
    protected $billFalse;
    protected $revenueServiceToday;
    protected $revenueService;
    protected $revenueByDay;

    public function __construct(
        $revenue, $revenueToday, $billToday, $bill, $billFalse,
        $revenueServiceToday, $revenueService, $revenueByDay
    ) {
        $this->revenue = $revenue;
        $this->revenueToday = $revenueToday;
        $this->billToday = $billToday;
        $this->bill = $bill;
        $this->billFalse = $billFalse;
        $this->revenueServiceToday = $revenueServiceToday;
        $this->revenueService = $revenueService;
        $this->revenueByDay = $revenueByDay;
    }

    public function collection()
    {
        $data = [
            ['Danh mục', 'Giá trị'],
            ['Tổng doanh thu', $this->revenue],
            ['Tổng doanh thu hôm nay', $this->revenueToday],
            ['Tổng số đơn mua hôm nay', $this->billToday],
            ['Tất cả đơn mua', $this->bill],
            ['Tổng số đơn mua đã hủy', $this->billFalse],
            ['Tổng số tiền mua dịch vụ hôm nay', $this->revenueServiceToday],
            ['Tống số tiền mua dịch vụ', $this->revenueService],
        ];

        $result = collect($data);

        $result->push(['']); // Tạo một dòng trắng
        $result->push(['Ngày', 'Doanh thu']);

        foreach ($this->revenueByDay as $item) {
            $result->push([$item->revenue_date, $item->revenue_total]);
        }

        return $result;
    }
}
