<?php

namespace DMK\T3twig\View;

use DMK\T3twig\Util\TwigUtil;

/**
 * Class BaseTwigView
 *
 * @category TYPO3-Extension
 * @package  DMK\T3twig\View
 * @author   Eric Hertwig <dev@dmk-ebusiness.de>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://www.dmk-ebusiness.de/
 */
class BaseTwigView extends \tx_rnbase_view_Base
{
	/**
	 * @param string $view
	 * @param \tx_rnbase_configurations $configurations
	 *
	 * @return string
	 */
	function render( $view, &$configurations )
	{
		$template = TwigUtil::getTwigTemplate(
			\tx_rnbase_util_Files::getFileAbsFileName($this->getTemplate($view, '.html.twig'))
		);

		TwigUtil::injectExtensions($template->getEnvironment(), $configurations->getExploded('twig_extensions.'));

		$result = $template->render(
			[
				'viewData' => $configurations->getViewData(),
				'configurations' => $configurations,
				'formatter' => $configurations->getFormatter(),
			]
		);

		return $result;
	}
}
