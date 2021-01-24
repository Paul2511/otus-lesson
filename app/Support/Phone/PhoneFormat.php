<?php


namespace Support\Phone;


class PhoneFormat
{
    /**
     * Приводит к '7xxxxxxxxxx'
     */
    public static function purifyPhone(?string $phone, ?bool $withCountryCode = true): ?string
    {
        if (!$phone) {
            return null;
        }

        $phone = preg_replace('~\D~', '', $phone);

        if (strlen($phone) == 11)
            $phone = '7' . substr($phone, 1);

        if (strlen($phone) == 10)
            $phone = '7' . $phone;

        if ($withCountryCode)
        {
            return $phone;
        }
        else
        {
            return substr($phone, 1);
        }
    }

    /**
     * Приводит к '+7 (xxx) xxx-xx-xx'
     */
    public static function formatPhone(string $phone, ?array $options = []): string
    {
        $symbols = preg_replace('~\D+~', '', $phone);

        $addPlusBefore800 = \Arr::get($options, 'addPlusBefore800', false);
        $hideEnd = \Arr::get($options, 'hideEnd', false);
        $withCountryCode = \Arr::get($options, 'withCountryCode', true);

        $partMask = \Arr::get($options, 'partMask', "1-3;4-3;7-2;9-2");
        $partMask = explode(';', $partMask);
        foreach ($partMask as $pm) {
            $pm = explode('-', $pm);
            $arrayMask[] = $pm[0];
            $arrayMask[] = $pm[1];
        }

        if (strlen($symbols) == 10)
        {
            $symbols = '7' . $symbols;
        }

        if (strlen($symbols) == 11)
        {
            $parts = [
                substr($symbols, $arrayMask[0], $arrayMask[1]),
                substr($symbols, $arrayMask[2], $arrayMask[3]),
                substr($symbols, $arrayMask[4], $arrayMask[5]),
                $hideEnd ? '**' : substr($symbols, $arrayMask[6], $arrayMask[7]),
            ];

            $number = "({$parts[0]}) {$parts[1]}-{$parts[2]}-{$parts[3]}";

            if ($parts[0] == '800')
            {
                if ($withCountryCode)
                {
                    $number = "8 {$number}";
                    if ($addPlusBefore800)
                    {
                        $number = '<span style="color:transparent">+</span>' . $number;
                    }
                }
                return $number;
            }

            return $withCountryCode ? '+7 '.$number : $number;
        }

        return $phone;
    }
}