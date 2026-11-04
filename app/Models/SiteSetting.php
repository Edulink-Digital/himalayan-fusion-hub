<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

/**
 * One editable top-level key of config/hfh.php (for example "home", "menu" or "theme"),
 * saved from the admin panel and applied over the config defaults at boot.
 */
#[Fillable(['key', 'value'])]
class SiteSetting extends Model
{
    /**
     * The config/hfh.php keys the admin panel may change.
     *
     * @var list<string>
     */
    public const EDITABLE_KEYS = [
        'theme', 'name', 'tagline', 'phone', 'phone_href', 'whatsapp', 'email', 'address', 'address_lines',
        'maps_link', 'maps_embed', 'price_range', 'socials', 'hours', 'seo', 'home', 'events_page', 'menu_page',
        'book_page', 'footer', 'features', 'nights', 'menu', 'faq',
    ];

    /**
     * Copy every saved setting over the matching config('hfh.*') default.
     */
    public static function applyToConfig(): void
    {
        foreach (static::query()->whereIn('key', self::EDITABLE_KEYS)->get() as $setting) {
            config(["hfh.{$setting->key}" => $setting->value]);
        }
    }

    /**
     * Save edited content, deriving the link formats the site needs from the plain values.
     *
     * @param  array<string, mixed>  $values
     */
    public static function saveContent(array $values): void
    {
        $values = array_merge($values, static::derivedFrom($values));

        foreach (array_intersect_key($values, array_flip(self::EDITABLE_KEYS)) as $key => $value) {
            static::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }

        static::applyToConfig();
    }

    /**
     * Phone, WhatsApp, address-line and map values computed from the phone number and address.
     *
     * @param  array<string, mixed>  $values
     * @return array<string, mixed>
     */
    public static function derivedFrom(array $values): array
    {
        $derived = [];

        if (filled($values['phone'] ?? null)) {
            $digits = preg_replace('/\D/', '', $values['phone']);
            $international = str_starts_with($digits, '0') ? '61'.substr($digits, 1) : $digits;
            $derived['phone_href'] = '+'.$international;
            $derived['whatsapp'] = $international;
        }

        if (filled($values['address'] ?? null)) {
            $address = $values['address'];
            $split = strrpos($address, ',');
            $derived['address_lines'] = $split === false
                ? [$address, '']
                : [trim(substr($address, 0, $split)), trim(substr($address, $split + 1))];
            $name = $values['name'] ?? config('hfh.name');
            $derived['maps_link'] = 'https://www.google.com/maps/search/?api=1&query='.urlencode($name.' '.$address);
            $derived['maps_embed'] = 'https://www.google.com/maps?q='.urlencode($address).'&output=embed';
        }

        return $derived;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'value' => 'json',
        ];
    }
}
