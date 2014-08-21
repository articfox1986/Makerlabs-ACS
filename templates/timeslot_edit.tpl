{include file="header.tpl"}
<!-- Make sure all your bars are the first things in your <body> -->
<header class="bar bar-nav">
    <a href="admin.php"><button class="btn pull-left">Back</button></a>
    <a href="javascript: submitform()"><button class="btn pull-right" type="submit">Save</button></a>
    <h1 class="title">Edit Timeslot</h1>
</header>
{include file="menu.tpl" isAdmin=$isAdmin menuSelected=$menuSelected}
<!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
<div class="content">
    <form class="input-group" name="editForm"  METHOD=POST enctype="multipart/form-data" ACTION="{$url}">
        <div class="input-row2">
            <label>00:00 - 01:00</label>
                    <!--<div class="toggle-handle {if $timeslot['0'] == 1}active{/if}">-->
            <input type="checkbox" name="enable" value="0" {if $timeslot['0'] == 1}checked="checked"{/if}>
            <!--<div class="toggle-handle"></div>
        </div>-->
        </div>
        <div class="input-row2">
            <label>01:00 - 02:00</label>
            <input type="checkbox" name="enable" value="1" {if $timeslot['1'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>02:00 - 03:00</label>
            <input type="checkbox" name="enable" value="2" {if $timeslot['2'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>03:00 - 04:00</label>
            <input type="checkbox" name="enable" value="3" {if $timeslot['3'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>04:00 - 05:00</label>
            <input type="checkbox" name="enable" value="4" {if $timeslot['4'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>05:00 - 06:00</label>
            <input type="checkbox" name="enable" value="5" {if $timeslot['5'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>06:00 - 07:00</label>
            <input type="checkbox" name="enable" value="6" {if $timeslot['6'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>07:00 - 08:00</label>
            <input type="checkbox" name="enable" value="7" {if $timeslot['7'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>08:00 - 09:00</label>
            <input type="checkbox" name="enable" value="8" {if $timeslot['8'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>09:00 - 10:00</label>
            <input type="checkbox" name="enable" value="9" {if $timeslot['9'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>10:00 - 11:00</label>
            <input type="checkbox" name="enable" value="10" {if $timeslot['10'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>11:00 - 12:00</label>
            <input type="checkbox" name="enable" value="11" {if $timeslot['11'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>12:00 - 13:00</label>
            <input type="checkbox" name="enable" value="12" {if $timeslot['12'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>13:00 - 14:00</label>
            <input type="checkbox" name="enable" value="13" {if $timeslot['13'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>14:00 - 15:00</label>
            <input type="checkbox" name="enable" value="14" {if $timeslot['14'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>15:00 - 16:00</label>
            <input type="checkbox" name="enable" value="15" {if $timeslot['15'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>16:00 - 17:00</label>
            <input type="checkbox" name="enable" value="16" {if $timeslot['16'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>17:00 - 18:00</label>
            <input type="checkbox" name="enable" value="17" {if $timeslot['17'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>18:00 - 19:00</label>
            <input type="checkbox" name="enable" value="18" {if $timeslot['18'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>19:00 - 20:00</label>
            <input type="checkbox" name="enable" value="19" {if $timeslot['19'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>20:00 - 21:00</label>
            <input type="checkbox" name="enable" value="20" {if $timeslot['20'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>21:00 - 22:00</label>
            <input type="checkbox" name="enable" value="21" {if $timeslot['21'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>22:00 - 23:00</label>
            <input type="checkbox" name="enable" value="22" {if $timeslot['22'] == 1}checked="checked"{/if}>
        </div>
        <div class="input-row2">
            <label>23:00 - 00:00</label>
            <input type="checkbox" name="enable" value="23" {if $timeslot['23'] == 1}checked="checked"{/if}>
        </div>
        <!--<button type="submit" class="btn btn-positive btn-block">Save</button>-->
    </form>
</div>
{include file="footer.tpl"}