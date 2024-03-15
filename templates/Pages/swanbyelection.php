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
    font-size: 18px;  


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
                        <h1>The Swan By-Election Myth</h1>

<br>
<p>
    The story is often told like this: On the 26th of October, 1918, a by-election for the seat of Swan was held. 
    Labor, the Nationalists and the fledgling Country Party all contested the seat, as well as an independent.
    The vote shares were: <br>
    Labor: 34.4%<br>
    Country: 31.4% <br>
    Nationalist: 29.6%<br>
    
    Despite the two conservative parties receiving 61% of the vote, Labor had received the most votes and won the seat. Immediately, the conservative government began drafting legislation that would bring
    about a preferential voting system, so that the two conservative parties could contest seats without risking Labor winning off of a split conservative vote. By the time of the next federal election,
    the Commonwealth Electoral Act 1918 had been passed, and preferential voting had become the lower house voting system at a federal level. A simple decision made by a government for its own benefit which
    most agree has strengthened Australian democratic institutions.<br><br>
    Except that isn't really how it happened.
    <br><br>
    The bill that would become the Commonwealth Electoral Act 1918 had <a href="https://parlinfo.aph.gov.au/parlInfo/search/display/display.w3p;query=Id%3A%22hansard80%2Fhansardr80%2F1918-10-03%2F0041%22">
        already been before parliament</a> for several weeks prior to the Swan By-election. 
    The Nationalist government of <?php
                    echo $this->Html->link(
                        'Billy Hughes',
                        ['controller' => 'Candidates', 'action' => 'view', 14821]
                    );
                    ?> had not brought in preferential voting by choice. They had been coerced.
    
    Preferential voting was meant to have been implemented far earlier by <?php
                    echo $this->Html->link(
                        'Joseph Cook',
                        ['controller' => 'Candidates', 'action' => 'view', 14605]
                    );
                    ?>'s government, but its defeat in 1914 took the issue off of the table for the time being.
    The story begins with the associations and groups that would eventually come to form the Country Party, which sought to represent agricultural and rural interests in Parliament.
    When the farmers' associations began to call again for preferential voting, the Nationalist government of Billy Hughes, who had changed allegiances from Labor to Nationalist during his prime ministership, 
    gave an equivocating response. The Victorian Farmers Union (VFU) took decisive action to motivate Hughes, whose Labor origins earned him distrust in farming circles, 
    by seeking to hold hostage the impending by-election for Flinders on the 11th of May, 1918.
    They would do this by running a candidate against the Nationalist candidate, <?php
                    echo $this->Html->link(
                        'Stanley Bruce',
                        ['controller' => 'Candidates', 'action' => 'view', 14443]
                    );
                    ?>, who would go on to become Prime Minister in the 1920s.
     By doing so, the VFU threatened to split the conservative vote, perhaps leading 
    to a Labor victory. The Nationalists sought the withdrawal of the VFU candidate, but the VFU stood steadfast until two days before the by-election, when Nationalist acting Prime Minister <?php
                    echo $this->Html->link(
                        'William Watt',
                        ['controller' => 'Candidates', 'action' => 'view', 19313]
                    );
                    ?> 
    guaranteed the passage of preferential voting for federal elections. Having got what they wanted, the VFU threw their support behind Bruce, who was elected handily. Watt's promise was honoured, and the
    Commonwealth Electoral Act received royal assent on the 21st of November, 1918. 
    The Country Party's first federal election in 1919 saw them record an incredible debut, going from 0 seats to 15, largely off the back of the voting changes they had extracted from the Nationalists.
    Country Party leader <?php
                    echo $this->Html->link(
                        'Sir Earle Page',
                        ['controller' => 'Candidates', 'action' => 'view', 12366]
                    );
                    ?> also saw off Billy Hughes, demanding he step down in exchange for the Country party's support.
    The story of preferential voting is one of brinksmanship, in which the Country Party capably stared down the Nationalists. You can learn more about the Country party's exploits <a href="https://www.youtube.com/watch?v=K0RHRQC2PW8">
        here</a>.
</p>





                    </div>

                </div>
    </main>
</body>
</html>
