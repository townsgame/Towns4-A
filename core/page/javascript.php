<script type="text/javascript">


/*------------------------------base64*/
            /*function base64_decode(s) x{
                var e=x{}x,i,k,v=[],r='',w=String.fromCharCode;
                var n=[[65,91],[97,123],[48,58],[43,44],[47,48]];
            
                for(z in n)x{for(i=n[z][0];i<n[z][1];i++)x{v.push(w(i));}x}x
                for(i=0;i<64;i++)x{e[v[i]]=i;}x
            
                for(i=0;i<s.length;i+=72)x{
                var b=0,c,x,l=0,o=s.substring(i,i+72);
                     for(x=0;x<o.length;x++)x{
                            c=e[o.charAt(x)];b=(b<<6)+c;l+=6;
                            while(l>=8)x{r+=w((b>>>(l-=8))%256);}x
                     }x
                }x
                var e=x{}x,i,b=0,c,x,l=0,a,r='',w=String.fromCharCode,L=s.length;
                var A="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
                for(i=0;i<64;i++)x{e[A.charAt(i)]=i;}x
                for(x=0;x<L;x++)x{
                    c=e[s.charAt(x)];b=(b<<6)+c;l+=6;
                    while(l>=8)x{((a=(b>>>(l-=8))&0xff)||(x<(L-2)))&&(r+=w(a));}x
                }x
                return r;
            }x*/
/*------------------------------parseMap*/
            xc=<?php echo($GLOBALS['xc']); ?>;
            yc=<?php echo($GLOBALS['yc']); ?>;
            function parseMapF(fff) x{
                parseMapx(false,fff);
            }x
            function parseMap() x{
                parseMapx(false,function()x{1;}x);
            }x
            function refreshMap() x{
                parseMapx(true,function()x{1;}x);
            }x
            function parseMapx(refresh,fff) x{
            /*alert("parse");*/
            xl=424;xp=424;
            yl=211;yp=211;
            tt=0.5;ppp=0;
            xxcc=00;
            yycc=00;

            xx=parseFloat($('#draglayer')./*offset.left*/css("left"));/*alert(xx);*/
            yy=parseFloat($('#draglayer')./*offset.top*/css("top"));
            /*alert(typeof xx_);*/
            /*if(typeof xc_=="undefined")xc_=xc;*/
            if(typeof inloading=="undefined")inloading=0;
            q=1;w=0;
            while(q==1)x{
                q=0;
                if(xx-xxcc<-xp-xl*tt)x{xx=xx+xl;xc=xc+1;q=1;w=1;}x
                if(xx-xxcc>-xp+xl*tt)x{xx=xx-xl;xc=xc-1;q=1;w=1;}x
                if(yy-yycc<-yp-yl*tt+ppp)x{yy=yy+yl;yc=yc+1;q=1;w=1;}x
                if(yy-yycc>-yp+yl*tt+ppp)x{yy=yy-yl;yc=yc-1;q=1;w=1;}x
            }x
            if(refresh)w=1;
            if(w==1 && inloading==0)x{
                    /*alert("aaa");*/
                    freeze=1;
                    inloading=1;
                    window.stop();
                    /*alert('?e=map&xc='+xc+'&yc='+yc+'&xx='+xx);
                    r('?e=map&xc='+xc+'&yc='+yc+'&xx='+xx+'&yy='+yy+'&q='+movefunc+'%20to,'+_xc+','+_yc);
					*/                    
                    $(function()x{$.get('?e=map&xc='+xc+'&yc='+yc+'&xx='+xx+'&yy='+yy+'&i='+windows,    function(vystup)x{
                            inloading=0;freeze=0;
                            /*$( "#draglayer" ).draggable( "option", "disabled", false );
                            /*------Výřez jouu*/
                            /*jouu_stream=$('#jouu').html();
                            //alert(_xc+','+_yc);
                            _pxc=_xc;
                            _pyc=_yc;*/
                            
                            zaloha_a=$('#create-build').css('display');
                            zaloha_e=$('#expandarea').css('display');
                            $('#map').html(vystup);
                            if(zaloha_a=='block')build(window.build_master,window.build_id,window.build_func);
   							$('#expandarea').css('display',zaloha_e);
                            fff();
                        }x);
                    }x);
                }xelsex{
					fff();                
                }x
        }x
