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
class TimeupdatedField extends FormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  0.0.1
	 */
	protected $type = 'timeupdated';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string    The field input markup.
	 *
	 * @since   0.0.1
	 */
	protected function getInput()
	{
		// Initialize variables.
		$html = array();

		$old_time_updated = $this->value;
		$hidden           = (boolean) $this->element['hidden'];

		if ($hidden == null || !$hidden)
		{
			if (!strtotime($old_time_updated))
			{
				$html[] = '-';
			}
			else
			{
				$pretty_date = HTMLHelper::_('date', $old_time_updated, Text::_('DATE_FORMAT_LC2'), true);
				$html[]      = "<div>" . $pretty_date . "</div>";
			}
		}

		$time_updated = Factory::getDate()->toSql();
		$html[]       = '<input type="hidden" name="' . $this->name . '" value="' . $time_updated . '" />';

		return implode($html);
	}
}
