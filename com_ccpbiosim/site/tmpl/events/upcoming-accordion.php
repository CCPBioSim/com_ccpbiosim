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
  <style>
    /* Calendar-style date boxes */
    .event-date {
      width: 72px;
      text-align: center;
      border-radius: 8px;
      padding: 6px 4px;
      font-weight: 600;
      line-height: 1.1;
      flex-shrink: 0;
    }
    .event-date .month {
      font-size: 0.75rem;
      text-transform: uppercase;
    }
    .event-date .day {
      font-size: 1.4rem;
    }
    .event-date .year {
      font-size: 0.7rem;
      opacity: 0.8;
    }
    .event-date.range {
      width: auto;
      padding: 6px 10px;
      font-size: 0.8rem;
    }
  </style>

  <!-- Main Content -->
  <main class="container my-5">

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
            <ul class="list-group list-group-flush">

              <a href="event.html?id=1"
                 class="list-group-item list-group-item-action d-flex align-items-start gap-3">
                <div class="event-date bg-primary text-white">
                  <div class="month">Mar</div>
                  <div class="day">18–20</div>
                  <div class="year">2026</div>
                </div>
                <div>
                  <h6 class="mb-1">Tech Conference 2026</h6>
                  <small class="text-muted">San Francisco, CA</small>
                  <p class="mb-1">A global conference covering AI, cloud, and future tech.</p>
                </div>
              </a>

              <a href="event.html?id=2"
                 class="list-group-item list-group-item-action d-flex align-items-start gap-3">
                <div class="event-date bg-primary text-white">
                  <div class="month">Apr</div>
                  <div class="day">10–12</div>
                  <div class="year">2026</div>
                </div>
                <div>
                  <h6 class="mb-1">Business Innovation Summit</h6>
                  <small class="text-muted">London, UK</small>
                  <p class="mb-1">Leaders meet to discuss modern business strategies.</p>
                </div>
              </a>

            </ul>
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
            <ul class="list-group list-group-flush">

              <a href="event.html?id=3"
                 class="list-group-item list-group-item-action d-flex align-items-start gap-3">
                <div class="event-date bg-success text-white">
                  <div class="month">Apr</div>
                  <div class="day">2</div>
                  <div class="year">2026</div>
                </div>
                <div>
                  <h6 class="mb-1">Intro to AI</h6>
                  <small class="text-muted">Online</small>
                  <p class="mb-1">Learn the fundamentals of AI in this beginner-friendly webinar.</p>
                </div>
              </a>

              <a href="event.html?id=4"
                 class="list-group-item list-group-item-action d-flex align-items-start gap-3">
                <div class="event-date range bg-success text-white">
                  Apr 20–22<br>2026
                </div>
                <div>
                  <h6 class="mb-1">Marketing Automation Series</h6>
                  <small class="text-muted">Online</small>
                  <p class="mb-1">Three-day webinar series on scaling marketing automation.</p>
                </div>
              </a>

            </ul>
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
            <ul class="list-group list-group-flush">

              <a href="event.html?id=5"
                 class="list-group-item list-group-item-action d-flex align-items-start gap-3">
                <div class="event-date range bg-warning text-dark">
                  May 5–6<br>2026
                </div>
                <div>
                  <h6 class="mb-1">UX Design Workshop</h6>
                  <small class="text-muted">New York, NY</small>
                  <p class="mb-1">Hands-on UX design workshop with real-world exercises.</p>
                </div>
              </a>

              <a href="event.html?id=6"
                 class="list-group-item list-group-item-action d-flex align-items-start gap-3">
                <div class="event-date range bg-warning text-dark">
                  May 18–22<br>2026
                </div>
                <div>
                  <h6 class="mb-1">Full-Stack Bootcamp</h6>
                  <small class="text-muted">Berlin, DE</small>
                  <p class="mb-1">Intensive multi-day bootcamp covering frontend and backend.</p>
                </div>
              </a>

            </ul>
          </div>
        </div>
      </div>

    </div>






