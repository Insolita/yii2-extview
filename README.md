Simple behavior for set module default view extension
===================================================
Behavior for set custom view extension on all module, or some actions
Main purpose - quick way for theming external modules with favorite template engine


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist insolita/yii2-extview "~1.0"
```

or add

```
"insolita/yii2-extview": "~1.0"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
   'modules'=>[
         'someModule'=>[
               'class'=>'\some\Module',
                'prop'=>'foo',
               'as extview'=>[
                    'class'=>'insolita\extview\ExtviewBehavior',
                     'viewExtension'=>'twig' //it set twig extension for all module controllers

                     //Or with anonymous function with argument $route (equals \yii\base\Action $uniqueId property )
                     'viewExtension'=>function($route){
                           return($route=='some-module/default/index')?'php':'twig';
                      }
                 ]
         ]
   ]
```
And as usual - add module to pathmap in theme config
```php
'components' => [
        'view' => [
            'theme' => [
                'basePath' => '@app/themes/mytheme',
                'baseUrl' => '@web/themes/mytheme',
                'pathMap' => [
                    '@app/views' => '@app/themes/mytheme',
                    '@vendor/someModule/views'=>'@app/themes/mytheme/modules/someModule'
                ],
            ],
        ],
    ],
```