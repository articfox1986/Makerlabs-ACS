{include file="header.tpl"}
        <!-- Make sure all your bars are the first things in your <body> -->
        <header class="bar bar-nav">
            <h1 class="title">Time Slots</h1>
        </header>
        {include file="menu.tpl" isAdmin=$isAdmin menuSelected=$menuSelected}
        <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
        <div class="content">
            <div class="card">
            <ul class="table-view">
                    <li class="table-view-cell">
                        <a class="navigate-right" href="timeslotEdit.php?day=Monday" data-transition="slide-in">Monday</a>
                    </li>
                    <li class="table-view-cell">
                        <a class="navigate-right" href="timeslotEdit.php?day=Tuesday" data-transition="slide-in">Tuesday</a>
                    </li>
                    <li class="table-view-cell">
                        <a class="navigate-right" href="timeslotEdit.php?day=Wednesday" data-transition="slide-in">Wednesday</a>
                    </li>
                    <li class="table-view-cell">
                        <a class="navigate-right" href="timeslotEdit.php?day=Thursday" data-transition="slide-in">Thursday</a>
                    </li>
                    <li class="table-view-cell">
                        <a class="navigate-right" href="timeslotEdit.php?day=Friday" data-transition="slide-in">Friday</a>
                    </li>
                    <li class="table-view-cell">
                        <a class="navigate-right" href="timeslotEdit.php?day=Saturday" data-transition="slide-in">Saturday</a>
                    </li>
                    <li class="table-view-cell">
                        <a class="navigate-right" href="timeslotEdit.php?day=Sunday" data-transition="slide-in">Sunday</a>
                    </li>
            </ul>
            </div>
        </div>
{include file="footer.tpl"}