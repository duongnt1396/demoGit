<?php
use yii\helpers\Url;
?>

<h4>
    <b>Url::home():</b>
    <?php
    // home page URL: /index.php?r=site/index
    echo Url::home();
    ?>
</h4>

<h4>
    <b>Url::base():</b>
    <?php
    // the base URL, useful if the application is deployed in a sub-folder of the Web root
    echo Url::base();
    ?>
</h4>

<h4>
    <b>Url::canonical():</b>
    <?php
    // the canonical URL of the currently requested URL
    // see https://en.wikipedia.org/wiki/Canonical_link_element
    echo Url::canonical();
    ?>
</h4>

<h4>
    <b>Url::previous():</b>
    <?php
    // remember the currently requested URL and retrieve it back in later requests
    Url::remember();
    echo Url::previous();
    ?>
</h4>