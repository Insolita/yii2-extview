<?php
/**
 * Created by solly [03.06.16 14:08]
 */

namespace insolita\extview;


use yii\base\ActionEvent;
use yii\base\Behavior;
use yii\base\Module;

/**
 * Behavior for set custom view extension on all module, or some actions
 *
 * @example
 *  'modules'=>[
 *        'someModule'=>[
 *              'class'=>'\some\Module',
 *               'prop'=>'foo',
 *               'as extview'=>[
 *                    'class'=>'insolita\extview\Extview',
 *                    'viewExtension'=>'twig' //it set twig extension for all module controllers
 *
 *                    //Or with anonymous function with argument $route (equals \yii\base\Action $uniqueId property )
 *                    'viewExtension'=>function($route){
 *                          return ($route=='some-module/default/index')?'php':'twig';
 *                     }
 *                ]
 *        ]
 *  ]
 **/
class ExtviewBehavior extends Behavior
{
	/**
	 * @var string|callable|\Closure $viewExtension
	 */
	public $viewExtension = 'php';

	public function events()
	{
		return [
			Module::EVENT_BEFORE_ACTION => 'modifyViewFile',
		];
	}

	public function modifyViewFile(ActionEvent $event)
	{
		if (is_string($this->viewExtension))
		{
			$event->action->controller->getView()->defaultExtension = $this->viewExtension;
		}
		elseif (is_callable($this->viewExtension))
		{
			$extension = call_user_func($this->viewExtension, $event->action->uniqueId);
			$event->action->controller->getView()->defaultExtension = $extension;
		}
	}
}