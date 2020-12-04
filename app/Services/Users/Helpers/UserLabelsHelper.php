<?php


namespace App\Services\Users\Helpers;

use App\Helpers\UtilsHelper;
use App\Models\User;
use App\Services\Interfaces\LabelsHelperInterface;
class UserLabelsHelper implements LabelsHelperInterface
{
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

    private static function currentStatusLabel($status): string
    {
        $labels = self::statusLabels();
        return $labels[$status] ?? '';
    }

    private static function currentRoleLabel($role): string
    {
        $labels = self::roleLabels();
        return $labels[$role] ?? '';
    }

    /**
     * @param User $user
     * @return array
     */
    public function getLabels($user)
    {
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
        $data = $user->toArray();
        $labels = $this->getLabels($user);

        return array_merge($data, $labels);
    }
}