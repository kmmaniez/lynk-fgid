<?php
namespace App\Enums;

enum LayoutEnum: string {
    
    case LAYOUT_DEFAULT = 'default'; // default
    case LAYOUT_GRID = 'grid'; // grid
    case LAYOUT_LARGE = 'large'; // large

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}