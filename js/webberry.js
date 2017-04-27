(function($){

    $(document).on('click', '.button_new', function(event){
        var userId = parseInt(this.id);
        var action = 'insert';
        $.ajax({
            url: 'handler.php',
            dataType: 'html',
            type: 'POST',
            data: {
                uid: userId,
                action: action
            },
            success: function(data){
                $(data).appendTo( '#playfield' );
            }
        });
        event.preventDefault();
        event.stopPropagation();
    });    
    
    $(document).on('click', '.button_reset', function(event){
        var userId = parseInt(this.id);
        var action = 'delete';
        $.ajax({
            url: 'handler.php',
            dataType: 'html',
            type: 'POST',
            data: {
                uid: userId,
                action: action
            },
            success: function(data){
                if (data === 'deleted'){
                    $('.circle').remove();
                }else{
                    alert(data);
                }
            }
        });
        event.preventDefault();
        event.stopPropagation();
    });

})(jQuery);
