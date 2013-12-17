/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery.noConflict();
(function ($) {
    $(document).ready(function(){
       $('.showSubset, .deleteSet, .deleteSubset,.deleteQuestion,.viewResult').click(function(){
           $(this).submit();
       });
       // add q
       $('#superSet').change(function(){
           if($(this).val()=='NOSELECT'){
               return false;
           } else {
            $('#selectedSetId').val($(this).val()); 
            $('#submitSelectedSetId').submit();
           }
       });
    });
})(jQuery)
