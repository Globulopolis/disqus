<?php defined('_JEXEC') or die;

class plgContentDisqus extends JPlugin {
	public function __construct(& $subject, $config) {
		parent::__construct($subject, $config);

		$app = JFactory::getApplication();
		$document = JFactory::getDocument();
		$this->loadLanguage();

		if ($app->isSite()) {
			$document->addHeadLink(JURI::base().'plugins/content/disqus/assets/disqus.css', 'stylesheet', 'rel', array('type'=>'text/css'));
		}

		if ($this->params->get('jquery') == 1 && $app->isSite()) {
			JHtml::_('script', JURI::base().'plugins/content/disqus/assets/jquery.latest.min.js');
		}

		if ($app->isSite()) {
			$displayCount = ($this->params->get('counter', 0, 'int') == 0) ? 'false' : 'true'; // Convert integer to string for javascript. It's ugly I know.

			echo '<script src="'.JURI::base().'plugins/content/disqus/assets/disqus.min.js" type="text/javascript"></script>'."\n";
			echo '<script type="text/javascript">
				disqus_shortname = "'.$this->params->get('shortname').'";
				jQuery(document).ready(function($){
					$("'.$this->params->get('selector', 'article', 'string').'").inlineDisqussions({
						displayCount: '.$displayCount.'
					});
				});
			</script>';
		}
	}
}
