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


class JDomHtmlFly extends JDomHtml
{
	var $fallback = 'default';	//Used for default

	protected $dataKey;
	protected $dataObject;
	protected $dataValue;

	protected $preview;
	protected $handler; // Can be 'iframe'
	protected $href;
	protected $task;
	protected $num;
	
	protected $link_title;
	protected $titleKey;
	protected $target;
	protected $markup;

	/*
	 * Constuctor
	 * 	@namespace 	: requested class
	 *  @options	: Configuration
	 *
	 * 	@dataKey	: database field name
	 * 	@dataObject	: complete object row (stdClass or Array)
	 * 	@dataValue	: value  default = dataObject->dataKey
	 *	@preview	: Preview type
	 *	@href		: Link
	 *	@task		: Task
	 *	@link_title	: Title for the link (Plain value)
	 *	@titleKey	: Title key for the link (property of dataObject)
	 *	@target		: Target of the link  ('download', '_blank', 'modal', ...)
	 *	@markup		: Can be used to customize HTML markup for the wrapper (default:span)
	 *
	 */
	function __construct($args)
	{
		parent::__construct($args);


		$this->arg('dataKey'	, null, $args);
		$this->arg('dataObject'	, null, $args);
		$this->arg('dataValue'	, null, $args, (($item = $this->dataObject) && ($key = $this->dataKey))?$this->parseKeys($item, $key):null);

		$this->arg('preview'	, null, $args);
		$this->arg('handler'		, null, $args);
		$this->arg('href'		, null, $args);
		$this->arg('task'		, null, $args);
		$this->arg('num'		, null, $args);
		$this->arg('link_title'	, null, $args);
		$this->arg('titleKey'	, null, $args);
		$this->arg('target'		, null, $args);
		$this->arg('markup'		, null, $args);

		if (count($this->styles) || count($this->classes) || count($this->selectors) || $this->domClass || $this->title)
		{
			if (!$this->markup)
				$this->markup = 'span';
		}
	}


	protected function parseVars($vars)
	{
		return parent::parseVars(array_merge(array(
			'DOM_ID'		=> $this->domId,
			'STYLE'		=> $this->buildDomStyles(),
			'CLASS'			=> $this->buildDomClass(),		//With attrib name
			'CLASSES'		=> $this->getDomClass(),		// Only classes
			'SELECTORS'		=> $this->buildSelectors(),
			'VALUE'			=> htmlspecialchars($this->dataValue, ENT_COMPAT, 'UTF-8'),
			'JSON_REL' 		=> htmlspecialchars($this->jsonArgs(), ENT_COMPAT, 'UTF-8'),
			'MARKUP'		=> (isset($this->markup)?$this->markup:'')
		), $vars));
	}

}