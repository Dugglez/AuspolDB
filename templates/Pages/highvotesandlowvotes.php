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
                        <h1>Select Data: High and Low votes</h1>

<br>
<p>
    Given I now have this dataset, I think it would be worth exploring some of the interesting information that is contained within it.
    The ability to run SQL commands on the dataset makes finding some answers quite easy. The question I will be addressing in this, the first 
    in a possible series of articles, has to do with exceptional primary votes. Some MPs (and MLAs/MLCs in Victoria) have been elected off of 
    quite small primary votes. In terms of raw numbers, the member elected with the least votes comes from the early colonial period of Victoria,
    which had the smallest enrolments and a smaller franchise, while the member elected with the most votes comes from a modern federal division,
    which is larger in population than Victoria's electoral districts. Obviously, there are many examples of electorates that were uncontested 
    and hence have victorious candidates recording 0 primary votes, but that is not what we are looking for here.


    <br>
    In 1856, at the first Victorian election, <?php
                    echo $this->Html->link(
                        'James McCulloch',
                        ['controller' => 'Candidates', 'action' => 'view', 25338]
                    );
                    ?>, who would go on to serve as Victoria's third longest-serving premier, was elected as one of two representatives for <?php
                    echo $this->Html->link(
                        'Wimmera',
                        ['controller' => 'Electorate', 'action' => 'view', 347]
                    );
                    ?>,
                    recording just 25 primary votes, beating the third candidate by a single vote. There are several more candidates in 
                    that election who recorded primary votes of less than 100 but managed to be elected. 

    <br>
    At a federal level, the smallest primary vote I can find for an elected candidate is in the <?php
                    echo $this->Html->link(
                        'Division of Northern Territory',
                        ['controller' => 'Electorate', 'action' => 'view', 168]
                    );
                    ?> in 1922, 
    where <?php
                    echo $this->Html->link(
                        'Harold Nelson',
                        ['controller' => 'Candidates', 'action' => 'view', 13796]
                    );
                    ?> managed to get elected from a primary vote of 452, which rose to 608 after preferences in order to defeat independent
                    <?php
                    echo $this->Html->link(
                        'Arthur Love',
                        ['controller' => 'Candidates', 'action' => 'view', 14220]
                    );
                    ?> by a margin of 9 votes. The next 8 entries all come from the Northern Territory in various years.

                    <br>
                    At the other end of the scale, the largest primary vote in terms of raw numbers at a federal level was recorded in 
                    2010 by <?php
                    echo $this->Html->link(
                        'Julia Gillard',
                        ['controller' => 'Candidates', 'action' => 'view', 3945]
                    );
                    ?> in her division of <?php
                    echo $this->Html->link(
                        'Lalor',
                        ['controller' => 'Electorate', 'action' => 'view', 89]
                    );
                    ?>, with a vote of 66298, which rose to 74452 after preferences. This is only the fourth-biggest
                    vote in terms of two-candidate preferred, however. The largest 2CP vote was recorded by <?php
                    echo $this->Html->link(
                        'Andrew Leigh',
                        ['controller' => 'Candidates', 'action' => 'view', 2054]
                    );
                    ?> in 2016 in his division of <?php
                    echo $this->Html->link(
                        'Fenner',
                        ['controller' => 'Electorate', 'action' => 'view', 50]
                    );
                    ?>, with a 2CP vote of 79242.
                    <br>
                    In Victoria, the first result I found was a data entry error. The second, which I believe to be correct, is 
                    <?php
                    echo $this->Html->link(
                        'Ros Spence',
                        ['controller' => 'Candidates', 'action' => 'view', 19624]
                    );
                    ?> in her division of <?php
                    echo $this->Html->link(
                        'Yuroke',
                        ['controller' => 'Electorate', 'action' => 'view', 314]
                    );
                    ?> at the 2018 election, with a primary vote of 28519. Spence's is also the second-highest 2CP vote.
                    The highest 2CP vote, which I originally thought was a data entry error as well, actually turned out to be correct. Instead of coming 
                    from a Labor electorate from a recent election, the result was actually recorded in a Liberal electorate 60 years ago. At the 1964 state 
                    election, <?php
                    echo $this->Html->link(
                        'Raymond Wiltshire',
                        ['controller' => 'Candidates', 'action' => 'view', 22846]
                    );
                    ?> recorded a 2CP vote of 34333, compared with Spence's 2018 2CP vote of 33740. Wiltshire's division of <?php
                    echo $this->Html->link(
                        'Mulgrave',
                        ['controller' => 'Electorate', 'action' => 'view', 272]
                    );
                    ?> had a turnout around 5000 
                    votes higher than any other electorate of that year. 





</p>


<?php
                    echo $this->Html->link(
                        'Sir Earle Page',
                        ['controller' => 'Candidates', 'action' => 'view', 12366]
                    );
                    ?>


                    </div>

                </div>
    </main>
</body>
</html>
