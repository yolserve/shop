<?php

namespace App\Catalog\Enum;

enum ProductTaxCode: string
{
    case TAX_FREE = 'tax_free';
    case TAXABLE_GOODS = 'taxable_goods';
    case DOWNLOADABLE_PRODUCTS = 'downloadable_products';
}
