$(function() {
    deleted = false;

    var makeRequest = function(method, target) {
        if(method === 'GET') {
            window.location.href = target;
            return;
        }

        var html =  '<form action="'+target+'" method="POST">';
        if(method !== 'POST')
            html += '<input type="hidden" name="_method" value="'+method+'">';
        html +=     '</form>';

        $(html).submit();
    };

    $('a[data-method]').on('click', function(e) {
        var $a = $(this);

        e.preventDefault();
        e.stopPropagation();
        
        if( ! deleted) {
            deleted = confirm("Ne sei sicuro?");
            deleted && makeRequest($a.data('method'), $a.attr('href'));
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

    $('#weeks').on('change', function(e) {
        var week = $(this).val();
        location.href = location.href.split('?')[0] + '?week=' + week;
    });

    $('.js-add').on('click', function(e) {
        e.preventDefault();
        var $tr = $(this).parent().parent();
        var index = $tr.parent().find('.row').length;
        var type = $(this).data('type');

        $tr.before('<tr class="row"><td class="form-group"><input name="lim['+type+']['+index+'][username]" type="text"></td><td class="form-group"><input name="lim['+type+']['+index+'][password]" type="text"></td><td class="form-group"><input name="lim['+type+']['+index+'][first_name]" type="text"></td><td class="form-group"><input name="lim['+type+']['+index+'][last_name]" type="text"></td></tr>');
    });

    $('.js-remove').on('click', function(e) {
        e.preventDefault();

        $(this).parent().parent().prev('.row').remove();
    });
});