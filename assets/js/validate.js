function attrDefault($el, data_var, default_val)
{
    if(typeof $el.data(data_var) != 'undefined')
    {
        return $el.data(data_var);
    }
    return default_val;
}
if($.isFunction($.fn.validate))
{
    jQuery.validator.addMethod("is_email", function(value, element) {
        if(value !== undefined && value.length > 0)
        {
            if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }
        return true;

    }, "Please enter a valid Email.");
    $.validator.addMethod(
        "depends",
        function(value, element, params) {
            var parent = $(params).val();
            if(!(parent !== undefined && parent !== null && parent.length > 0))return true;
            if ( $(params).is(':checkbox') && !$(params).is(':checked'))return true;
            return (value !== undefined && value !== null && value.length > 0);
        },
        'veuiller renseigner {0}.');
    $.validator.addMethod(
        "greaterThan",
        function(value, element, params) {
            var target = $(params).val();
            var isValueNumeric = !isNaN(parseFloat(value)) && isFinite(value);
            var isTargetNumeric = !isNaN(parseFloat(target)) && isFinite(target);
            if (isValueNumeric && isTargetNumeric) {
                return Number(value) > Number(target);
            }
            if (!/Invalid|NaN/.test(dateIso(value))) {
                return dateIso(value) > dateIso(target);
            }
            return false;
        },
        'Must be greater than {0}.');
    $.validator.addMethod(
        "lesserThan",
        function(value, element, params) {
            var target = $(params).val();
            var isValueNumeric = !isNaN(parseFloat(value)) && isFinite(value);
            var isTargetNumeric = !isNaN(parseFloat(target)) && isFinite(target);
            if (isValueNumeric && isTargetNumeric) {
                return Number(value) < Number(target);
            }
            if (!/Invalid|NaN/.test(dateIso(value))) {
                return dateIso(value) < dateIso(target);
            }
            return false;
        },
        'Must be lesser than {0}.');
    $.validator.addMethod(
        "greaterOrEqual",
        function(value, element, params) {
            var target = $(params).val();
            var isValueNumeric = !isNaN(parseFloat(value)) && isFinite(value);
            var isTargetNumeric = !isNaN(parseFloat(target)) && isFinite(target);
            if (isValueNumeric && isTargetNumeric) {
                return Number(value) >= Number(target);
            }
            return false;
        },
        'Must be greater or equal to {0}.');
    $.validator.addMethod(
        "lesserOrEqual",
        function(value, element, params) {
            var target = $(params).val();
            var isValueNumeric = !isNaN(parseFloat(value)) && isFinite(value);
            var isTargetNumeric = !isNaN(parseFloat(target)) && isFinite(target);
            if (isValueNumeric && isTargetNumeric) {
                return Number(value) <= Number(target);
            }
            return false;
        },
        'Must be lesser or equal to {0}.');
    $("form.validate").each(function(i, el)
    {
        let $this = $(el),
            opts = {
                onfocusout:function(element) { $(element).valid(); },
                onfocusin:function(element) { $(element).valid(); },
                errorClass:'is-invalid',
                validClass:'is-valid',
                rules: {},
                messages: {},
                errorElement: 'span',
                ignore: ':disabled,:hidden, .select2-search__field,.select2-input, .select2-focusser', // ignore hidden fields
                highlight: function (element, errorClass, validClass) { // hightlight error inputs
                    let parent = $(element).closest('.form-group')
                    parent.removeClass('is-valid').addClass('is-invalid');
                    $(element).removeClass('is-valid').addClass('is-invalid');
                },
                success: function (label, element) {
                    let parent = $(element).closest('.form-group')
                    parent.removeClass('is-invalid').addClass('is-valid');
                    $(element).removeClass('is-invalid').addClass('is-valid');
                },
            }
        $fields = $this.find('[data-validate]');
        $fields.each(function(j, el2)
        {
            var $field = $(el2),
                name = $field.attr('name'),
                validate = attrDefault($field, 'validate', '').toString(),
                _validate = validate.split(',');
            for(var k in _validate)
            {
                var rule = _validate[k],
                    params,
                    message;

                if(typeof opts['rules'][name] == 'undefined')
                {
                    opts['rules'][name] = {};
                    opts['messages'][name] = {};
                }

                if($.inArray(rule, ['required', 'url', 'email','is_email', 'number', 'date', 'creditcard']) != -1)
                {
                    opts['rules'][name][rule] = true;
                    message = $field.data('message-' + rule);

                    if(message)
                    {
                        opts['messages'][name][rule] = message;
                    } else {
                        opts['messages'][name][rule] = ' ';
                        //console.log('name:'+name+'-rule:'+ rule + '- message:' + message)
                    }
                }
                // Parameter Value (#1 parameter)
                else
                if(params = rule.match(/(\w+)\[(.*?)\]/i))
                {
                    if($.inArray(params[1], ['depends','remote','min', 'max', 'minlength', 'maxlength', 'equalTo',
                        'greaterThan','lesserThan','lesserOrEqual']) != -1)
                    {
                        opts['rules'][name][params[1]] = params[2];
                        message = $field.data('message-' + params[1]);
                        if(message)
                        {
                            opts['messages'][name][params[1]] = message;
                        } else {
                            opts['messages'][name][params[1]] = ' ';
                            console.log('name:'+name+'-rule:'+ rule + '- message:' + message)
                        }
                    }
                }
            }
        });

        $this.validate(opts);
    });
}