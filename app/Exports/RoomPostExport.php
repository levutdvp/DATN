<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class RoomPostExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $roomPost;
    protected $roomPostToday;
    protected $roomPostAccept;
    protected $roomPostAcceptToday;
    protected $roomPostPending;
    protected $roomPostPendingToday;
    protected $roomPostVIP;
    protected $roomPostDefault;
    protected $totalRoomPost;

    public function __construct(
        $roomPost, $roomPostToday, $roomPostAccept, $roomPostAcceptToday, $roomPostPending,
        $roomPostPendingToday, $roomPostVIP, $roomPostDefault, $totalRoomPost
    ) {
        $this->roomPost = $roomPost;
        $this->roomPostToday = $roomPostToday;
        $this->roomPostAccept = $roomPostAccept;
        $this->roomPostAcceptToday = $roomPostAcceptToday;
        $this->roomPostPending = $roomPostPending;
        $this->roomPostPendingToday = $roomPostPendingToday;
        $this->roomPostVIP = $roomPostVIP;
        $this->roomPostDefault = $roomPostDefault;
        $this->totalRoomPost = $totalRoomPost;
    }

    public function collection()
    {
        $data = [
            ['Danh mục', 'Giá trị'],
            ['Tổng số tin đăng', $this->roomPost],
            ['Tổng số tin đăng hôm nay', $this->roomPostToday],
            ['Tổng số tin đăng đã xác nhận', $this->roomPostAccept],
            ['Tổng số tin đăng đã xác nhận hôm nay', $this->roomPostAcceptToday],
            ['Tổng số tin đăng chờ xác nhận', $this->roomPostPending],
            ['Tổng số tin đăng chờ xác nhận hôm nay', $this->roomPostPendingToday],
            ['Tổng số tin vip', $this->roomPostVIP],
            ['Tổng số tin thường', $this->roomPostDefault],
        ];

        $result = collect($data);

        $result->push(['']); // Tạo một dòng trắng
        $result->push(['Ngày', 'Tổng số tin đăng']);

        foreach ($this->totalRoomPost as $item) {
            $result->push([$item->date, $item->total_posts]);
        }

        return $result;
    }
}
