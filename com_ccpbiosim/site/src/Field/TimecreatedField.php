<?php
/**
 * @version    CVS: 0.0.1
 * @package    Com_Test
 * @author     James Gebbie-Rayet <james.gebbie@gmail.com>
 * @copyright  2025 CCPBioSim Team
 * @license    MIT
 */

namespace Testing\Component\Test\Site\Field;

defined('JPATH_BASE') or die;

use \Joomla\CMS\Factory;
use \Joomla\CMS\Language\Text;
use \Joomla\CMS\Form\FormField;
use \Joomla\CMS\Date\Date;
use Joomla\CMS\HTML\HTMLHelper;

/**
 * Supports an HTML select list of categories
 *
 * @since  0.0.1
 */
class TimecreatedField extends FormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  0.0.1
	 */
	protected $type = 'timecreated';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   0.0.1
	 */
	protected function getInput()
	{
		// Initialize variables.
		$html = array();

		$time_created = $this->value;

		if (!strtotime($time_created))
		{
			$time_created = Factory::getDate()->toSql();
			$html[]       = '<input type="hidden" name="' . $this->name . '" value="' . $time_created . '" />';
		}

		$hidden = (boolean) $this->element['hidden'];

		if ($hidden == null || !$hidden)
		{
			$pretty_date = HTMLHelper::_('date', $time_created, Text::_('DATE_FORMAT_LC2'), true);
			$html[]      = "<div>" . $pretty_date . "</div>";
		}

		return implode($html);
	}
}
