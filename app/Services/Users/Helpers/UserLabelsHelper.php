<?php


namespace App\Services\Users\Helpers;

use App\Helpers\UtilsHelper;
use App\Models\User;
use App\Services\Interfaces\LabelsHelperInterface;
class UserLabelsHelper implements LabelsHelperInterface
{
    /**
     * @var User
     */
    private $model;

    /**
     * @var array
     */
    private static $roleLabels;

    /**
     * @var
     */
    private static $statusLabels;


    private static array $statusColors = [
        User::STATUS_ACTIVE => 'success',
        User::STATUS_NOT_ACTIVE => 'danger'
    ];

    public static function roleLabels(): array
    {
        if (isset(self::$roleLabels)) return self::$roleLabels;
        return self::$roleLabels = UtilsHelper::getLangLabels(User::class, 'role');
    }

    public static function statusLabels(): array
    {
        if (isset(self::$statusLabels)) return self::$statusLabels;
        return self::$statusLabels = UtilsHelper::getLangLabels(User::class, 'status');
    }

    public static function currentStatusLabel($status): string
    {
        $labels = self::statusLabels();
        return $labels[$status] ?? '';
    }

    public static function currentRoleLabel($role): string
    {
        $labels = self::roleLabels();
        return $labels[$role] ?? '';
    }

    /**
     * @return array
     */
    public function getLabels()
    {
        $user = $this->model;
        return [
            'roleLabel'=>self::currentRoleLabel($user->role),
            'statusLabels'=>self::statusLabels(),
            'statusColor'=>self::$statusColors[$user->status] ?? '',
            'statusLabel'=>self::currentStatusLabel($user->status)
        ];
    }

    /**
     * @param User $user
     * @return array
     */
    public function toArray($user)
    {
        $this->model = $user;
        $data = $user->toArray();
        $labels = $this->getLabels();

        return array_merge($data, $labels);
    }
}