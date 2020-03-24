<?php
Yii::$app->formatter->locale = 'ru-RU';
echo Yii::$app->formatter->asDate('2016-01-01'); // output: 1 января 2016 г.
Yii::$app->formatter->locale = 'de-DE';
// output: 1. Januar 2016
echo Yii::$app->formatter->asDate('2016-01-01');
Yii::$app->formatter->locale = 'en-US';
// output: January 1, 2016
echo Yii::$app->formatter->asDate('2016-01-01');