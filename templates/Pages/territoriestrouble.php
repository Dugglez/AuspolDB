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
                        <h1>On territories, government and data deficiency</h1>

<br>
<p>
My decision to expand AuspolDB to include results from the self-governing territories began with me thinking it would be a fairly simple endeavour. 
Both were unicameral and hadn't had many elections, relative to the states or the federal parliament. I didn't expect to be confronting fundamental 
questions like "What is a government?" or being forced to make a choice between two bad options on data integrity.

The first step of the process is research. I knew the ACT had been self-governing since 1989, and the NT since the 70s. I had not considered, however, 
that I would have to decide on whether to include previous bodies prior to self-government. As noted in the relevant sections of the <?php
                    echo $this->Html->link(
                        'About Elections',
                        ['controller' => 'Pages', 'action' => 'elections']
                    );
                    ?> 
page, the ACT and NT both had partially-elected bodies prior to self-government. This, in itself, was not grounds for exclusion, as I had included 
partially-nominated bodies like the Victorian Legislative Council from 1851 to 1856 previously. After much deliberation and consideration, 
I chose to include the NT's Legislative Council, but left out the ACT's pre-self-government bodies. This decision was based on the fact that 
the Legislative Council had the ability to make laws (subject to commonwealth veto), while the ACT's bodies were solely advisory until self-government. 
I chose to separate the NT Legislative Council from the self-governing Legislative Assembly to make that distinction clear in the data.

Following that decision, I got to work getting the data in shape for insertion into the database. Most of the ACT elections were already in a form I could use, 
they were just missing the order of election, which I inserted manually.  The first 2 ACT elections lack election orders and individual candidate primary votes, 
with only ticket votes available. The ACT Electoral Commission informed me that they "don`t have data from the first election in '89" at all, as the election was 
conducted by the AEC. Things were worse in the NT, where election data for early Legislative Assembly elections saw primary votes for independent candidates combined, 
even in cases where they were successful. Worse still, in the electoral division of Tiwi in 1977, there were two endorsed Labor candidates and two endorsed Country Liberal 
candidates, which produced two sets of combined primary votes. I had no choice but to keep these results as they were, with single candidate pages for multiple people 
fragmenting results from other elections. The alternative, splitting candidates, was worse for the accuracy of the data. Dividing the number of votes equally across the 
independent candidates would misrepresent the number of votes those candidates received. Giving all votes to an elected independent and setting other independents' 
votes to 0 would be similarly inaccurate. While I had to hand-type the election results for the NT Legislative Council from a book, they were much more granular. 

I made a decision at a fairly late stage during the ACT's data input process to change from representing the ACT Legislative Assembly as a lower house to an upper house. 
This was because I had realised that, despite my efforts recording election order, it wouldn't be possible as the lower house system was boolean in recording whether a 
candidate won or lost, rather than including their place in the order of election if they were successful. The distinction is ultimately arbitrary, as the ACT parliament is 
unicameral. While the name "Legislative Assembly" generally refers to a lower house of single-member electorates, this is not a requirement. The NSW Legislative Assembly had 
proportional representation in the 1920s, and the Victorian Legislative Council had single member electorates until the 2006 election. The Tasmanian Legislative Council still has single-member electorates. 

It was an interesting and instructive process.
</p>





                    </div>

                </div>
    </main>
</body>
</html>
