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

    #region[Entries]
    public static function hasEntries(): bool
    {
        return static::enabled(static::entries());
    }

    public static function entries(): string
    {
        return 'entries';
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

    #region[GST-API]
    public static function hasGstApi(): bool
    {
        return static::enabled(static::gstapi());
    }

    public static function gstapi(): string
    {
        return 'gstapi';
    }
    #endregion

    #region[Transaction]
    public static function hasTransaction(): bool
    {
        return static::enabled(static::transaction());
    }

    public static function transaction(): string
    {
        return 'transaction';
    }
    #endregion

    #region[Demo data]
    public static function hasDemodata(): bool
    {
        return static::enabled(static::demodata());
    }

    public static function demodata(): string
    {
        return 'demodata';
    }
    #endregion


    #region[ExportSales]
    public static function hasExportSales(): bool
    {
        return static::enabled(static::exportsales());
    }

    public static function exportsales(): string
    {
        return 'exportsales';
    }
    #endregion
}
