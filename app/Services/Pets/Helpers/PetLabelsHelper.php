<?php


namespace App\Services\Pets\Helpers;

use App\Helpers\UtilsHelper;
use App\Models\Pet;
use App\Services\Interfaces\LabelsHelperInterface;
class PetLabelsHelper implements LabelsHelperInterface
{

    /**
     * @var Pet
     */
    private $model;

    /**
     * @var array
     */
    private static $sexLabels;

    public static function sexLabels(): array
    {
        if (isset(self::$sexLabels)) return self::$sexLabels;
        return self::$sexLabels = UtilsHelper::getLangLabels(Pet::class, 'sex', 'main');
    }

    private static function currentSexLabel($sex): string
    {
        $labels = self::sexLabels();
        return $labels[$sex] ?? '';
    }

    /**
     * @return array
     */
    public function getLabels()
    {
        $pet = $this->model;
        return [
            'sexLabels'=>self::sexLabels(),
            'sexLabel'=>self::currentSexLabel($pet->sex)
        ];
    }

    /**
     * @param Pet $pet
     * @return array
     */
    public function toArray($pet)
    {
        $this->model = $pet;
        $data = $pet->toArray();
        $labels = $this->getLabels();

        return array_merge($data, $labels);
    }
}