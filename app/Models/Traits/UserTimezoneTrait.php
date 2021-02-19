<?php


namespace App\Models\Traits;

use App\Models\User;
use DateTimeInterface;
use Illuminate\Support\Carbon;
trait UserTimezoneTrait
{
    /**
     * @param $value
     * @return \Carbon\Carbon|false|Carbon
     */
    protected function asDateTime($value)
    {
        if ($value instanceof \Carbon\Carbon) {
            return $value;
        }

        if (auth()->check()) {
            /** @var User $my */
            $my = auth()->user();
            $timezone = $my->timezone ?? config('app.timezone');
        } else {
            $timezone = config('app.timezone');
        }

        $value = parent::asDateTime($value);

        return $value->setTimezone($timezone);
    }

    public function getFormatCreatedAtAttribute(): string
    {
        return $this->created_at ? $this->asDateTime($this->created_at)->format('d.m.Y H:i') : null;
    }
}