/*--------------*/
    $(document).ready(function()x{
        /*---------COUNTDOWNTO  */
        function countdownto(id,x2)x{/*alert(x2);*/
        q=0;
        x1=parseFloat($("#"+id).html());
        /*x2=x2-x1+2;
        y2=y2-y1+2;*/
        x2=Math.round(x2);
        /*$("#"+id).css("left",x1+10);
        //$("#"+id).css("top",y1+10);	
        //alert(x1+","+y1+';'+x2+","+y2);*/
        countdowns[countdowns.length]=[id,q,x1,x2];
        }x
        setInterval(function()x{
        if(typeof countdowns!='undefined')x{
        for (var i = 0; i <= countdowns.length; i++)x{
            /*if(moves[0][1]!=1)x{*/
            countdown=countdowns[i];
            if(countdown)x{
                id=countdown[0];q=countdown[1];x1=countdown[2];x2=countdown[3];
                /*alert(x1+","+y1+';'+x2+","+y2);*/
                /*alert(q);*/
                x=Math.round(x1+((x2-x1)*q));
                q=q+(1/fps);
                if(q>1)q=1;
                countdowns[i][1]=q;
                $("#"+id).html(x);
            }xelsex{
                /*countdowns.splice(i,1);*/
            }x
        }x}x/*}x*/
        }x,(connectfps*1000)/fps);/*1000/fps*/
        /*moveto("abc",100,100);*/
        /*----------------------------------------------*/
        rvrao=false;
        setInterval(function()x{
            if(!rvrao/* true*/)x{
                 /*if(rvrao)x{alert('hybaa')}x*/
                urlpart='?e=aac&i='+windows;
                windows="";
               rvrao=true;$.get(urlpart, function(vystup)x{rvrao=false;eval(vystup);}x);
              
            }xelsex{
                rvrao=false;
            }x
        }x,(connectfps*1000));
        /*setTimeout(function()x{
                urlpart='?e=aac&i='+windows;windows='';
                $(function()x{$.get(urlpart, function(vystup)x{eval(vystup);}x);}x);
        }x,(connectfps*1000));*/
        /*----------------------------------------------*/

        /*---------CHAT CONFIG*/
        chating=false;
        /*---------KEYPRESS CHAT*/
        $(document).keypress(function(e) x{
            /*alert(e.which);
            //---------ENTER*/
            if ( e.which == 13 ) x{
                if(chating==false)x{
                    chating=true;
                    $('#say').focus();
                }xelsex{
                    /*alert("focusout");*/
                    chating=false;
                    $('#say').blur();
                }x
               /* if ($('#saylayer').css('display') == 'none')x{
                    
                    //$('#saylayer').css('display','block');
                    $('#say').focus();
                }xelsex{
                    //$('#saylayer').css('display','none');
                }x*/
            }x
        }x);
        /*---------CHAT*/
        
        document.chatsubmit=function() x{
            //e.preventDefault();
            //alert('hovno');                        
            chating=false;
            
            say=$('#say').val();
            if(say)x{
                ch=say.substring(0, 1);
                if(ch==":" || ch==";")x{
                    q=say.substring(1);
                }xelsex{
                    q='chat [say]&say='+say;
                    $('#objectchat<?php  echo(useid); ?>').html(say);
                }x
                
                htmlplus=$('#chat_new').html();
                /*alert(htmlplus);*/
                htmlplus=htmlplus.split('[text]').join(say);
                $('#chat_text').html($('#chat_text').html()+htmlplus);              
				$("#chatscroll").scrollTop(10000);                
                
                document.nochatref=true;
                $(function()x{$.get('?s=<?php e(ssid); ?>e=map_chat&q='+q, function(vystup)x{document.nochatref=false;/*$('#map_chat').html(vystup);$('#loading').css('visibility','hidden');*/}x);$('#loading').css('visibility','visible');}x);
            }x
            say=$('#say').val("");
     
            
            return false;
            
        }x
        
        
        $('#form_chat').submit(document.chatsubmit);        
        
        /*===========================================================================*/
        /*---------KEYDOWN*/
        key_up=false;
        key_down=false;
        key_left=false;
        key_right=false;
        /*-----*/
        $(document).keydown(function(e) x{
            /*alert(e.which);
            //---------UP,DOWN,LEFT,RIGHT
            //alert(e.which);*/
            if(chating==false)x{
                if ( e.which ==82) x{parseMap()/*firstload=4;*/}x
                /*if ( e.which ==84) x{parseMap()}x*/
                if ( e.which ==87) x{key_up=true;/*firstload=1;*/}x
                if ( e.which ==83) x{key_down=true;/*firstload=1;*/}x
                if ( e.which ==65) x{key_left=true;/*firstload=1;*/}x
                if ( e.which ==68) x{key_right=true;/*firstload=1;*/}x
            }x
            /*---------*/
        }x);  
        $(document).keyup(function(e) x{
            /*---------UP,DOWN,LEFT,RIGHT*/
            key_up=false;
            key_down=false;
            key_left=false;
            key_right=false;
            /*if ( e.which ==87) x{key_up=false;}x
            if ( e.which ==83) x{key_down=false;}x
            if ( e.which ==65) x{key_left=false;}x
            if ( e.which ==68) x{key_right=false;}x*/
            /*---------*/
        }x);

        /*===========================================================================MAPMOVEBYKEYS*/
		accux=0;
        accuy=0;
        
        act_tmp=0;
        setInterval(function() x{http://test.towns.cz/tmp/world1/model/184/0/285224.png
            if(document.activeElement.tagName=='BODY')x{
                                /*----------------------------------------?FPS*/
                act_tmpp=act_tmp;
                act_tmp = new Date();/*act_tmp.getMilliseconds()*/
                act_tmp = act_tmp.getTime();
                /*r(act_tmp);*/
                if(act_tmpp==0)x{
                    act=0;
                }xelsex{
                    act=(act_tmp-act_tmpp)/1000;
                }x
                /*----------------------------------------?*/
                xx=parseFloat($('#draglayer').css("left"));
                yy=parseFloat($('#draglayer').css("top"));
                d=207*act;q=false;
                xxp=xx;
                yyp=yy;
                if ( key_up==true    ) x{yy=yy+d;q=true;}x
                if ( key_down==true  ) x{yy=yy-d;q=true;}x
                if ( key_left==true  ) x{xx=xx+d;q=true;}x
                if ( key_right==true ) x{xx=xx-d;q=true;}x
                
				if(typeof freeze=="undefined")freeze=0;                
                
				if((accux!=0 || accuy!=0) && !freeze)x{
					/*alert('freeze ('+accux+','+accuy+')');  */
					xx=xx-(-accux);
                	yy=yy-(-accuy);
                	accux=0;
                	accuy=0; 
                	q=true;          		
                }x
                
                
                if(q==true)x{
                
                $('#map_context').css('display','none');
                $('#draglayer').css("left",xx+'px');
                $('#draglayer').css("top",yy+'px');
                if(!freeze)x{
                	/**/
                	parseMap();
                }xelsex{
                	accux=accux-(xxp-xx);
                	accuy=accuy-(yyp-yy);	
                }x
                }x
            /*---------*/
            }x
        }x,10);
        /*===========================================================================*/
    }x);
</script>
