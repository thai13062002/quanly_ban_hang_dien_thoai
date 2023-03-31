<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TypeImgEnum extends Enum
{
    const PRODUCT_IMG = 'App\Models\Product';
    const PRODUCTDETAIL_IMG =   'App\Models\ProductDetail';
    const COLORPRODUCTDETAIL_IMG =  'App\Models\ColorProductDetail';
    const BRAND_IMG =  'App\Models\Brand';
    const BANNER_IMG =  'App\Models\Banner';
}
