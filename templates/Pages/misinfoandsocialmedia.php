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
                        <h1>Misinformation and Social Media Ban Bills</h1>

<br>
<p>
    I recently wrote the following pieces on two bills of public interest, the Communications Legislation Amendment (Combatting Misinformation and Disinformation) Bill 2024 and the Online Safety Amendment (Social Media Minimum Age) Bill 2024.
    This is off-topic for this site, but as the intended avenue for making my views public was not available, I feel I shouldn't let these go to waste. Also, I intend to insert the data for the 2024 Queensland election soon.
    <br><br>
    Here is the piece on Misinformation:
        <br><br>
        “Nothing beside remains. Round the decay 
Of that colossal Wreck, boundless and bare 
The lone and level sands stretch far away.” 
<br><br>
The conclusion of Shelley’s Ozymandias encapsulates the entropic nature of our world and the futility of seeking to immortalise oneself. The monument to the titular ruler lies decayed, unmaintained and, most importantly, unremembered. The urge to be remembered consumes many people. In the same sense that, despite his efforts to commemorate himself, Ozymandias is eventually forgotten, truth, or what we hold to be truth, is often replaced with new versions of the truth, or discarded entirely. Long ago, the Aztecs knew that, at the end of a calendar cycle, a human sacrifice must be made in order for the sun to rise the next morning. It was this sun, Catholic doctrine held, that revolved around the Earth, and any suggestion to the contrary was heretical. In 1855, the General Board of Health in the United Kingdom, a statutory body of eminent public health experts, rejected a theory of the cause of the rapid transmission of cholera at that time. The board’s preferred theory centered around the idea of ‘miasma’, contaminated air that was spreading the disease. The outlandish suggestion proposed by Dr. John Snow that the outbreak had been caused by unclean water or contact with infected persons later contributed to the ‘germ theory’ of disease, which informs epidemiological thought today.  

<br><br>

If Dr. Snow had posted on Victorian-era X (formerly Twitter) about his research, would his ideas have been captured under section 14(b) of this bill as constituting a possible harm to public health? It could be argued that the exception listed under section 16(1)(c) for dissemination of information for scientific purposes may apply, but as a government body, the General Board of Health, had already decided that his theory was nonsensical, Victorian-era X (formerly Twitter) would err towards removing the problematic material, lest it incur a substantial fine under the civil penalty provisions of this bill for failing to comply with the misinformation code or standard. Herein lies the problem at the core of this bill. Online platforms, averse to being fined as much as 5% of their annual turnover, will become overly censorious in order to comply with any directive given to it by ACMA and, by extension, the <?php
                    echo $this->Html->link(
                        'Minister',
                        ['controller' => 'Candidates', 'action' => 'view', 772]
                    );
                    ?> and the government. As a result, users of these services will eschew public debate and take their discussions to places this bill cannot reach, like private messages, smaller group chats and overseas-hosted websites that will not enforce the misinformation code. Without the scrutiny that having these debates in public arenas offers, the retreat into private echo chambers will mean genuine misinformation and disinformation will go unchallenged and increase the risk of that misinformation and disinformation causing serious harm, which this bill ironically aims to prevent.  

<br><br>

There is nothing wrong with having a code for online platforms regarding misinformation that addresses things like managing the risk of misinformation, handling complaints and fostering media literacy. The latter is perhaps the most important element, and is a genuine pathway to addressing the challenge of mis and disinformation. Moving past the absolute of ‘don’t trust anything you read online’, users’ ability to consider who is saying something and what may be motivating them to say it is imperative in helping them separate the noise from the reality of a situation.  

<br><br>

Of course, there are also external factors at play, factors that can’t be neutralised by a code or a standard. Our society is becoming more polarised, as competing views are shut out. Social Media platforms collect massive amounts of data on how their users interact with them, and they have drawn the conclusion that the best way to keep their users on their site for as long as possible, to present as many ads to them as possible, is to show them what they already know, and what they already agree with. These algorithms also incentivise and promote content that generates an emotional reaction, so a disinterested, objective analysis of the facts of a situation will often find itself buried under a pile of truth-agnostic catalysts of fury, or of sadness, or, on rare occasion, of joy.  

<br><br>

If surety was traded on the ASX, its all-time high would have been many years ago, with the ailing stock now a shadow of its former self. International conflict, declining living standards and poor economic tidings have led a majority of Australians to believe that the country is heading in the wrong direction. For many Australians, the harsh reality of daily life and failure of societal institutions to address it is eroding public trust in our system of government. An Essential Poll in March found that just 32% of Australians were satisfied with the functioning of our democracy. Why the Government would then seek to impose itself, through ACMA, as an arbiter of online speech when trust in it is so low is beyond me. In fact, the original draft of the bill sought to exempt politicians from the requirements. Couple that with the retained section 68, which dictates the circumstances under which the <?php
                    echo $this->Html->link(
                        'Minister',
                        ['controller' => 'Candidates', 'action' => 'view', 772]
                    );
                    ?> may direct ACMA to investigate a particular issue, the potential for ministerial interference and intervention in the operation of this bill is obvious.  

