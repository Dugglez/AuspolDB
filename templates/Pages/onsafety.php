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
                        <h1>On Safety</h1>

<br>
<p>
Recently, I've been considering the notion of "safety" in regards to lower house seats. A  <a href="https://www.aec.gov.au/Elections/federal_elections/2022/files/downloads/fact-sheet-national-seat-status-2022-federal-election.pdf">fact sheet</a> from the Australian Electoral Commission defines the levels of safety as follows:
<br><br>
- Marginal (M): when the leading party receives less than 56 per cent of the TPP vote <br>
- Fairly Safe (FS): when leading party receives between 56-60 per cent of the TPP vote<br>
- Safe (S): when a leading party receives more than 60 per cent of the TPP vote.<br><br>

At the 2022 Federal election, in seats where a Coalition candidate was defeated by a Labor candidate (no Labor candidates were defeated by Coalition candidates), the safety of these seats before the election 
according to the AEC was 8 marginal, 2 fairly safe and 0 safe. In seats where the Coalition was defeated by a non-Labor candidate, however, the numbers are 1 marginal, 5 fairly safe and 2 safe. Labor, though 
coming into government, also lost two seats, 1 marginal and 1 safe.<br><br>

My point in making note of these losses is to ask whether the AEC's definition of safe is still fit for purpose in today's political environment. At the 2022 election, 3 safe seats were lost. This also happened 
at the 2016, 2013 and 2010 elections. The next most recent example I can find is 1961. Between 1946 and 1954, one safe seat was notionally lost (St George, 1949. I do not count McPherson in 1949 as the Liberals did not run). 
Some possible explanations for this change in how accurate "safety" is include the political effects of the COVID-19 pandemic and lockdowns, demographic changes in both voters' countries of origin and the size of age cohorts, 
as well as changing campaign strategies, such as in the seat of Griffith, where the Greens won after knocking on every door in the seat.
Given the increasing frequency with which seats that are supposedly "safe" are being lost, perhaps the requisite margin for being considered safe should be increased to take into account the increased volatility of the electorate? 
<br><br>

If we take a look at recent state election landslides (which are administered by state electoral commissions, not the AEC), we can see that the AEC's definition of safety is equally inappropriate. 
At the 2021 WA election, the opposition lost 3 safe seats. This was due to most of their traditionally safe seats having already had their status downgraded after the 2017 election to marginal. 
The WA Liberals and Nationals, between 2017 and 2021, lost 22 seats that were safe prior to the 2017 election. 
At the 2012 Queensland election, Labor lost 6 safe seats (and Independent Chris Foley lost his safe seat). At the 2011 New South Wales election, 
Labor lost 15 safe seats.
<br><br>
The matter is further complicated when considering three-cornered constests, or, as I recently learned the French call it, "triangulaires" (which we should start saying). The Docklands seat of Macnamara is, in 
two-party preferred terms, a safe Labor seat. However, consider the three-candidate preferred vote (the second-last count of votes before the final exclusion, which gives us the winner)
 in Macnamara at the 2022 Federal election:
<br><br>
Liberal: 33.67%<br>
Labor: 33.48%<br>
Greens: 32.84% <br><br>

As Labor was ahead of the Greens at this stage of the count, the Greens' preferences were distributed, overwhelmingly favouring Labor and allowing them to win the seat convincingly against the Liberals. The difference, 
however, between the Labor and Green vote is only 0.64 percentage points, or around 600 votes.
If the Green vote was even a little bit higher, Labor would slip into third place, causing their preferences to be distributed instead, leading to a Greens victory. Obviously, the chance of a Liberal 
victory in Macnamara would require a large swing, meaning the seat is "safe" against a Liberal candidate. Yet, there is nothing to indicate that, if the Labor vote was 0.65 percentage points lower, they would lose.
In that sense, the seat is intensely marginal. For those who simply see a 10% margin next to Macnamara on the Mackerras pendulum, there is nothing to signify the marginality of another kind that the seat experiences.
<br><br>
While it is not the AEC's fault that seats that were safe are being lost, more accurate metrics of safety would help the average voter to better understand the state of their electorate (and, perhaps, inform their vote). 
How, then, should the AEC determine what is safe and what is marginal? It is clear that present definitions based solely on the two-candidate/party-preferred vote are flawed, for the reasons I've outlined above. 
Independent MHR Zali Stegall holds the division of Warringah on a margin of 10.92%, in the same "safe" bracket as Macnamara, as well as Cowan in WA, which changed hands as recently as 2016. A system which defines 
the safety of electorates should take into account the nature of the current member (as independent candidates, once they have built a personal vote, tend to survive landslide elections better than major party members),
the trends present in the electorate and the electoral history of the area. On the other hand, perhaps this is not the business of the AEC. Perhaps this deeper analysis should be left to organisations like the ABC.
Despite the notion of electorates being safe or fairly safe was wrong in 10 cases at the last federal election, the other 141 cases were correctly described, as marginal seats were held or lost as they should be, 
and other safe/fairly safe seats were retained (the 2022 Federal election was also unusual for several reasons). 



<br><br>
 

    
    
</p>





                    </div>

                </div>
    </main>
</body>
</html>
