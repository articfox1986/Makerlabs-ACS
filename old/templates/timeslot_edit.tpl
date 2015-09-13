{include file="header.tpl"}
<!-- Make sure all your bars are the first things in your <body> -->
<header class="bar bar-nav">
    <a href="timeslots.php"><button class="btn pull-left">Back</button></a>
    <a href="javascript: submitform()"><button class="btn pull-right" type="submit">Save</button></a>
    <h1 class="title">Edit Timeslot</h1>
</header>
{include file="menu.tpl" isAdmin=$isAdmin menuSelected=$menuSelected}
<!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
<div class="content">
    <form class="input-group" name="editForm"  METHOD=POST enctype="multipart/form-data" ACTION="{$url}">
        <input type="hidden" name="submitted" value="1">
        <div class="input-row2">
            <label>00:00 - 01:00</label>
                    <!--<div class="toggle-handle {if $timeslots['0'] == 1}active{/if}">-->
            <input type="checkbox" name="0" value="1" {if $timeslots['0'] == 1}checked="checked"{/if}>
            <!--<div class="toggle-handle"></div>
        </div>-->
        </div>
        <div class="input-row2">
            <label>01:00 - 02:00</label>
            <input type="checkbox" name="1" value="1" {if $timeslots['1'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>02:00 - 03:00</label>
            <input type="checkbox" name="2" value="1" {if $timeslots['2'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>03:00 - 04:00</label>
            <input type="checkbox" name="3" value="1" {if $timeslots['3'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>04:00 - 05:00</label>
            <input type="checkbox" name="4" value="1" {if $timeslots['4'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>05:00 - 06:00</label>
            <input type="checkbox" name="5" value="1" {if $timeslots['5'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>06:00 - 07:00</label>
            <input type="checkbox" name="6" value="1" {if $timeslots['6'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>07:00 - 08:00</label>
            <input type="checkbox" name="7" value="1" {if $timeslots['7'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>08:00 - 09:00</label>
            <input type="checkbox" name="8" value="1" {if $timeslots['8'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>09:00 - 10:00</label>
            <input type="checkbox" name="9" value="1" {if $timeslots['9'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>10:00 - 11:00</label>
            <input type="checkbox" name="10" value="1" {if $timeslots['10'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>11:00 - 12:00</label>
            <input type="checkbox" name="11" value="1" {if $timeslots['11'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>12:00 - 13:00</label>
            <input type="checkbox" name="12" value="1" {if $timeslots['12'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>13:00 - 14:00</label>
            <input type="checkbox" name="13" value="1" {if $timeslots['13'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>14:00 - 15:00</label>
            <input type="checkbox" name="14" value="1" {if $timeslots['14'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>15:00 - 16:00</label>
            <input type="checkbox" name="15" value="1" {if $timeslots['15'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>16:00 - 17:00</label>
            <input type="checkbox" name="16" value="1" {if $timeslots['16'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>17:00 - 18:00</label>
            <input type="checkbox" name="17" value="1" {if $timeslots['17'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>18:00 - 19:00</label>
            <input type="checkbox" name="18" value="1" {if $timeslots['18'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>19:00 - 20:00</label>
            <input type="checkbox" name="19" value="1" {if $timeslots['19'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>20:00 - 21:00</label>
            <input type="checkbox" name="20" value="1" {if $timeslots['20'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>21:00 - 22:00</label>
            <input type="checkbox" name="21" value="1" {if $timeslots['21'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>22:00 - 23:00</label>
            <input type="checkbox" name="22" value="1" {if $timeslots['22'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>23:00 - 00:00</label>
            <input type="checkbox" name="23" value="1" {if $timeslots['23'] == 1}checked="checked"{/if}>
        </div>
        <!--<button type="submit" class="btn btn-positive btn-block">Save</button>-->
    </form>
</div>
{include file="footer.tpl"}