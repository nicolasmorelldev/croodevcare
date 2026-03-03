<?php

namespace App\Enums;

enum SettingType: string
{
    case Text = 'text';
    case Textarea = 'textarea';
    case RichText = 'rich_text';
    case Email = 'email';
    case Phone = 'phone';
    case Url = 'url';
    case Json = 'json';
}
