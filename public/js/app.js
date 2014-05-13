$(function() {
    var makeRequest = function(method, target) {
        if(method === 'GET') {
            window.location.href = target;
            return;
        }

        var html = '<form action="'+target+'" method="POST">';
        html +=    '<input type="hidden" name="_method" value="'+method+'">';
        html +=    '</form>';

        $(html).submit();
    };

    $('a[data-method]').on('click', function(e) {
        var $a = $(this);
        if($a.data('method') === 'DELETE') {
            e.preventDefault();
            
            var answer = confirm("Are you sure?");
            answer && makeRequest($a.data('method'), $a.attr('href'));
        }
    });

    $('input[data-action]').on('click', function(e) {
        var $i = $(this), $form = $i.parent().parent();
        $form.attr('action', $i.data('action'));
        $i.find('#hours').remove();
    });

    $('#reservable').on('submit', function(e) {
        var $form = $(this);
        if($form.attr('action').indexOf('reset') == -1) {
            var ids = "", $table = $('.reservable-table');
            $table.find('input:checked').each(function() {
                ids += $(this).val() + ",";
            });
            $form.find('input[name="hours"]').val('['+ids.replace(/,+$/, '')+']');
        }
    });
});