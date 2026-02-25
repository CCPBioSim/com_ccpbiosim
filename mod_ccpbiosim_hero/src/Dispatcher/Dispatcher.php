<?php
namespace Ccpbiosim\Module\Hero\Site\Dispatcher;

\defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\DispatcherInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;
use My\Module\Hello\Site\Helper\HeroHelper;

class Dispatcher implements DispatcherInterface
{
    public function dispatch()
    {
        $language = Factory::getApplication()->getLanguage();
        $language->load('mod_ccpbiosim_hero', JPATH_BASE . '/modules/mod_ccpbiosim_hero');
        
        $username = HeroHelper::getLoggedonUsername('Guest');

        $data = "Hello {$username}";

        require ModuleHelper::getLayoutPath('mod_ccpbiosim_hero');
    }
}

?>
