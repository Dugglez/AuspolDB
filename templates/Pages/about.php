<?php ?>
<div class="container text-center"></div>
<main class="main">
    <div class="container">
        <div class="content">

            <div class="row">
                <div class="column">
                    <h1>About</h1>
                    <p>AuspolDB, in time, aims to be a publicly-accessible, free and open-source database
                    of Australian Electoral data. This project began when I went on the Tally Room forums and was
                        posed with a question: “Has a Federal election ever been held in the same
                        month as a state election?” I thought “There must have been”. I luckily knew where
                        I would easily be able to find my answer, as Wikipedia has
                        <a href="https://en.wikipedia.org/wiki/Timeline_of_Australian_elections" target="_blank">a
                            timeline of state and federal elections</a>. Then the idea hit me. Hovering over each
                        election and comparing the months manually took a bit of time. If I could query a
                        database that had all this information, I could have answered it so much quicker.
                        Not only that, but it has the advantage over Wikipedia's records (which, like AuspolDB,
                        are sourced from Adam Carr's<a href="http://psephos.adam-carr.net/countries/a/australia/" target="_blank"> election archive</a>)
                        that it can be searched and filtered through. Certainly, with both sites you could find all the results in an electorate,
                        or find where a particular elected MP ran in a particular year, but it would be far more difficult
                        to find Wilhelm Kapphan using Wikipedia than it was using AuspolDB.

                        <?php
                        echo $this->Html->link(
                            'Wilhelm Kapphan ',
                            ['controller' => 'Candidates', 'action' => 'view', 10315]
                        );
                        ?>
                        ran in four separate Victorian divisions in the 1980 Federal election, as well as for the senate in Victoria.
                        He was not successful in any of his five contests. It appears he
                        <a href="https://companieshouse.com.au/the-trustee-for-wilhelm-kapphan-11453040613" target="_blank">died in 2016. </a>
                        Why did he do this? We may never know, but at least we now know that it happened. There are
                        sure to be more mysteries to be discovered in the election data.
                        This site was built using CakePHP 4, and the data is stored on a MySQL database.

                        If you consider yourself technically inclined, you can download the dataset if you'd like to
                        manipulate it in ways I hadn't considered, or just to run SQL statements on it. AuspolDB's
                        dataset and source code is available on GitHub.
                        <a href="https://github.com/Dugglez/AuspolDB" target="_blank"> You can find the GitHub repository here.</a>

                    </p>
<br>
                    <p>
                       As for myself, I'm dugglez. I've got a keen interest in Australian politics, history
                        and psephology. As you may have gathered, I also have a background in development.
                        It's good to keep your skills and knowledge current, so when I came up with the idea
                        after having not written much code for a few months, I was glad to have something to
                        practice with.
                        In my spare time, I sometimes produce documentaries on Australian politics and history.
                        <a href="https://www.youtube.com/dugglez" target="_blank"> You can find my Youtube Channel here.</a>
                        You can write to me at dugglez@auspoldb.org

                    </p>
                    <br>
                    <div style="text-align: center;">
                        <img src="/webroot/img/DUGGLEZ.jpg" alt="DUGGLEZ" style="max-width: 100%; max-height: 100%;">
                       <br> dugglez
                    </div>


                </div>

            </div>
</main>
