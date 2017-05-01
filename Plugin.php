<?php namespace SGDInstitute\BreakingNews;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'SGDInstitute\BreakingNews\Components\BreakingPost' => 'breakingpost',
        ];
    }

    public function registerSettings()
    {
    }
}
