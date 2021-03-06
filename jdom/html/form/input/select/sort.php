<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <     JDom Class - Cook Self Service library    |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Cook Self Service
* @subpackage	JDom
* @license		GNU General Public License
* @author		Jocelyn HUARD
*
*             .oooO  Oooo.
*             (   )  (   )
* -------------\ (----) /----------------------------------------------------------- +
*               \_)  (_/
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


class JDomHtmlFormInputSelectSort extends JDomHtmlFormInputSelect
{
	var $assetName = 'joomla';

	var $attachJs = array(
		'joomla.js'
	);
	
	/*
	 * Constuctor
	 * 	@namespace 	: requested class
	 *  @options	: Configuration
	 * 	@dataKey	: database field name
	 * 	@dataObject	: complete object row (stdClass or Array)
	 * 	@dataValue	: value  default = dataObject->dataKey
	 * 	@domID		: HTML id (DOM)  default=dataKey
	 *
	 */
	function __construct($args)
	{
		parent::__construct($args);
	}

	function build()
	{
		$html = JDom::_('html.form.input.select.combo', array_merge($this->options, array(
			'domClass' => 'input-medium ' . $this->options['domClass'],
			'selectors' => array(
				'onchange' => 'Joomla.orderTable();'
			)
		
		)));		
		return $html;
	}
	
	function buildJs()
	{
		if (!$this->jVersion('3.0'))
			$this->attachJs[] = 'legacy-ordering.js';
		
		
		$js = "var currentListOrder = '" . htmlspecialchars($this->dataValue) . "';";
		$this->addScriptInline($js);
	}

}