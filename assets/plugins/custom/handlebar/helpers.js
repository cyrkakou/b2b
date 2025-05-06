Handlebars.registerHelper('numberFormat', function (value, options) {
    // Helper parameters
    var dl = options.hash['decimalLength'] || 0;
    var ts = options.hash['thousandsSep'] || ' ';
    var ds = options.hash['decimalSep'] || '.';

    // Parse to float
    var value = parseFloat(value)||0;

    // The regex
    var re = '\\d(?=(\\d{3})+' + (dl > 0 ? '\\D' : '$') + ')';

    // Formats the number with the decimals
    var num = value.toFixed(Math.max(0, ~~dl));

    // Returns the formatted number
    return (ds ? num.replace('.', ds) : num).replace(new RegExp(re, 'g'), '$&' + ts);
});
/**/
Handlebars.registerHelper('compare', function(lvalue, operator, rvalue, options) {

    if (arguments.length < 3)
        throw new Error("Handlerbars Helper 'compare' needs 2 parameters");

    _operator = operator || "==";

    var operators = {
        '==':       function(l,r) { return l == r; },
        '===':      function(l,r) { return l === r; },
        '!=':       function(l,r) { return l != r; },
        '<':        function(l,r) { return l < r; },
        '>':        function(l,r) { return l > r; },
        '<=':       function(l,r) { return l <= r; },
        '>=':       function(l,r) { return l >= r; },
        'typeof':   function(l,r) { return typeof l == r; }
    }

    if (!operators[_operator])
        throw new Error("Handlerbars Helper 'compare' doesn't know the operator "+_operator);

    var result = operators[_operator](lvalue,rvalue);

    if( result ) {
        return options.fn(this);
    } else {
        return options.inverse(this);
    }
});