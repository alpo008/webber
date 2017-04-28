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
                $(data).appendTo($('.content-images'));
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
    
    $(document).on('click', '.button_check', function(event){
        var userId = parseInt(this.id);
        var action = 'check';
        $.ajax({
            url: 'handler.php',
            dataType: 'html',
            type: 'POST',
            data: {
                uid: userId,
                action: action
            },
            success: function(data){
                if (data == 0) {
                    alert('Пересечений нет.');
                }else{
                    var message = 'Пересечения у ' + data + ' кругов. Очичтить поле?';
                    if (confirm(message)){
                        $('.button_reset').click();
                    }
                }
            }
        });
        event.preventDefault();
        event.stopPropagation();
    });

})(jQuery);