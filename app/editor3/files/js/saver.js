function save()
{    
    var res = generate(1);
    res = res.toString();
    
    var title = $("#title").val();
    var desc = $("#description").val();
    var attack = $("#amount_51").val();
    var speed = $("#amount_52").val();
    var building = $("#amount_53").val();
    var strength = $("#amount_54").val();
    var distance = $("#amount_55").val();     
        
    if (res != "")
    {   
        $.ajax({
          async: false,
          type: "GET",
          url: "files/saver.php",
          data: { "res": res, "title": title, "desc": desc, "attack": attack, "speed": speed, "building": building, "strength": strength, "distance": distance }
        }).done(function( msg ) {
        });
    }                                                   
    else
      alert("The model could not be created.");
}