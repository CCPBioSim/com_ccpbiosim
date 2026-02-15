<?php
/**
 * @package    com_ccpbiosim
 * @copyright  2025 CCPBioSim Team
 * @license    MIT
 */

// No direct access
defined('_JEXEC') or die;

use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Uri\Uri;
use \Joomla\CMS\Router\Route;
use \Joomla\CMS\Language\Text;
use \Joomla\CMS\Layout\LayoutHelper;
use \Joomla\CMS\Session\Session;
use \Joomla\CMS\User\UserFactoryInterface;

HTMLHelper::_('bootstrap.tooltip');
HTMLHelper::_('behavior.multiselect');

$user       = Factory::getApplication()->getIdentity();
$userId     = $user->get('id');
$listOrder  = $this->state->get('list.ordering');
$listDirn   = $this->state->get('list.direction');
$canCreate  = $user->authorise('core.create', 'com_ccpbiosim') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'eventform.xml');
$canEdit    = $user->authorise('core.edit', 'com_ccpbiosim') && file_exists(JPATH_COMPONENT .  DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'eventform.xml');
$canCheckin = $user->authorise('core.manage', 'com_ccpbiosim');
$canChange  = $user->authorise('core.edit.state', 'com_ccpbiosim');
$canDelete  = $user->authorise('core.delete', 'com_ccpbiosim');

// Import CSS & JS
$wa = $this->document->getWebAssetManager();
$wa->useStyle('com_ccpbiosim.site')
   ->useScript('com_ccpbiosim.site');
?>

<?php if ($this->params->get('show_page_heading')) : ?>
    <div class="page-header">
        <h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
    </div>
<?php endif;?>
<p>Below are upcoming events relevant to our community.</p>
<?php if ($canCreate) : ?>
  <a href="<?php echo Route::_('index.php?option=com_ccpbiosim&task=eventform.edit&id=0', false, 0); ?>"
     class="btn btn-success btn-small"><i
     class="icon-plus"></i>
     <?php echo Text::_('COM_CCPBIOSIM_ADD_ITEM'); ?></a>
<?php endif; ?>
<!-- Main Content -->
<div class="container my-5">
  <div class="accordion" id="eventsAccordion">
    <!-- Conferences -->
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#conferences">
          Conferences
        </button>
      </h2>
      <div id="conferences" class="accordion-collapse collapse show">
        <div class="accordion-body p-0">
          <?php foreach ($this->items as $i => $item) : ?>
            <?php if ($item->category == "Conferences" && Factory::getDate($item->enddatetime > Factory::getDate()): ?>
              <ul class="list-group list-group-flush">
                <a href="<?php echo Route::_('index.php?option=com_ccpbiosim&view=event&id='.(int) $item->id); ?>"
                   class="list-group-item list-group-item-action d-flex align-items-start gap-3">
                  <div class="events-date bg-success text-white">
                    <div class="month"><?php echo Factory::getDate($item->startdatetime)->format("M"); ?></div>
                    <div class="day">
                      <?php if (Factory::getDate($item->startdatetime)->__get("day") == Factory::getDate($item->enddatetime)->__get("day")): ?>
                        <?php echo Factory::getDate($item->startdatetime)->__get("day"); ?>
                      <?php else: ?>
                        <?php echo Factory::getDate($item->startdatetime)->__get("day"); ?>-<?php echo Factory::getDate($item->enddatetime)->__get("day"); ?>
                      <?php endif; ?>
                    </div>
                    <div class="year"><?php echo Factory::getDate($item->startdatetime)->__get("year"); ?></div>
                  </div>
                  <div>
                    <h6 class="mb-1"><?php echo $this->escape($item->title); ?></h6>
                    <small class="text-muted"><?php echo $this->escape($item->location); ?></small>
                    <p class="mb-1"><?php echo $this->escape($item->shortdesc); ?></p>
                  </div>
                </a>
              </ul>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <!-- Webinars -->
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#webinars">
          Webinars
        </button>
      </h2>
      <div id="webinars" class="accordion-collapse collapse">
        <div class="accordion-body p-0">
          <?php foreach ($this->items as $i => $item) : ?>
            <?php if ($item->category == "Webinars" && Factory::getDate($item->enddatetime) > Factory::getDate()): ?>
              <ul class="list-group list-group-flush">
                <a href="<?php echo Route::_('index.php?option=com_ccpbiosim&view=event&id='.(int) $item->id); ?>"
                   class="list-group-item list-group-item-action d-flex align-items-start gap-3">
                  <div class="events-date bg-primary text-white">
                    <div class="month"><?php echo Factory::getDate($item->startdatetime)->format("M"); ?></div>
                    <div class="day">
                      <?php if (Factory::getDate($item->startdatetime)->__get("day") == Factory::getDate($item->enddatetime)->__get("day")): ?>
                        <?php echo Factory::getDate($item->startdatetime)->__get("day"); ?>
                      <?php else: ?>
                        <?php echo Factory::getDate($item->startdatetime)->__get("day"); ?>-<?php echo Factory::getDate($item->enddatetime)->__get("day"); ?>
                      <?php endif; ?>
                    </div>
                    <div class="year"><?php echo Factory::getDate($item->startdatetime)->__get("year"); ?></div>
                  </div>
                  <div>
                    <h6 class="mb-1"><?php echo $this->escape($item->title); ?></h6>
                    <small class="text-muted"><?php echo $this->escape($item->location); ?></small>
                    <p class="mb-1"><?php echo $this->escape($item->shortdesc); ?></p>
                  </div>
                </a>
              </ul>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <!-- Workshops -->
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#workshops">
          Workshops
        </button>
      </h2>
      <div id="workshops" class="accordion-collapse collapse">
        <div class="accordion-body p-0">
          <?php foreach ($this->items as $i => $item) : ?>
            <?php if ($item->category == "Training Workshops" && Factory::getDate($item->enddatetime > Factory::getDate()): ?>
              <ul class="list-group list-group-flush">
                <a href="<?php echo Route::_('index.php?option=com_ccpbiosim&view=event&id='.(int) $item->id); ?>"
                   class="list-group-item list-group-item-action d-flex align-items-start gap-3">
                  <div class="events-date bg-warning text-white">
                    <div class="month"><?php echo Factory::getDate($item->startdatetime)->format("M"); ?></div>
                    <div class="day">
                      <?php if (Factory::getDate($item->startdatetime)->__get("day") == Factory::getDate($item->enddatetime)->__get("day")): ?>
                        <?php echo Factory::getDate($item->startdatetime)->__get("day"); ?>
                      <?php else: ?>
                        <?php echo Factory::getDate($item->startdatetime)->__get("day"); ?>-<?php echo Factory::getDate($item->enddatetime)->__get("day"); ?>
                      <?php endif; ?>
                    </div>
                    <div class="year"><?php echo Factory::getDate($item->startdatetime)->__get("year"); ?></div>
                  </div>
                  <div>
                    <h6 class="mb-1"><?php echo $this->escape($item->title); ?></h6>
                    <small class="text-muted"><?php echo $this->escape($item->location); ?></small>
                    <p class="mb-1"><?php echo $this->escape($item->shortdesc); ?></p>
                  </div>
                </a>
              </ul>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>
