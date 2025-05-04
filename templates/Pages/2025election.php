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
                        <h1>Wander forever the middle warrens</h1>

<br>
<p>
    



Recriminations are underway by those left to recriminate. One group which may escape relatively unrecriminated is the major pollsters. The final polls generally credited Labor with a lead of 52-48. Roy Morgan, long derided as the bounciest and most pro-Labor pollster, was closest with 53-47. The final result is looking more like 54-46. While this isn't as bad as the 2019 error, it is still quite the miss. Interestingly, the factors that brought about this failure appear to be unique. At the 2025 WA state election, Newspoll had Labor on 57.5-42.5, and the result was 57.1-42.9. Newspoll has had a strong track record at the last few state elections and the previous federal election. Yet, at this election, they were a point and a half off. Still within the margin of error, but the history of accuracy indicates that it was not the methodology that was flawed, but instead the singular nature of the contest. I spoke to Liberals beforehand who made repeated reference to the 2010 election, that they would make inroads at this election, before taking back control in a landslide like 2013. This election is not like any in our history, and it may be that the idea of marrying up past performances to future results has been thrown out entirely. The continued rise of the minor party vote, along with the decrease in party loyalty and a rise in "soft voters" may mean that a new era of Australian Politics has been born, with the existing textbook no longer in line with current thinking. 
<br><br>
The Greens, commentators suggest, have had a bad election. This idea is largely founded on the idea that four seats is more than two seats. While this numeracy is to be commended, it is overly simplistic. The Greens could have won ten seats at this election and it would not have mattered, in terms of how the dynamic in the Reps will play out. In fact, the defeat of supposedly divisive figures like Max Chandler-Mather may do the party good in the long-term. Meanwhile, the scale of Labor's victory has meant that the Greens' position has been greatly improved, despite their seat count not changing. Labor and the Greens (at the time of writing) may constitute a majority in the Senate on their own, without any other crossbenchers. The Senate will become a 3-party chamber, with the remaining crossbench, like the Reps crossbench, utterly powerless. I had expected a good showing for One Nation in the Senate, but it seems that has largely been extinguished by third Labor senators in most states.
<br><br>
When the Liberals lost in 2022, many articles came out asking if the Liberal party was done as an election force. In 2024, when the Liberal party returned to an election-winning position in the polls, these articles were dug up, as were similar articles from after the 2007 election. As we have seen, a 2024 election may have not been the Liberal win the polls were predicting anyway. It is difficult to say what the April 12 election, which was in the middle of the tariff period, would have produced. Ultimately, we are in the universe we are in. The Liberals have been defeated again, and articles have been written about the end of the Liberal party. The cycle continues. Is the Liberal party actually done? Hard to say. They could just start doing things right. They probably won't, but they could. A party like Reform in the UK could appear and attempt a hostile takeover of the centre-right mantle. While Australia's electoral system is better placed than the UK for this to happen, there isn't a similar personality (if one could refer to Nigel Farage in such a manner) capable of mounting a serious challenge to the Liberals' existence. The Liberals won't win the next election, and the state of the Senate means that there would be no point of them doing so, anyway. David Pocock's control of the ACT is a problem that the Liberals haven't addressed, and have, in fact, made far worse. While Pocock continues to exist, in the current system, the Liberals will need an election like Labor just had in order to give the Right control of the Senate. 
<br><br>
It was certainly Labor's night. Such a result exceeded expectations in many places, including places no one was expecting. Perhaps the electorate has awoken to the reality that the squeaky seat gets the pork from the barrel? The idea that Queenslanders back a leader from their state has surely been put paid to now. Every single electorate in Queensland had a primary vote swing against the LNP. Labor will have the strength of enormous resources at their disposal in future campaigns. Nobody wants to donate to a campaign that can't win, so the campaign doesn't win because they have no money. This was seen at the 2025 WA election. The government have signalled that this will be an immensely dull term. Does success breed complacency? The WA parliament since 2021 would indicate so, however WA Labor never had an election like 2019 inflicted on them. A situation in which only one party is viable is dangerous. 
<br><br>
Much of psephologists' time is spent answering the question "What will happen next?". Will things go back to normal? The minor party and independent vote's continuing rise would suggest not. In fact, it suggests that things will become exponentially less normal as time goes on. Isn't that exciting?

</p>




                    </div>

                </div>
    </main>
</body>
</html>
