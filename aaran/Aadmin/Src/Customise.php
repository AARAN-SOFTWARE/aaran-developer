<?php

namespace Aaran\Aadmin\Src;

class Customise
{
    public static function enabled(string $feature): bool
    {
        return match (config('aadmin.app_code')) {

            config('software.DEVELOPER') => in_array($feature, config('developer.customise', [])),

        };
    }

    #region[Common]
    public static function hasCommon(): bool
    {
        return static::enabled(static::common());
    }

    public static function common(): string
    {
        return 'common';
    }

    #endregion

    #region[Master]
    public static function hasMAster(): bool
    {
        return static::enabled(static::master());
    }

    public static function master(): string
    {
        return 'master';
    }

    #endregion

    #region[Blog]
    public static function hasBlog(): bool
    {
        return static::enabled(static::blog());
    }

    public static function blog(): string
    {
        return 'blog';
    }

    #endregion

    #region[Task Manger]
    public static function hasTaskManager(): bool
    {
        return static::enabled(static::taskManager());
    }

    public static function taskManager(): string
    {
        return 'taskManager';
    }

    #endregion

    #region[Core]
    public static function hasCore(): bool
    {
        return static::enabled(static::core());
    }

    public static function core(): string
    {
        return 'core';
    }
    #endregion

    #region[Project]
    public static function hasProjects(): bool
    {
        return static::enabled(static::projects());
    }

    public static function projects(): string
    {
        return 'projects';
    }
    #endregion

    #region[Contact]
    public static function hasInstallation(): bool
    {
        return static::enabled(static::installations());
    }

    public static function installations(): string
    {
        return 'installation';
    }
    #endregion

}
