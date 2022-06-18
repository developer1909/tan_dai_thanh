<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    const STT_PENDING = 0;
    const STT_BEING_TRANSPORTED = 1;
    const STT_COMPLETE = 2;
    const STT_CANCEL = 3;
    const STATUS_ALL = [
        self::STT_PENDING => ['status_name' => 'Lên đơn', 'key' => self::STT_PENDING, 'color' => '#ffb22b'],
        self::STT_BEING_TRANSPORTED => ['status_name' => 'Đang vận chuyển', 'key' => self::STT_BEING_TRANSPORTED, 'color' => '#3199cc'],
        self::STT_COMPLETE => ['status_name' => 'Hoàn thành', 'key' => self::STT_COMPLETE, 'color' => '#3199cc'],
        self::STT_CANCEL => ['status_name' => 'Hủy', 'key' => self::STT_CANCEL, 'color' => '#607d8b'],
    ];

    const TYPE_PAID = 1;
    const TYPE_UNPAID= 2;
    const TYPE_REFUND = 3;
    const PAYMENT_STATUS = [

        self::TYPE_UNPAID => ['status_name' => 'Chưa thanh toán', 'key' => self::TYPE_UNPAID, 'color' => '#ff203f'],
        self::TYPE_PAID => ['status_name' => 'Đã thanh toán', 'key' => self::TYPE_PAID, 'color' => '#4caf50'],
        self::TYPE_REFUND => ['status_name' => 'Nợ', 'key' => self::TYPE_REFUND, 'color' => '#607d8b'],
    ];
    protected $table = 'orders';
    protected $fillable = [
        'recipient_name',
        'recipient_phone',
        'recipient_address',
        'total_price',
        'discount',
        'paid_price',
        'debt',
        'order_status',
        'payment_status',
        'order_code',
    ];


}
