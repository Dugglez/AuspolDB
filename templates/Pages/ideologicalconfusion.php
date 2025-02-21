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
                        <h1>When ideology and electoral efficacy clash</h1>
                    

<br>
<p>
    The second-gravest mistake a political movement can make is assuming the status quo will be undisturbed indefinitely. The gravest 
    mistake a political movement can make is, once the status quo has been disturbed, failing to change its ways to survive in that new status quo.

    <br><br>

    I was spurred into writing this piece after the announcement that Trumpet of Patriots, a political party now playing host to billionaire Clive Palmer,
     would be contesting seats across Australia at the next Federal election. Clive Palmer is not an efficacious political operator. While he has 
     invested a fortune in various campaigns over the last decade, it is impossible to point at a real impact he has had on the laws and governance of Australia. 
     The impact Palmer's ventures have had lie largely in agenda-setting and the flow of his parties' preferences. While Palmer shuts up shop after an election, 
     other right-wing minor parties continue working. Trumpet of Patriots has sown irritation in this crowd, and for good reason. Palmer running makes life more difficult for them 
     than it already is. The Libertarians (formerly Liberal Democrats) have been particularly outspoken about the need for unity within the minor-right parties, 
     and even proposed a coalition-style Senate system where different minor-right parties would get first place on a combined ticket in different states. 
     Such a proposal could, as the Greens did to Labor, reduce the Liberals from 3 Senate seats in most states in a half-senate election to 2. 
     The deal, however, was shunned by most of the minor-right parties, for reasons that were perhaps as ideological as they were personal. 
     Both the Libertarians and Clive Palmer (who allegedly also offered a $10 million signing bonus) offered to combine forces with Pauline Hanson's One Nation. 
     In both instances, the offer was rejected. Hanson has been in charge of One Nation for nearly 30 years now, and the party's constitution makes her president for life. 
     Hanson simply will not give over total control to anyone. Though the left has its competing minor parties, like Animal Justice, the Victorian Socialists 
     and Legalise Cannabis, the left-of-Labor vote mostly coalesces around the Greens. The Greens have a proper branch structure, continue working between elections and 
     have secured their place in the Senate after the abolition of the Group Voting Ticket in 2016. 
     
     <br><br>
     Under the GVT, minor-right parties could compete with each other with impunity, 
     as their preferences were almost always controlled by a ticket from voting above the line. Now, however, this model is unworkable. 
     Every additional minor-right party offers another opportunity for their vote to dwindle away from exhaustion, until eventually a major party bests them in the final count. 
     Add up the minor-right (PHON, UAP, LD, AC, SFF) votes at the 2022 Senate election, and in the mainland states, their vote generally reaches or exceeds 9%, putting them in contention for the last seat in most states. 
     As it stands, however, they will continue to hold themselves back from electoral success. Obviously, the issue is not all personality-driven. 
     The ideologies of these parties do not always marry up. The foundational disagreement of conservatism in Australia, that of Protectionism vs Free Trade, finds itself reborn, 
     with One Nation being protectionist and the Libertarians favoring free trade. Similarly, issues of free speech have been raised in the last parliament, 
     with One Nation backing hate speech laws while much of the minor-right has opposed them. Fundamentally, the minor-right's broad individualism makes the 
     collectivist act of teaming up an unnatural one. Their instinct is to compete, but without the Group Voting Ticket, this competition is in vain.
     
     <br><br>
     If a minor-right alliance were ever to come into existence, the caucus solidarity of its elected members would not be lauded. Their tendency to act as individuals, 
     while noble in its ideological purity, mean that it will be easier for governments, particularly Liberal governments, to pick them off and earn support for their legislation. 
     The Senate presently is in no state for a conservative government. If a Coalition government were installed at the next election, a double dissolution in 2026 
     (after the new electoral financing laws take effect) would be quite likely, as the progressive makeup of the Senate would make passage of conservative legislation near impossible. 
     If a united right-of-the-Liberals force contested that double dissolution, which could produce a more conservative Senate, they could become the legislative kingmakers of the subsequent parliament. 
     Personalities and ideology will, however, prohibit this.
</p>





                    </div>

                </div>
    </main>
</body>
</html>
