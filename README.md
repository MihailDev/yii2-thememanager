Плагин для удобного внедрения Yii2 тем
========================

Создаём тему для проекта

В нём создаём фаил composer.json
```json
{
	"name": "some/yii2-theme-name",

	"type": "yii2-theme",

	"target-dir": "my-theme",
	"require": {
        "mihaildev/yii2-thememanager":"*",
	}
}
```

Обезательный параметр "type" равный "yii2-theme"

Настройка на сервере
------------------------
Создаём фаил composer.json
```json
{
	"require": {
        "my/yii2-project": "*",
        "my/yii2-theme": "*"
	},
	"extra": {
		"webpath": "www",
		"themespath": "themes",
		"themes": {
		    "my/yii2-theme": "basic"
		}
	}
}
```

В разделе "extra" настраиваем пути на сервере для

"webpath" - публичная часть

"themespath" - префикс тем путь генерируется на основе  "webpath" ("webpath"."/"."themespath")

"themes" - раздел в котором указывается название папки в котором будет хранится тема путь генерируется в зависимости от названия пакета
из примера выше мы указали что тему "my/yii2-theme" нужно хранить в папке "basic" то есть путь сгенерируется на основе всех настроек ("webpath"."/"."themespath"."/"."basic")

Удобен для совместного использования вместе с https://github.com/MihailDev/yii2-projectmanager

Пробная установка
------------------------
Создаём фаил на сервере composer.json
```json
{
	"minimum-stability": "dev",
	"require": {
        "mihaildev/yii2-project-blank": "*",
        "mihaildev/yii2-test-theme": "*"
	},

	"extra": {
		"webpath": "www",
        "themes": {
            "mihaildev/yii2-test-theme": "basic"
        }
	}
}
```

Настраиваем пути! Информацию о настройках проекта смотреть тут https://github.com/MihailDev/yii2-projectmanager

в настройкаж приложения (private/config/web.php) подключаем тему
```
$config = [
    'components' => [
        //...
        'view' => [
            'class' => 'yii\web\View',
            'theme' => [
                'basePath' => '@webroot/themes/basic',
                'baseUrl' => '@web/themes/basic',
            ],
        ],
        //...
    ],
    //...
];
```

Смотрим!
