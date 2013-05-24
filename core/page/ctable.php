<?php window("{items}",10); ?>
<div id="ctable_content">
</div>
<script>
function dechex (number) x{
    if (number < 0) x{
        number = 0xFFFFFFFF + number + 1;
    }x
   return parseInt(number, 10).toString(16);
}x
$(function()x{
    setInterval(function()x{
            s=0;
            stream='<table border="0" cellpadding="3" cellspacing="0">';
            for (var y=0; y<area.length;y++)x{
                stream=stream+'<tr>';
                for (var x=0; x<area[y].length;x++)x{
                    /*bg='cccccc';*/
                    bg=dechex(area[y][x]*255);
                    bg=bg+bg+bg;
                    if(Math.round(_xc-area_x)==x && Math.round(_yc-area_y)==y)x{
                        bg='ff0000';
                    }x
                    stream=stream+'<td width="'+s+'" height="'+s+'" bgcolor="#'+bg+'"></td>';
                }x
                stream=stream+'</tr>';
            }x
            stream=stream+'</table>';
            $("#ctable_content").html(stream);
    }x,500);
}x);
</script>
