/**
 * Created by 慕虚云 on 2015/12/11 0011.
 */
$(function(){
    //弹出对话框
   $('#modalButton').click(function(){
       $('#modal').modal('show')
           .find('#modalContent')
           .load($(this).attr('value'));
   }) ;
});