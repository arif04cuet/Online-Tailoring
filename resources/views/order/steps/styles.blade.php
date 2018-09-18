
 <div class="scroller scroller-left"><<</div>
 <div class="scroller scroller-right">>></div>

<div class="row">

    <?php 
        $lis = '';
        $pans = '';
    ?>
        @if ($collection)
            <?php $i=1;?>
            @foreach($collection as $item)
                
                <?php 
                $m=1;
                $lis .='<li class="nav-item" id="tab'.$i.'"><a class="nav-link" data-toggle="tab" href="#">'.$item->name.'</a></li>'; 
                ?>

                @if ($item->images()->get())
                    <?php $pans .='<div id="pan'.$i.'" class="pan hide">' ?>
                    @foreach ($item->images()->get() as $image)
                        <?php $checked = ($m == 1)?' checked="checked"':''?>
                        <?php 
                        $pans .='
                                    <label class="labl d-table  zoom">
                                        <input class="style" type="radio" name="style['.$item->id.']" value="'.$image->id.'" '.$checked.'/>
                                        <div data-tab="'.$i.'" class="product-box text-black d-table-cell align-middle text-center">
                                            <img src="'. asset('uploads').'/'.$image->file .'" alt="" style="width:100%">
                                            '. $image->caption .'
                                        </div>
                                    </label>
                            ';
                        $m++;
                        ?>
                    @endforeach
                    <?php $pans .='</div>'?>
                @endif
                <?php $i++;?>
            @endforeach
        @endif


        <div class="col">
            <div class="row">
                <div class="col">
                    <div class="wrapper">   
                        <ul id="tabSet" class="nav nav-pills styles_subheadings_tabs list" style="">
                            <?php echo $lis;?>      
                        </ul>
                    </div>
                </div>
            <br><br>
            </div>
                <div class="pans row" id="styles_subheadings_content">
                        <?php echo $pans;?>      
                </div>

                    
        </div>
       
    </div>

    
    <br><br>

    <div class="row">
        <div class="col-md-6">
            <h3>Monogram</h3>
            <p>Add monogram to your custom clothing:</p>
            <br>
            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="">Monogram Style:</label>
                  <select name="monogram[style]" id="monograme_style" class="form-control">
                      <option value="">Select Style</option>
                      <option value="block">Block</option>
                      <option value="script">Script</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="">Colour</label>
                  <select name="monogram[color]" id="monograme_color" class="form-control">
                        <option value="0">Select colour</option>
                        <option value="white">White</option>
                        <option value="lightyellow" >Light Yellow</option>
                        <option value="gray">Grey</option>
                        <option value="black">Black</option>
                        <option value="lightblue">Light Blue</option>
                        <option value="blue">Blue</option>
                        <option value="navy">Navy</option>
                        <option value="pink">Pink</option>
                        <option value="purple">Purple</option>
                        <option value="red">Red</option>
                        <option value="lightbrown">Light Brown</option>
                        <option value="yellow">Yellow</option>
                        <option value="green">Green</option>
                        <option value="darkgray">Dark Grey</option>
                    </select>
                    
                </div>
              </div>
              <div class="form-group">
                  
                <label for="">Leave notes for us about the monogram:</label>
                <textarea name="monogram[text]" id="monogram_text" cols="30" rows="5" class="form-control">

                </textarea>
              </div>
             

        </div>
        <div class="col-md-6">
                <br><br><br>
                <br>
                
            <p>Add monogram to your custom clothing:</p>

            <div class="monogram_preview">
                <div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button class="nav-link btn btn-primary next">Next &gt;&gt;</button>
        </div>
    </div>

 <script>

 //monogram

 function updateMonogram(){
     var $style = $('#monograme_style').val();
     var $color = $('#monograme_color').val();
     var $text  = $('#monogram_text').val();
     var $el    = $('.monogram_preview div');
     
      if($style == 'script')
      {
          $el.css('font-style','italic');
      }else{
          $el.css('font-style','normal');            
      }  

      if($color)
      {
          $el.css('color',$color);
      }else{
          $el.css('color','white');            
      }

      $el.text($text)

 }
 $('#monogram_text').keyup(function(){
    updateMonogram();
 });
 $("#monograme_style,#monograme_color").change(function(){
     updateMonogram();
 });


 $("#tabSet li:eq(0) a").addClass('active');
 $("#tabSet li:eq(0)").click();

var hidWidth;
var scrollBarWidths = 40;
var scrollItemsPerStep = 3;


var widthOfList = function(){
  var itemsWidth = 0;
  $('.list li').each(function(){
    var itemWidth = $(this).outerWidth();
    itemsWidth+=itemWidth;
  });
  return itemsWidth;
};

var widthOfHidden = function(){
  return (($('.wrapper').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
};

var getLeftPosi = function(){
  return $('.list').position().left;
};

var reAdjust = function(){
  if (($('.wrapper').outerWidth()) < widthOfList()) {
    $('.scroller-right').show();
  }
  else {
    //$('.scroller-right').hide();
  }
  
  if (getLeftPosi()<0) {
    $('.scroller-left').show();
  }
  else {
    $('.item').animate({left:"-="+getLeftPosi()+"px"},'slow');
  	//$('.scroller-left').hide();
  }
}

reAdjust();

$(window).on('resize',function(e){  
  	reAdjust();
});

$('.scroller-right').click(function() {
  
//   $('.scroller-left').fadeIn('slow');
//   $('.scroller-right').fadeOut('slow');
//   stepItemsWidth = scrollItems('left');
//   console.log(stepItemsWidth);
    width = -$('.wrapper').outerWidth()+200;
    $('.list').animate({left:"+="+width+"px"},'slow',function(){

    });

   


});

$('.scroller-left').click(function() {
  
	// $('.scroller-right').fadeIn('slow');
	// $('.scroller-left').fadeOut('slow');
    width = -$('.wrapper').outerWidth()+200;
  	$('.list').animate({left:"-="+width+"px"},'slow',function(){
  	
  	});
});    


 </script>

 <style>
 
 .monogram_preview div{
    color:white;
 }
 .monogram_preview{
     height: 60%;
     width: 100%;
     background-color: gray;
     display: flex;
     justify-content: center;
     align-items: center;
    
 }
 .wrapper {
    position:relative;
    margin:0 auto;
    overflow:hidden;
	padding:5px;
  	height:50px;
}

.list {
    position:absolute;
    left:0px;
    top:0px;
  	min-width:3000px;
  	margin-left:12px;
    margin-top:0px;
}

.list li{
	display:table-cell;
    position:relative;
    text-align:center;
    cursor:grab;
    cursor:-webkit-grab;
    color:#efefef;
    vertical-align:middle;
}

.scroller {
  text-align:center;
  cursor:pointer;
  
  padding:7px;
  padding-top:11px;
  white-space:no-wrap;
  vertical-align:middle;
  background-color:#fff;
}

.scroller-right{
  float:right;
}

.scroller-left {
  float:left;
}
#styles_subheadings_content .pan label{float: left;width: 191px}
#styles_subheadings_content .pan{margin-top: 20px}

</style>