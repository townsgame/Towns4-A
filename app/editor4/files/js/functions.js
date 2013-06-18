function addFunction(type)
{
    // begin
    var i = 0;
    // exists
    for (i = 0; $("#f_" + i).length > 0; i++);
    var div = "<div id=\"f_" + i + "\"><hr />";
    // icon image
    div += "<img class=\"icon\" src=\"" + $('#' + type + "_icon").val() + "\" /><br />";
    // function
    div += "Function: <span id=\"f_" + i + "_function\">" + htmlspecialchars(type) + "</span><br />";
    // name
    div += "Name: <span id=\"f_" + i + "_name\">" + htmlspecialchars($('#' + type + "_name").val()) + "</span><br />";
    // icon
    var icon = $('#' + type + "_icon").val().split("/");
    var icon_last = icon.pop();
    div += "Icon: <span id=\"f_" + i + "_icon\">" + htmlspecialchars(icon_last) + "</span><br />";
    // description
    var desc = $('#' + type + "_description").val();
    if (desc == "Description ...")
      desc = "";
    div += "Description: <span id=\"f_" + i + "_description\">" + htmlspecialchars(desc.replace("\n", '|')) + "</span><br />";
    
    // variables
    if (type == "attack")
    {
        div += "Attack: <span id=\"f_" + i + "_attack\">" + parseInt($("#amount_attack_attack").val()).toString() + "</span><br />";
        div += "Distance: <span id=\"f_" + i + "_distance\">" + parseInt($("#amount_attack_distance").val()).toString() + "</span><br />";
        div += "Cooldown: <span id=\"f_" + i + "_cooldown\">" + parseInt($("#amount_attack_cooldown").val()).toString() + "</span><br />";
        div += "Count: <span id=\"f_" + i + "_count\">" + parseInt($("#amount_attack_count").val()).toString() + "</span><br />";
        div += "Eff: <span id=\"f_" + i + "_eff\">" + parseInt($("#amount_attack_eff").val()).toString() + "</span><br />";
        div += "Xeff: <span id=\"f_" + i + "_xeff\">" + parseInt($("#amount_attack_xeff").val()).toString() + "</span><br />";
        // total
        var total = $("#total").is(':checked') ? 1 : 0;
        div += "Total: <span id=\"f_" + i + "_total\">" + total + "</span><br />";
    } 
    else if (type == "create")
    {
        div += "Maxfs: <span id=\"f_" + i + "_maxfs\">" + parseInt($("#amount_create_maxfs").val()).toString() + "</span><br />";
        div += "Limit: <span id=\"f_" + i + "_limit\">" + parseInt($("#amount_create_limit").val()).toString() + "</span><br />";
        div += "Cooldown: <span id=\"f_" + i + "_cooldown\">" + parseInt($("#amount_create_cooldown").val()).toString() + "</span><br />";
        div += "Eff: <span id=\"f_" + i + "_eff\">" + parseInt($("#amount_create_eff").val()).toString() + "</span><br />";
    }
    
    // removing
    div += "<input type=\"button\" id=\"f_" + i + "_remove\" name=\"f_" + i + "_remove\" value=\"Remove\" onclick=\"javascript: $('#f_" + i + "').remove(); implode();\" />";
    
    // ending
    div += "</div>";
    
    // append
    $('#' + type + "_ids").append(div);    
}

function unifyFunctions()
{
    // ids to array to json
    var data = {};
    
    // initialize
    data['attack'] = new Array();
    data['create'] = new Array();
    var i = 0;
    var j = 0;
    
    // process
    $("div[id^='f_']").each(function() {
        var id = this.id.toString();
        
        // function        
        var f = htmlspecialchars($('#' + id + "_function").html());
        var k = 0;
        if (f == "attack")
          k = i;
        else if (f == "create")
          k = j;          

        // initialize
        data[f][k] = {};
        // name
        data[f][k]['name'] = htmlspecialchars($('#' + id + "_name").html());
        // icon
        data[f][k]['icon'] = htmlspecialchars($('#' + id + "_icon").html());
        // description
        data[f][k]['description'] = htmlspecialchars($('#' + id + "_description").html().replace("\n", '|').replace("\r", ''));
        
        // variables
        if (f == "attack")
        {
            data[f][k]['attack'] = parseInt($('#' + id + "_attack").html()).toString();
            data[f][k]['distance'] = parseInt($('#' + id + "_distance").html()).toString();
            data[f][k]['cooldown'] = parseInt($('#' + id + "_cooldown").html()).toString();
            data[f][k]['count'] = parseInt($('#' + id + "_count").html()).toString();
            data[f][k]['eff'] = parseInt($('#' + id + "_eff").html()).toString();
            data[f][k]['xeff'] = parseInt($('#' + id + "_xeff").html()).toString();
            data[f][k]['total'] = parseInt($('#' + id + "_total").html()).toString();
            
            // count
            i += 1;
        } 
        else if (f == "create")
        {
            data[f][k]['maxfs'] = parseInt($('#' + id + "_maxfs").html()).toString();
            data[f][k]['limit'] = parseInt($('#' + id + "_limit").html()).toString();
            data[f][k]['cooldown'] = parseInt($('#' + id + "_cooldown").html()).toString();
            data[f][k]['eff'] = parseInt($('#' + id + "_eff").html()).toString();
            
            // count
            j += 1;
        }
    });
    
    // to json
    var json = htmlspecialchars($.toJSON(data)); 
    
    // set
    $("#func").val(json);
}