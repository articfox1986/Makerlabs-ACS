{include file="header.tpl"}
        <!-- Make sure all your bars are the first things in your <body> -->
        <header class="bar bar-nav">
            <h1 class="title">MakerLabs Access Control</h1>
        </header>
        {include file="menu.tpl" isAdmin=$isAdmin menuSelected=$menuSelected}
        <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
        <div class="content">
            
            <FORM METHOD=POST enctype="multipart/form-data" ACTION="{$url}">
                <!--Access Token: <input type="text" name="my_access_token" value="<?php //echo($my_access_token);   ?>"><br>-->
                <!--Device ID: <input type="text" name="my_device" value="<?php //echo($my_device);   ?>"><br>-->
                <!--<label for="level_high">HIGH</label><input type="radio" id="level_high" name="level" value="HIGH" checked="checked"/>-->
                <!--<label for="level_low">LOW</label><input type="radio" id="level_low" name="level" value="LOW"/>-->
                <!--<input type="Submit" name="Submit" value="Open" style="width:60px;height:30px;">-->
                {if $accessLevel > 0}
                <button class="btn btn-positive btn-block" type="submit">Open Gate</button>
                {else}
                <a href="#myModalexample"><button class="btn btn-negative btn-block">Open Gate</button></a>
                {/if}
                {if $accessLevel > 1}
                <button class="btn btn-positive btn-block" type="submit" value='safe' name='safe'>Open Safe</button>
                {else}
                <a href="#myModalexample2"><button class="btn btn-negative btn-block">Open Safe</button></a>
                {/if}
                {if $timeslot == 1}
                    <button class="btn btn-positive btn-block" type="submit">Time Slot</button>
                {else}
                <a href="#myModalexample"><button class="btn btn-negative btn-block">Time Slot</button></a>
                {/if}
            </form>
                <!--<a href="javascript: ajaxCall()"><button class="btn btn-negative btn-block">Test Ajax</button></a>-->
                
<div id="myModalexample" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-close pull-right" href="#myModalexample"></a>
    <h1 class="title">Open Gate</h1>
  </header>
  

  <div class="content">
    <p class="content-padded" id="modelContent">Sorry but you do not have permission yet to open the gate. please ask a admin to give you access</p>
  </div>
</div>
      <div id="myModalexample2" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-close pull-right" href="#myModalexample2"></a>
    <h1 class="title">Open Safe</h1>
  </header>
    <div class="content">
    <p class="content-padded" id="modelContent2">Sorry but you do not have permission to open the safe.</p>
  </div>
</div>
        </div>
{include file="footer.tpl"}