<br><br>

To return to the idea of ‘serious harm’, we find that much of this section is covered by other acts already. Section 14(a) would seem to largely be addressed by section 329(1) of the Commonwealth Electoral Act, which lists as an offence the publication of material which is “likely to mislead or deceive an elector in relation to the casting of a vote”. Any other matters, like accusations of election-rigging or the importation of American-style arguments of Dominion voting machines and the like are best dealt with in a public arena, which the AEC’s disinformation register and social media team do a fine job at, or, if necessary, the Court of Disputed Returns. The alarming suggestion that this section would capture content that makes political statements during campaigns, and perhaps remove or throttle that content, could constitute an attack on the implied right to freedom of political communication. Similarly, section 14(c), which looks at the various forms of discrimination against a person or group of people, is largely (but not entirely) addressed by the Racial Discrimination Act and the Sex Discrimination Act.  

 <br><br>

Misinformation and Disinformation are dangerous. In a time where information is being presented for consideration with such velocity and volume as to make every news event and report worthy of suspicion, especially with regard to unfolding events, the pause required to give thought to who is presenting you with this information and what agenda they may have is not always available. This bill in its current form, however, is not the answer. Voluntary programs, such as X (formerly Twitter)’s Community Notes, are often effective in addressing misinformation and disinformation. Through Community Notes, members of the community with the time and knowledge can assess the veracity and origin of a particular post and then present their view to the rest of the community who do not have the time or knowledge. The risk of forcing platforms to crack down on suspected misinformation and disinformation could lead to these ideas moving underground, where no regulation or oversight from the wider community creates the hazard of this misinformation and disinformation going offline and having real world effects. The public response to this bill has been considerable. We saw reasoned submissions, during the very short consultation period the government allocated to this bill, from groups like the Victorian Bar, the Australian Electoral Commission and the Australian Human Rights Commission that outlined grave concerns they had with the bill. Outside of the government, there are almost no supporters of the bill as it is currently drafted. While there are some who support the idea of the bill, this support is always qualified with various requests for amendment. Like the Help to Buy bill and the social media ban, the government has identified a problem but proposed the wrong solution. This is a bill that the government has failed to adequately consult on, and one which they must throw out and redraft to address the criticism it has received. 
<br><br><br><br>
Here is the piece on the Social Media ban:
<br><br>
We are a prohibitive nation. We have outlawed books, films and video games that offend some of us. In 2007, Cricket Australia issued an edict to put a stop to the ‘Mexican Wave’, an action which inadvertently saw an uptick in the heinous practice. For a time in 2011, the Rann government considered a law forbidding the then-popular act of ‘planking’, where one would lie flat on an unusual surface. Surprisingly, one of the few things we have, by and large, left alone, is alcohol. Some states, particularly New South Wales, tried and failed to enforce temperance on their people. The first state’s third attempt to do so began with the election of the Fuller government in 1922, when incoming conservative Minister for Justice <?php
                    echo $this->Html->link(
                        'Thomas John Ley',
                        ['controller' => 'Candidates', 'action' => 'view', 34753]
                    );
                    ?> was swept into government on a conspicuously high primary vote, which he owed to the support of the temperance movement. “Lemonade Ley”, as the teetotal minister was known, had promised them a referendum on alcohol, and they had burnt the midnight oil getting him returned as one of the 5 members for St George, where he topped the poll. After a year spent dithering, Ley would announce that a plebiscite, rather than a referendum, would be held in five years’ time. The wait, Ley said, would allow the temperance movement to build public support for the plebiscite. Instead, the movement cannibalised itself, and the plebiscite was resoundingly defeated in 1928. Allegations of having taken money from liquor interests orbited Ley, who would be convicted of murder in England some years later and suspected of at least three more killings. The lesson there being, don’t trust a bloke who doesn’t drink. 

<br><br>

In the United States, however, there was the famous ‘prohibition’ period in the 1920s and early 1930s. Famously, no one drank alcohol at all during those years, except for the wealthy who stockpiled alcohol before the ban for private consumption, which was mysteriously still legal, while those not as well off were able to benefit from the burgeoning criminal enterprise of bootlegging. The most destitute drank industrial alcohols like ethanol, but the US government saw to this by mandating the denaturation of ethanol, making alcohol poisonous and killing as many as 10,000 people. So, in summary, everyone who wanted to drink alcohol still could, it just went underground and, for some, became more dangerous. And so we come to the Online Safety Amendment (Social Media Minimum Age) Bill 2024, the latest straw so desperately clutched at by the flailing Albanese government. This is a government so patently concerned with the cost of living that it has pushed aside any actual policies that will address the number one issue in voters’ minds in favor of this utter thought bubble of a bill.   
<br><br>
 

