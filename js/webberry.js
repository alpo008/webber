(function($){
    $(document).on('click', '.button_new', function(event){
        var userId = parseInt(this.id);
        var action = 'insert';
        $.ajax({
            url: 'handler/create',
            dataType: 'JSON',
            type: 'POST',
            data: {
                uid: userId,
                action: action
            },
            success: function(data){
                if (data.code === 200 && !!data.html.length) {
                    $(data.html).appendTo($('.content-images'));
                }
            }
        });
        event.preventDefault();
        event.stopPropagation();
    });    
    
    $(document).on('click', '.button_reset', function(event){
        var userId = parseInt(this.id);
        var action = 'delete';
        $.ajax({
            url: 'handler/delete',
            dataType: 'JSON',
            type: 'POST',
            data: {
                uid: userId,
                action: action
            },
            success: function(data){
                console.log(data);
                console.log(data.message);
                if (data.code === 200){
                    $('.circle').remove();
                }else{
                    alert(data.message);
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
            url: 'handler/count',
            dataType: 'JSON',
            type: 'POST',
            data: {
                uid: userId,
                action: action
            },
            success: function(data){
                if (typeof data.count !== 'undefined') {
                    if (data.count === 0) {
                        alert('Пересечений нет.');
                    }else{
                        var message = 'Пересечения у ' + data.count + ' кругов. Очичтить поле?';
                        if (confirm(message)){
                            $('.button_reset').click();
                        }
                    }
                } else {
                    alert('Ошибка подсчета.');
                }
            }
        });
        event.preventDefault();
        event.stopPropagation();
    });
})(jQuery);