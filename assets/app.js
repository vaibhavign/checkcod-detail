 jQuery(document).ready(function($){
        jQuery('#pinbutton').bind('click',function(){
            var pcode = jQuery('#pinc').val();
            var data = {
                action: 'myajax-submiting', 
                whatever: 1234,
                zipcode:pcode,
                whataction:'checkZipcode'
        };
                        jQuery.post(MyAjax.ajaxurl, data, function(response) {
                            if(response==1){
                                jQuery('#ship_avial').show();
                                jQuery('#ship_not_avial').hide();
                            } else if(response==0){
                                jQuery('#ship_not_avial').show();
                                jQuery('#ship_avial').hide();
                            }

        });


                    });
                    
                    
                    jQuery('#pinc').keypress(function(event){
   
                         if ( event.which == 13 ) {
                               var pcode = jQuery('#pinc').val();
            var data = {
                action: 'myajax-submiting', 
                whatever: 1234,
                zipcode:pcode,
                whataction:'checkZipcode'
        };
                        jQuery.post(MyAjax.ajaxurl, data, function(response) {
                            if(response==1){
                                jQuery('#ship_avial').show();
                                jQuery('#ship_not_avial').hide();
                            } else if(response==0){
                                jQuery('#ship_not_avial').show();
                                jQuery('#ship_avial').hide();
                            }

        });
                            }
                        
                    });
                        
                      
                       



        })