Let’s start with the most obvious problem. Governments of all stripes have, for decades, struggled to keep pace with technological innovation. The only exceptions are when our law enforcement agencies need new powers to “keep us safe”, such as the Assistance and Access Act of 2018 and the Identify and Disrupt Act of 2021, which both passed with bipartisan support, of course. Far from compelling access to encrypted data or allowing police to take over your Instagram, however, this bill seeks to put the social media genie back in the bottle. Once this bill passes, the government suggests, the world will revert to a time before social media, those far-flung days of yore when the <?php
                    echo $this->Html->link(
                        'Prime Minister',
                        ['controller' => 'Candidates', 'action' => 'view', 107]
                    );
                    ?> made crazy, unequivocal statements like “an independent Palestinian state must be established” and “I am concerned at the possibility that tax exempt funds from Australia are being used to assist settler groups”. In this world, the utterance of neologisms like ‘doomscrolling’ and ‘bed-rotting’ in front of a young person would be met with a confused tilt of the head and an invitation to kick the footy around at the park. “Parents want their kids off their phones and on the footy field”, our mature, statesmanlike <?php
                    echo $this->Html->link(
                        'Prime Minister',
                        ['controller' => 'Candidates', 'action' => 'view', 107]
                    );
                    ?> of today says, a man in a ‘Twilight Zone’-style situation of simultaneously being as focus-grouped as he is out of touch. One thing he is in touch with, however, is how he is going to pass this legislation, with the help of the architects of the NCN, the National Copper Network, the Liberal and National parties. 
<br><br>
 

From the day the first parental controls were configured on a computer, kids have been breaking through them and going around them. From giving false ages and disingenuously ticking boxes that say “I am 18 years of age or older” to using VPNs to get around the school firewall, the traditional measures taken to control internet access for children have been largely ineffective. This ineffectiveness led the government to the choice between an honour system, which will make the ban essentially voluntary, and an authentication system that, while increasing the effectiveness of the ban, has many other pitfalls. InnovationAus reported that in September, “biometric age estimation, email verification processes and device or operating-level interventions” were being looked at as options, so different types of data will have to be processed by websites of varying security. As we have seen with repeated data breaches in recent years, we should be decreasing the amount of data websites need to record, not increasing it.  
<br><br>
 

This bill also gives no consideration to the benefit that social media provides. While being connected to everyone else on Earth is a dubious aspect of the internet, it also allows friends and family to keep in touch, as well as providing an outlet for creative expression and the exchange of ideas. There is also the educational element, as resources like YouTube provide free, high-quality content which has become an invaluable part of teaching and learning in recent years. The loss of YouTube would mean forcing schools back to antiquated and paid platforms like ClickView.   
<br><br>
 

Now, I do not for a moment pretend that social media is a harmless technology. Youth suicide has been trending upward for years and is the leading cause of death for Australians aged 15 to 24. There is no doubt that social media has its part to play in this. The increased interconnectedness provided by social media has made bullying and harassment convenient and easy to propagate. Issues of self-image, self-confidence and comparing one’s life to others don’t just affect kids, but the vulnerable, developing minds of children are especially susceptible to online torment. What is needed is a consultative, comprehensive solution which has the requisite nuance to actually address the problems posed by social media. This bill is a blunt and uninformed pre-election vote-buying exercise aimed at the mums and dads of Australia who are rightly concerned about a real issue. It is a policy that is easy to understand and sounds good on the face of it, but falls flat when held up to any half-serious scrutiny. When someone drowns, we do not outlaw water. We may put fencing up around the pool or tell people to swim between the flags where lifeguards can see them, but we do not fill the pool in with concrete or lay landmines along Scarborough Beach. What the government should do is take this bill off the notice paper and then consult with the community and experts to develop sound policy that helps kids to deal with the problems social media presents. Unfortunately, this bill will become law, but I have faith that the children of Australia will reject the <?php
                    echo $this->Html->link(
                        'Prime Minister',
                        ['controller' => 'Candidates', 'action' => 'view', 107]
                    );
                    ?>’s bulldozing legislation and, like the Prohibition-era bootleggers and speakeasies, or sly-grog shops as we would say in Australia, circumvent it with such frequency as to embarrass the government into repealing it and going back to the drawing board.  

</p>





                    </div>

                </div>
    </main>
</body>
</html>
