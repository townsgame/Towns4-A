<?php
/* Towns4, www.towns.cz 
   © Pavel Hejný | 2011-2013
   _____________________________

   core/page/map_unitinfo.php

   Kontextové menu budovy
*/
//==============================
?><div style="position:absolute;"><div id="objecttext<?php  echo($id); ?>" style="position: relative; top:0; left:0;background-color:rgba(22,22,22,0.80);border-radius: 5px; z-index:11;" >
        <?php echo($name.($text?': ':'')); ?>
        <span id="objectchat<?php  echo($id); ?>">
            <?php echo(short($text,50)); ?>
        </span>
</div></div>
