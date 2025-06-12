<?php
namespace App\Catalog\Enum;


enum AttributeType: string
{
    case STRING = 'string';
    case NUMBER = 'number';
    case SELECT = 'select';
    case MULTISELECT = 'multiselect';
    case DATE = 'date';
    case BOOLEAN = 'boolean';

}