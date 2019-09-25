$(document).ready(function(){
    $('.add_button3').click(function(){
        var kakoi=$(this).attr('fldnum');
        var insHTML = '<div class="input-group"><input class="form-control" name="subject[]" type="text" onkeypress="validateComplainant(event)" required/><div class="input-group-prepend"><button class="btn btn-danger btn-add add_button3 remove_button" fldnum="3" type="button"><span class="fas">x</span></button></div></div>';
        $("#fld3").append(insHTML);
    });

    $('.fld_wrap').on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parents(':eq(1)').remove();
    });
});

$(document).ready(function(){
    $('.add_button4').click(function(){
        var kakoi=$(this).attr('fldnum');
        var insHTML = '<div class="input-group"><input class="form-control" name="victim[]" type="text" onkeypress="validateComplainant(event)" required/><div class="input-group-prepend"><button class="btn btn-danger btn-add add_button4 remove_button" fldnum="4" type="button"><span class="fas">x</span></button></div></div>';
        $("#fld4").append(insHTML);
    });

    $('.fld_wrap').on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parents(':eq(1)').remove();
    });
});
 $(document).ready(function(){
        $('.add_button2').click(function(){
            var kakoi=$(this).attr('fldnum');
            var insHTML = '<div class="input-group"><select name="fld_val2[]" id="fld_val2"  class="form-control"><option value=""></option>@foreach($agent2 as $agent2)<option value="{{ $agent2->userid }}">{{ $agent2->firstName }} {{ $agent2->lastName }}</option>@endforeach</select><div class="input-group-prepend"><button class="btn btn-danger btn-add add_button2 remove_button" fldnum="2" type="button"><span class="fas">x</span></button></div>';
            $("#fld2").append(insHTML);
        });

        $('.fld_wrap').on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parents(':eq(1)').remove();
        });
    });
    $(document).ready(function(){
        $('.add_button1').click(function(){
            var kakoi=$(this).attr('fldnum');
            var insHTML = '<div class="input-group"><select  name="fld_val1[]" id="fld_val1" class="form-control" required><option value=""></option>@foreach($nature2 as $nature2)<option value="{{ $nature2->natureid }}">{{ $nature2->nature }}</option>@endforeach</select><div class="input-group-prepend"><button class="btn btn-danger btn-add add_button1 remove_button" fldnum="1" type="button"><span class="fas">x</span></button></div>';
            $("#fld1").append(insHTML);
        });

        $('.fld_wrap').on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parents(':eq(1)').remove();
        });
    });
function validate(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
    // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9,C,M,-]/;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
function validateCCN(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
    // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9,I,M,-]/;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
function validateACMO(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
    // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9,C,I,-]/;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
function validateComplainant(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
    // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[a-z,A-Z, ]/;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