<form action="<?php echo htmlspecialchars(Uri::getInstance()->toString()); ?>" method="post"
	  name="adminForm" id="adminForm">
	
	<div class="table-responsive">
		<table class="table table-striped" id="eventList">
			<thead>
			<tr>
				
					<th class=''>
						<?php echo HTMLHelper::_('grid.sort',  'COM_CCPBIOSIM_EVENTS_ID', 'a.id', $listDirn, $listOrder); ?>
					</th>

					<th >
						<?php echo HTMLHelper::_('grid.sort', 'JPUBLISHED', 'a.state', $listDirn, $listOrder); ?>
					</th>

					<th class=''>
						<?php echo HTMLHelper::_('grid.sort',  'COM_CCPBIOSIM_EVENTS_TITLE', 'a.title', $listDirn, $listOrder); ?>
					</th>

					<th class=''>
						<?php echo HTMLHelper::_('grid.sort',  'COM_CCPBIOSIM_EVENTS_CATEGORY', 'a.category', $listDirn, $listOrder); ?>
					</th>

					<th class=''>
						<?php echo HTMLHelper::_('grid.sort',  'COM_CCPBIOSIM_EVENTS_STARTDATETIME', 'a.startdatetime', $listDirn, $listOrder); ?>
					</th>

					<th class=''>
						<?php echo HTMLHelper::_('grid.sort',  'COM_CCPBIOSIM_EVENTS_ENDDATETIME', 'a.enddatetime', $listDirn, $listOrder); ?>
					</th>

						<?php if ($canEdit || $canDelete): ?>
					<th class="center">
						<?php echo Text::_('COM_CCPBIOSIM_EVENTS_ACTIONS'); ?>
					</th>
					<?php endif; ?>

			</tr>
			</thead>
			<tfoot>
			<tr>
				<td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">
					<div class="pagination">
						<?php echo $this->pagination->getPagesLinks(); ?>
					</div>
				</td>
			</tr>
			</tfoot>
			<tbody>
			<?php foreach ($this->items as $i => $item) : ?>
				<?php $canEdit = $user->authorise('core.edit', 'com_ccpbiosim'); ?>
				<?php if (!$canEdit && $user->authorise('core.edit.own', 'com_ccpbiosim')): ?>
				<?php $canEdit = Factory::getApplication()->getIdentity()->id == $item->created_by; ?>
				<?php endif; ?>

				<tr class="row<?php echo $i % 2; ?>">
					
					<td>
						<?php echo $item->id; ?>
					</td>
					<td>
						<?php $class = ($canChange) ? 'active' : 'disabled'; ?>
						<a class="btn btn-micro <?php echo $class; ?>" href="<?php echo ($canChange) ? Route::_('index.php?option=com_ccpbiosim&task=event.publish&id=' . $item->id . '&state=' . (($item->state + 1) % 2), false, 2) : '#'; ?>">
						<?php if ($item->state == 1): ?>
							<i class="icon-publish"></i>
						<?php else: ?>
							<i class="icon-unpublish"></i>
						<?php endif; ?>
						</a>
					</td>
					<td>
						<?php $canCheckin = Factory::getApplication()->getIdentity()->authorise('core.manage', 'com_ccpbiosim.' . $item->id) || $item->checked_out == Factory::getApplication()->getIdentity()->id; ?>
						<?php if($canCheckin && $item->checked_out > 0) : ?>
							<a href="<?php echo Route::_('index.php?option=com_ccpbiosim&task=event.checkin&id=' . $item->id .'&'. Session::getFormToken() .'=1'); ?>">
							<?php echo HTMLHelper::_('jgrid.checkedout', $i, $item->uEditor, $item->checked_out_time, 'event.', false); ?></a>
						<?php endif; ?>
						<a href="<?php echo Route::_('index.php?option=com_ccpbiosim&view=event&id='.(int) $item->id); ?>">
							<?php echo $this->escape($item->title); ?></a>
					</td>
					<td>
						<?php echo $item->category; ?>
					</td>
					<td>
						<?php echo $item->startdatetime; ?>
					</td>
					<td>
						<?php echo $item->enddatetime; ?>
					</td>
					<?php if ($canEdit || $canDelete): ?>
						<td class="center">
							<?php $canCheckin = Factory::getApplication()->getIdentity()->authorise('core.manage', 'com_ccpbiosim.' . $item->id) || $item->checked_out == Factory::getApplication()->getIdentity()->id; ?>

							<?php if($canEdit && $item->checked_out == 0): ?>
								<a href="<?php echo Route::_('index.php?option=com_ccpbiosim&task=event.edit&id=' . $item->id, false, 2); ?>" class="btn btn-mini" type="button"><i class="icon-edit" ></i></a>
							<?php endif; ?>
							<?php if ($canDelete): ?>
								<a href="<?php echo Route::_('index.php?option=com_ccpbiosim&task=eventform.remove&id=' . $item->id, false, 2); ?>" class="btn btn-mini delete-button" type="button"><i class="icon-trash" ></i></a>
							<?php endif; ?>
						</td>
					<?php endif; ?>

				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php if ($canCreate) : ?>
		<a href="<?php echo Route::_('index.php?option=com_ccpbiosim&task=eventform.edit&id=0', false, 0); ?>"
		   class="btn btn-success btn-small"><i
				class="icon-plus"></i>
			<?php echo Text::_('COM_CCPBIOSIM_ADD_ITEM'); ?></a>
	<?php endif; ?>

	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value=""/>
	<input type="hidden" name="filter_order_Dir" value=""/>
	<?php echo HTMLHelper::_('form.token'); ?>
</form>

<?php
	if($canDelete) {
		$wa->addInlineScript("
			jQuery(document).ready(function () {
				jQuery('.delete-button').click(deleteItem);
			});

			function deleteItem() {

				if (!confirm(\"" . Text::_('COM_CCPBIOSIM_DELETE_MESSAGE') . "\")) {
					return false;
				}
			}
		", [], [], ["jquery"]);
	}
?>
