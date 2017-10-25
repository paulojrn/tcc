<?php

namespace Kanboard\Plugin\Usecase;

use Kanboard\Core\Plugin\Base;

class Plugin extends Base
{
    public function initialize()
    {
        $this->template->hook->attach('template:task:sidebar:information', 'usecase:task/sidebar');
        $this->template->hook->attach('template:project-header:view-switcher', 'usecase:task/views');  
    }

    public function getPluginName()
    {
        return 'Usecase';
    }

    public function getPluginAuthor()
    {
        return 'Paulo <paulo.xcco@gmail.com>';
    }

    public function getPluginVersion()
    {
        return '';
    }

    public function getPluginDescription()
    {
        return t('Implements use case');
    }

    public function getPluginHomepage()
    {
        return '';
    }

    public function onStartup()
    {
    }
}
