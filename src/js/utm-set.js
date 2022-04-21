$(document).ready(function(){
    
    for (var i = utm_params.length - 1; i >= 0; i--) {
        utm_name = utm_params[i];
        utm_value = findGetParameter(utm_name);
        
        $('input[name=' + utm_name + ']').val(utm_value);
    }
});

function findGetParameter(parameterName) {
    result = '';
    tmp = [];

    location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });

    return result;
}
