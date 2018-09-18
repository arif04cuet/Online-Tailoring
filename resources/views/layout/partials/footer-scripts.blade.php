<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
    
<script>
    $(document).ready(function () {

        
        //Step 1
         $('#nav-suit .product-box:eq(0)').click();
         $('#suit-tuxedo [data-toggle="tab"]:eq(0)').click(function () {
           
           var checked = $('#nav-tuxedo input[name=product]:checked').val();
           if($("#nav-suit input[name=product][value=" + checked + "]").length)
               $("#nav-suit input[name=product][value=" + checked + "]").click();
           else
           $('#nav-suit .product-box:eq(0)').click();
           

        });

         $('#suit-tuxedo [data-toggle="tab"]:eq(1)').click(function () {
           
            var suit_checked = $('#nav-suit input[name=product]:checked').val();
            if($("#nav-tuxedo input[name=product][value=" + suit_checked + "]").length)
                $("#nav-tuxedo input[name=product][value=" + suit_checked + "]").click();
            else
            $('#nav-tuxedo .product-box:eq(0)').click();

         });

        $('body').on('click','#nav-suit-tuxedo button.next',function(){
            $('#steps [data-toggle="tab"]:eq(1)').click();
            
        });
        
        //Step 2
        $('#steps [data-toggle="tab"]:eq(1)').click(function () {
            
            $('#fabrics [data-toggle="tab"]:eq(0)').click();
            $('.preview').show();
        });

        //filter fabrics
        $('body').on('change','.fabric_filters select',function(){
            $('#ajax_loader').show();
            var values = $('.fabric_filters select').serialize();
            
           
            targ = '#nav-fabric';
            product_id = $('input[name=product]:checked').val();;
            loadurl = 'order/' + product_id + '/fabrics?'+values;
            $.get(loadurl, function (data) {
                $(targ).html(data.html);
                $('#ajax_loader').hide();
            });
        

        });

        //Step 3
        $('#steps [data-toggle="tab"]:eq(2)').click(function () {
            
            if(!$(".fabric").length)
            {
                alert("Pls select Fabric");
                $('#steps [data-toggle="tab"]:eq(1)').click();
                return false;
            }
            
            if(!$(".lining").length)
            {
                alert("Pls select Lining");
                $('#fabric-lining-style [data-toggle="tab"]:eq(1)').tab('show');
                $('#fabric-lining-style #nav-lining-tab').click();
                return false;
            }
            
            if(!$(".style").length)
            {
                alert("Pls select Style");
                $('#steps [data-toggle="tab"]:eq(1)').tab('show');
                $('#fabric-lining-style #nav-style-tab').click();
                return false;
            }
           
        });

        //Transition
        //Fabric to Lining
        $('body').on('click','#nav-fabric button.next',function(){
            $("#nav-lining-tab").click();
        });
        
        //Lining to Style
        $('body').on('click','#nav-lining button.next',function(){
            $("#nav-style-tab").click();
        });

        //Style to Style
        $('body').on('click','#styles_subheadings_content label div',function(){
            var id = parseInt($(this).attr('data-tab'));
            id++;
            var tab = 'tab'+id;
            console.log(tab);
            $("ul.styles_subheadings_tabs").find('li#'+tab).click();
        });

        // Stop ajax reloading
        $('#fabric-lining-style a[data-toggle="tab"]').click(function(){
            var ref = $(this).attr('href').replace('#', '');
            if ($('#' + ref+'>div').length) {
                
               return false;
            }

        });

       // style next button to Confirm step

        $('body').on('click','#nav-style button.next',function(){
            $('#steps [data-toggle="tab"]:eq(2)').click();
            
        });



        $('#fabrics [data-toggle="tab"]').click(function (e) {
            $('#ajax_loader').show();
            
            var $this = $(this),
                targ = $this.attr('href');
            product_id = $('input[name=product]:checked').val();;

            loadurl = 'order/' + product_id + '/' + $this.attr('data-url');
            
            if(!$(''+targ+'>div').length || 1)
            {
                $.get(loadurl, function (data) {
                    $(targ).html(data.html);
                    $('#ajax_loader').hide();
                });
            }

            

            $this.tab('show');
            if(targ == '#nav-style')
            {
            
                $("#tabSet li:eq(1)").click();
            }
            return false;
        });

        $('body').on('click','#tabSet li',function(){
            tab = $(this).attr('id');
            pan = tab.replace('tab','pan');
            
            $('.pans div').hide();
            $("#tabSet a").removeClass('active');
            $(this).find('a').addClass('active');
            $('.pans #'+pan).show();
            setStylesPreview(tab);
        });

        //Step 3
        $("body").on('change', "#measurement_unit", function () {
            $value = $(this).val();
            $("span.unit").html($value);
        });

        //Submit form
        // $("#order").submit(function(event){
        //     event.preventDefault(); //prevent default action 
        //     var post_url = $(this).attr("action"); //get form action url
        //     var request_method = $(this).attr("method"); //get form GET/POST method
        //     var form_data = $(this).serialize(); //Encode form elements for submission
        //     console.log(form_data);
        //     $.ajax({
        //         url : post_url,
        //         type: request_method,
        //         data : form_data
        //     }).done(function(response){ //
        //         console.log(response);
        //     });
        // });

        //functions

        function setCategoryPreview()
        {
            $el = $("#suit-tuxedo").find("a.active");
            $id = $el.attr('href');
            $tabName = $el.text();
            $product = $($id+' input[name=product]:checked').parent().find('div.product-box').html();
            $('.preview .category').empty().html($tabName + ' - '+$product);
            
        }

        function setFabricPreview()
        {
            $product = $('#nav-fabric input[name=fabric]:checked').parent().find('div.product-box').html();
            $('.preview .fabric').empty().html($product);
        }
        function setLiningPreview()
        {
            $product = $('#nav-lining input[name=lining]:checked').parent().find('div.product-box').html();
            $('.preview .lining').empty().html($product);

        }

         function setStylesPreview(tab)
        {
            var tab_no = tab.substr(tab.length - 1);
            var seletced_pan = parseInt(tab_no)-1;
            if(seletced_pan == 0)
                return;
            //var pan+tab_no
            $product = $('#pan'+seletced_pan+' input[class=style]:checked').parent().find('div.product-box').html();
            $tabLabel = $('#tab'+seletced_pan+' a').text();
            $pan = '<div id="pan'+tab_no+'">'+$tabLabel+$product+'</div>';
            
            if($('.preview .styles #pan'+tab_no).length){
                $('.preview .styles #pan'+tab_no).remove();
            }

            $('.preview .styles').append($pan);
            
        }

        $("a[href='#fabrics']").on('shown.bs.tab', function(e) {
            setCategoryPreview();
        });

        $("a[href='#nav-lining']").on('shown.bs.tab', function(e) {
            setFabricPreview();
        });
        
        $("a[href='#nav-style']").on('shown.bs.tab', function(e) {
            setLiningPreview();
        });

        $("ul.styles_subheadings_tabs .nav-item a").on('shown.bs.tab', function(e) {
            
        });

    });
</script>

