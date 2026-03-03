<?php

namespace App\Enums;

enum DonationStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Failed = 'failed';
    case Refunded = 'refunded';
}
