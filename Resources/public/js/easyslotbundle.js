$(document).ready(function() {
    $(function() {
        $( "#accordion" ).accordion({
            header: '> div > h3',
            collapsible: true,
            heightStyle: "content"
        })
        .sortable({
                axis: "y",
                handle: "h3",
                stop: function( event, ui ) {
                    // IE doesn't register the blur when sorting
                    // so trigger focusout handlers to remove .ui-state-focus
                    ui.item.children( "h3" ).triggerHandler( "focusout" );
                }
        });
        $( ".addBtn" ).click(function() { 
            $('#accordion').accordion("destroy");
            if($('.slot').length > 0){
                $('.slotmodel').clone().insertBefore(".slot:first").removeClass('slotmodel').addClass('slot').addClass('new');
            }
            else{
                $('.slotmodel').clone().insertBefore(".noslots").removeClass('slotmodel').addClass('slot').addClass('new');
            }
            $('.slot.new').trigger('created');
            $('#accordion')
            .accordion({
                header: '> div > h3',
                heightStyle: "content",
                collapsible: true,
            });
        });
        $( ".slot .delnew" ).live('click',function() {
            $('#accordion').accordion("destroy");
            $(this).parents(".slot").remove();
            //this should actually be a callback
            $('#accordion').accordion({
                header: '> div > h3',
                heightStyle: "content",
                collapsible: true,
                active: index
            });
            return false;
        });
        $("#flash").fadeOut(5400);
    });
    
    $('.saveBtn').click(function(){
        $('#teaserForm').submit();
    });
    
    $("a.delete-slot").click(function(e) {
        e.preventDefault();
        var targetUrl = $(this).attr("href");

        $("#dialog").dialog({
            buttons: {
                "Confirm": function() {
                    window.location.href = targetUrl;
                },
                "Cancel": function() {
                    $(this).dialog("close");
                }
            }
        });

        $("#dialog").dialog("open");

        return false;
    });

    $("#dialog").dialog({
        autoOpen: false,
        modal: true
    });
});

