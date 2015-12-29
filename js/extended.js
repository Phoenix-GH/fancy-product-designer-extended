

jQuery(document).ready(function(){
  //  var layersList = jQuery('.fpd-content-layers').find('.fpd-list');
   // layersList.append('<div class="fpd-list-row" id="backgroundlayer"><div class="fpd-cell-0"></div><div class="fpd-cell-1">Foreground</div><div class="fpd-cell-2"></div></div>');

    //jQuery('.canvas-container').html('<canvas class="drawing-convas" width="555" height="560"></canvas>');
    setTimeout(function() {
        jQuery("[data-context='layers']").click(function () {
            if(jQuery('.backgroundlayer').length==0)
              jQuery('.fpd-list').append('<div class="fpd-list-row backgroundlayer"><div class="fpd-cell-0"></div><div class="fpd-cell-1">Foreground</div><div class="fpd-cell-2"></div></div>');
        });
        jQuery('.fpd-red-button').click(function () {
           jQuery('.upper-canvas').sketch();
        });
        jQuery('.backgroundlayer').click(function(){

        });
    },1000);

});

