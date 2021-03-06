<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Order extends Model
{

    const REFUND_STATUS_PENDING = 'pending';
    const REFUND_STATUS_APPLIED = 'applied';
    const REFUND_STATUS_PROCESSING = 'processing';
    const REFUND_STATUS_SUCCESS = 'suceess';
    const REFUND_STATUS_FAILED = 'failed';

    const SHIP_STATUS_PENDING = 'pending';
    const SHIP_STATUS_DELIVERED = 'delivered';
    const SHIP_STATUS_RECEIVED = 'received';

    const TYPE_NORMAL = 'normal';
    const TYPE_CROWDFUNDING = 'crowdfunding';
    const TYPE_SECKILL = 'seckill';

    const ORDER_STATUS_CANCEL = 'cancel';
    const ORDER_STATUS_FINISH = 'finish';

    /**
     * 退款状态关联
     *
     * @var array
     */
    public static $refundStatusMap = [
        self::REFUND_STATUS_PENDING => '未退款',
        self::REFUND_STATUS_APPLIED => '已申请退款',
        self::REFUND_STATUS_PROCESSING => '退款中',
        self::REFUND_STATUS_SUCCESS => '退款成功',
        self::REFUND_STATUS_FAILED => '退款失败'
    ];

    /**
     * 发货状态关联
     *
     * @var array
     */
    public static $shipStatusMap = [
        self::SHIP_STATUS_PENDING => "未发货",
        self::SHIP_STATUS_DELIVERED => '已发货',
        self::SHIP_STATUS_RECEIVED => '已收货'
    ];

    /**
     * 订单类型关联
     *
     * @var array
     */
    public static $typeMap = [
        self::TYPE_NORMAL => '普通商品订单',
        self::TYPE_CROWDFUNDING => '众筹商品订单',
        self::TYPE_SECKILL => '秒杀商品订单',
    ];

    /**
     * 填充表结构
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'type',
        'no',
        'address',
        'total_amount',
        'product_amount',
        'remark',
        'paid_at',
        'pay_deadline',
        'payment_method',
        'payment_no',
        'refund_status',
        'refund_no',
        'is_closed',
        'reviewed',
        'ship_status',
        'ship_data',
        'ship_info',
        'express',
        'freight',
        'extra',
        'status'
    ];


    protected $casts = [
        'is_closed' => 'boolean',
        'reviewed' => 'boolean',
        'address' => 'json',
        'ship_data' => 'json',
        'extra' => 'json'
    ];

    protected $dates = [
        'paid_at'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->no) {
                $model->no = static::findAvailableNo();
                if (!$model->no) {
                    return false;
                }
            }
        });
    }

    /**
     *
     * 关联用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 关联添加商品
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     *
     * 查找可用的订单编号
     *
     * @return bool|string
     * @throws \Exception
     */
    public static function findAvailableNo()
    {
        // 订单号前缀
        $prefix = date('YmdHis');
        for ($i = 0; $i < 10; $i++) {
            $no = $prefix.str_pad(random_int(0,999999), 6,'0',STR_PAD_LEFT);
            if (!static::query()->where('no',$no)->exists()) {
                return $no;
            }
        }
        \Log::waring('find order no failed');

        return false;
    }

    public static function getAvailableRefundNo()
    {
        do {
            // Uuid类可以用来生成大概率不重复的字符串
            $no = Uuid::uuid4()->getHex();
            // 为了避免重复我们在生成之后在数据库中查询看看是否已经存在相同的退款订单号
        } while (self::query()->where('refund_no', $no)->exists());

        return $no;
    }

    /**
     * 优惠券
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

}
