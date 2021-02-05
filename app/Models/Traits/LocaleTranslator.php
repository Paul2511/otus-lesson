<?php
namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Util\Exception;
use App\Models\Translate;
use Illuminate\Support\Facades\App;
trait LocaleTranslator
{
    protected static $modelName;

    /**
     * Returns model type by class name
     * @return string
     */
    public function getModelName()
    {
        if (isset(self::$modelName)) {
            return self::$modelName;
        }
        try {
            $class = new \ReflectionClass($this);
            $name = $class->getShortName();
            return self::$modelName = lcfirst($name);
        } catch (\ReflectionException $e) {
            throw new Exception(
                $e->getMessage(),
                (int) $e->getCode(),
                $e
            );
        }
    }

    /**
     * Translate model relation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translates()
    {
        $modelType = $this->getModelName();

        /** @var $this Model */
        return $this->hasMany(Translate::class, 'row_id')->where('type', $modelType);
    }

    /**
     * Returns the value depending on the current locale
     * @param string|null $default
     * @return string
     */
    protected function translateAttribute(?string $default='')
    {
        $locale = App::currentLocale();

        /** @var Translate $translate */
        $translate = $this->translates()->where('locale', $locale)->first();

        if ($translate) {
            return $translate->value;
        }

        return $default;
    }
}