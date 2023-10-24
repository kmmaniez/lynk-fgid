<?php
namespace App\Enums;

enum CtaEnum: string {

    case CTA_NO_OPTION = 'I Want this'; // I Want this 
    case CTA_OPTION_1 = 'Support Creator'; // Support Creator 
    case CTA_OPTION_2 = 'Beli Sekarang'; // Beli Sekarang
    case CTA_OPTION_3 = 'Book Now'; // Book Now

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}