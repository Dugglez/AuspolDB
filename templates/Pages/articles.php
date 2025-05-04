<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

$checkConnection = function (string $name) {
    $error = null;
    $connected = false;
    try {
        $connection = ConnectionManager::get($name);
        $connected = $connection->connect();
    } catch (Exception $connectionError) {
        $error = $connectionError->getMessage();
        if (method_exists($connectionError, 'getAttributes')) {
            $attributes = $connectionError->getAttributes();
            if (isset($attributes['message'])) {
                $error .= '<br />' . $attributes['message'];
            }
        }
        if ($name === 'debug_kit') {
            $error = 'Try adding your current <b>top level domain</b> to the
                <a href="https://book.cakephp.org/debugkit/4/en/index.html#configuration" target="_blank">DebugKit.safeTld</a>
            config and reload.';
            if (!in_array('sqlite', \PDO::getAvailableDrivers())) {
                $error .= '<br />You need to install the PHP extension <code>pdo_sqlite</code> so DebugKit can work properly.';
            }
        }
    }

    return compact('connected', 'error');
};


?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        AuspolDB
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon', '/webroot/favicon.ico', ['type' => 'icon']) ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake', 'home']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<style>
    body {
        background-color: rgb(249, 249, 249);
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        background-color: #4CAF50;
        color: white;
        border: 1px solid #4CAF50;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #45a049;
    }

    .big-link {
    font-size: 18px; /* Adjust font size as needed */


}


</style>
<body>

        <div class="container text-center">

                <a href="/">
                    <img src='/webroot/img/auspoldb.png' alt="AuspolDB" style="max-width: 800px; max-height: 400px;">
                </a>


        </div>

    <main class="main">
        <div class="container">
            <div class="content" style="width: 110%;">

                <div class="row">
                    <div class="column" >
                        <h1>Articles</h1>

<br>
<ul style="display: flex; list-style: none; justify-content: space-between; flex-direction: column;">
    <li><?= $this->Html->link('Wander forever the middle warrens', ['controller' => 'Pages', 'action' => '2025election'], ['class' => 'big-link']) ?></li>
    <li style="border-bottom: 1px solid #000; margin-bottom: 10px; padding-bottom: 5px;"></li>
     <li><?= $this->Html->link('On territories, government and data deficiency', ['controller' => 'Pages', 'action' => 'territoriestrouble'], ['class' => 'big-link']) ?></li>
    <li style="border-bottom: 1px solid #000; margin-bottom: 10px; padding-bottom: 5px;"></li>
    <li><?= $this->Html->link('When ideology and electoral efficacy clash', ['controller' => 'Pages', 'action' => 'ideologicalconfusion'], ['class' => 'big-link']) ?></li>
    <li style="border-bottom: 1px solid #000; margin-bottom: 10px; padding-bottom: 5px;"></li>
    <li><?= $this->Html->link('Misinformation and Social Media Ban Bills', ['controller' => 'Pages', 'action' => 'misinfoandsocialmedia'], ['class' => 'big-link']) ?></li>
    <li style="border-bottom: 1px solid #000; margin-bottom: 10px; padding-bottom: 5px;"></li>
    <li><?= $this->Html->link('On Safety', ['controller' => 'Pages', 'action' => 'onsafety'], ['class' => 'big-link']) ?></li>
    <li style="border-bottom: 1px solid #000; margin-bottom: 10px; padding-bottom: 5px;"></li>
   <li><?= $this->Html->link('How Don Camerons (plural) improved AuspolDB', ['controller' => 'Pages', 'action' => 'doncameron'], ['class' => 'big-link']) ?></li>
    <li style="border-bottom: 1px solid #000; margin-bottom: 10px; padding-bottom: 5px;"></li>
     <li><?= $this->Html->link('Select Data: High and Low votes', ['controller' => 'Pages', 'action' => 'highvotesandlowvotes'], ['class' => 'big-link']) ?></li>
    <li style="border-bottom: 1px solid #000; margin-bottom: 10px; padding-bottom: 5px;"></li>
    <li><?= $this->Html->link('The Swan By-Election Myth', ['controller' => 'Pages', 'action' => 'swanbyelection'], ['class' => 'big-link']) ?></li>
    <li style="border-bottom: 1px solid #000; margin-bottom: 10px; padding-bottom: 5px;"></li>
    
</ul>





                    </div>

                </div>
    </main>
</body>
</html>
