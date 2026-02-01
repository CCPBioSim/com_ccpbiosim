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
use \Joomla\CMS\Form\FormField;

/**
 * Supports an HTML select list of categories
 *
 * @since  0.0.1
 */
class ModifiedbyField extends FormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  0.0.1
	 */
	protected $type = 'modifiedby';

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
		$html   = array();
		$user   = Factory::getApplication()->getIdentity();
		$html[] = '<input type="hidden" name="' . $this->name . '" value="' . $user->id . '" />';

		if (!$this->hidden)
		{
			$html[] = "<div>" . $user->name . " (" . $user->username . ")</div>";
		}

		return implode($html);
	}
}
