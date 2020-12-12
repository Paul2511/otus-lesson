<?php


namespace App\Services\Users\Helpers;

use App\Helpers\UtilsHelper;
use App\Models\User;
use App\Models\UserDetail;
use App\Services\Interfaces\LabelsHelperInterface;
class UserDetailLabelsHelper implements LabelsHelperInterface
{

    /**
     * @var UserDetail
     */
    private $model;

    /**
     * @var array
     */
    private static $classifierClientLabels;

    /**
     * @var array
     */
    private static array $classifierSpecLabels;


    public static function classifierClientLabels(): array
    {
        if (isset(self::$classifierClientLabels)) return self::$classifierClientLabels;
        return self::$classifierClientLabels = UtilsHelper::getLangLabels(static::class, ['classifier', 'client']);
    }

    public static function statusLabels(): array
    {
        if (isset(self::$classifierSpecLabels)) return self::$classifierSpecLabels;
        return self::$classifierSpecLabels = UtilsHelper::getLangLabels(static::class, ['classifier', 'spec']);
    }


    /**
     * Возвращает полное ФИО
     */
    public function fio(): string
    {
        $detail = $this->model;
        $lastName = $detail->lastname?$detail->lastname.' ':'';
        $firstName = $detail->firstname?$detail->firstname.' ':'';
        $middleName = $detail->middlename ?? '';
        return trim($lastName . $firstName . $middleName);
    }

    public function displayName(): string
    {
        $detail = $this->model;
        $lastName = $detail->lastname?$detail->lastname.' ':'';
        $firstName = $detail->firstname?$detail->firstname.' ':'';
        $result = trim($lastName . $firstName);

        if (empty($result)) {
            $user = $detail->user;
            $result = ucfirst(UserLabelsHelper::currentRoleLabel($user->role));
        }

        return $result;
    }

    /**
     * Возвращает сокращенное ФИО: Иванов И.И.
     */
    public function shortFio(): string
    {
        $detail = $this->model;
        $firstName = $detail->firstname ? mb_substr($detail->firstname, 0, 1).'.' : null;
        $middleName = $detail->middlename ? mb_substr($detail->middlename, 0, 1).'.' : null;
        $fio = trim(implode(' ', [$detail->lastname, $firstName, $middleName]));
        $fio = preg_replace('~\s+~', ' ', $fio);

        return $fio ? $fio : null;
    }


    public function getLabels(): array
    {
        return [
            'fio'=>$this->fio(),
            'displayName' => $this->displayName(),
            'shortFio' => $this->shortFio()
        ];
    }

    /**
     * @param UserDetail $user
     * @return array
     */
    public function toArray($detail)
    {
        $this->model = $detail;
        $data = $detail->toArray();
        $labels = $this->getLabels();

        return array_merge($data, $labels);
    }
}