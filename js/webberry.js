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
            console.log(data);
            }
        });
        event.preventDefault();
        event.stopPropagation();
    });

})(jQuery);
