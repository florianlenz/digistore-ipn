<?php

namespace DigistoreIpn;

final class DigistoreEvents
{
    const EVENT_ON_PAYMENT = 'on_payment';

    const EVENT_ON_REFUND = 'on_refund';

    const EVENT_ON_CHARGEBACK = 'on_chargeback';

    const EVENT_ON_PAYMENT_MISSED = 'on_payment_missed';

    const EVENT_ON_REBILL_CANCELLED = 'on_rebill_cancelled';

    const EVENT_ON_REBILL_RESUMED = 'on_rebill_resumed';

    const EVENT_LAST_PAID_DAY = 'last_paid_day';

    const EVENTS = [
        self::EVENT_ON_PAYMENT,
        self::EVENT_ON_REFUND,
        self::EVENT_ON_CHARGEBACK,
        self::EVENT_ON_PAYMENT_MISSED,
        self::EVENT_ON_REBILL_CANCELLED,
        self::EVENT_ON_REBILL_RESUMED,
        self::EVENT_LAST_PAID_DAY
    ];

}