<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'value', 'friendly_name', 'description', 'validation'];

    /**
     * Fetches site_name
     * @return string
     */
    public static function site_name(): string
    {
        return self::where('name', 'title')->get('value')->first()->value;
    }

    /**
     * Fetches mail_from_address
     * @return string
     */
    public static function mail_from_address(): string
    {
        return self::where('name', 'mail_from_address')->get('value')->first()->value;
    }

    /**
     * Fetches list of prohibited email providers
     * @return array
     */
    public static function prohibited_email_providers(): array
    {
        $prohibited_email_providers = self::where('name', 'prohibited_email_providers')->get('value')->first()->value;
        $prohibited_email_providers = str_replace("\r\n", '\n', $prohibited_email_providers);
        return explode('\n', $prohibited_email_providers);
    }
}
