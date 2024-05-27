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
                        <h1>How Don Camerons (plural) improved AuspolDB.</h1>

<br>
<p>
As I await the next big push for AuspolDB, I've been working away, tuning up parts of the site and the dataset. Yesterday, I was combining duplicate candidates and parties into single pages, 
where appropriate. Today, I did a search to find the pages with the most contests. These are usually people who have the same name being picked up as the same person, or a father and son who 
represent the same seat. At the top of my list today, however, was Donald Cameron, candidate number 8926, with a total of 35 lower house contests (and around 10 upper house contests).
In my effort to disentangle what I expected to be a fairly simple splitting up of pages, led to a 2-hour investigation that not only turned up several more Don Camerons than I expected, but also
 alerted me to a flaw in the federal senate dataset. 
<br><br>
The original <?php
                    echo $this->Html->link(
                        'Donald Cameron',
                        ['controller' => 'Candidates', 'action' => 'view', 8926]
                    );
                    ?>, which contained the description for a different Don Cameron, became the page for the Don Cameron that was member of the House of Representatives for Oxley in the 50s.
 He only contested Oxley, so it was fairly easy to single him out and begin to move the other Don Camerons onto their other pages.

The next (though these are in no particular order) <?php
                    echo $this->Html->link(
                        'Don Cameron',
                        ['controller' => 'Candidates', 'action' => 'view', 37209]
                    );
                    ?> was member for Brisbane and Lilley in the first half of the 20th century. 
After that came, perhaps unsurprisingly, <?php
                    echo $this->Html->link(
                        'Don Cameron',
                        ['controller' => 'Candidates', 'action' => 'view', 37212]
                    );
                    ?>, who was a senator for South Australia in the 70s.
Then, <?php
                    echo $this->Html->link(
                        'Don Cameron',
                        ['controller' => 'Candidates', 'action' => 'view', 37210]
                    );
                    ?> appeared. He was also MHR for Lilley, as the Don Cameron before last had been, though this Don Cameron was a Labor member, while the other was a conservative.
Shortly after, <?php
                    echo $this->Html->link(
                        'Don Cameron',
                        ['controller' => 'Candidates', 'action' => 'view', 10067]
                    );
                    ?> showed up. He was member for Griffith, then Fadden, which he lost in 1983, then Moreton, which he lost in 1990. There were a few issues with the records as to 
whether he won or lost, which I fixed up. 

Before them all, however, at least chronologically, was <?php
                    echo $this->Html->link(
                        'Don Cameron',
                        ['controller' => 'Candidates', 'action' => 'view', 37213]
                    );
                    ?>, who was a Free Trade MHR for the 5-member Division of Tasmania in 1901. I also initially included some conservative 
Tasmanian senate runs under this Don Cameron before I found he had actually died before those runs, which were subsequently filed under <?php
                    echo $this->Html->link(
                        'Don Cameron',
                        ['controller' => 'Candidates', 'action' => 'view', 37218]
                    );
                    ?>. 
                    <br><br>
Before even that Don Cameron, if you could fathom such a notion, was <?php
                    echo $this->Html->link(
                        'Don Cameron',
                        ['controller' => 'Candidates', 'action' => 'view', 37214]
                    );
                    ?>, who was an MLA in Victoria in the 1870s.
To quickly get to the Don Cameron of greatest important to AuspolDB's data integrity, I'll quickly touch on the two other Don Camerons. <?php
                    echo $this->Html->link(
                        'One',
                        ['controller' => 'Candidates', 'action' => 'view', 37216]
                    );
                    ?> ran for the senate in NSW in 1937 for the 
UAP, and <?php
                    echo $this->Html->link(
                        'the other',
                        ['controller' => 'Candidates', 'action' => 'view', 37215]
                    );
                    ?> ran in 1895 for the NSW Legislative Assembly as an independent protectionist.
This leaves us, mercifully, with <?php
                    echo $this->Html->link(
                        'Don Cameron',
                        ['controller' => 'Candidates', 'action' => 'view', 37211]
                    );
                    ?>.
<br><br>
This final Don Cameron, who was a Senator for Victoria, alerted me to something strange. Wikipedia had him as first being elected in 1937, but I found him not contesting in 1937. I investigated,
 and eventually found that my senate data did not match Adam Carr's website. I became quite worried that I was going to have to redo all the senate data again. I found, eventually, that the 
 situation was not as bad as I had thought. The cause for this inaccuracy was a mistake made with the election IDs for certain senate elections. Essentially, at two points, election data had
  become disjointed with the elections they were from. Senate results for 1961 were mistakenly associated with the 1958 election. This pattern of data being 1 election off went on until 1954, 
  when a House of Representatives-only election mercifully knocked the cycle back into place. 
Unfortunately, after that came the half-senate only election of 1953, which knocked the cycle back out of order until 1929's House of Representatives-only election. While the problem seemed 
complicated, it was a simple matter of realigning the election IDs with the correct elections, a few lines of SQL Update statements. After a few incorrect attempts that saw 3 senate election's
 worth of data placed in a single election, all the senate data was returned to the correct place. The final Don Cameron's dates lined up.
So, if I might conclude this post with a plea to the parents of Australia. By all means, encourage your children to pursue a career in politics. Foster their interest in our democratic system 
and the exchange of ideas that are (at least, in theory) intended to work towards a better Australia. I have no issue with that. But if you happen to find yourself naming a baby boy that you 
believe to be a future member of Parliament, and your surname happens to be Cameron, please. Do me a favour. Call him something else. Anything else.

    
    
</p>





                    </div>

                </div>
    </main>
</body>
</html>
