function save()
{    
    var res = generate(1);
    
    if (res != 0)
    {
        $.get("files/php/saver.php", { "res": res }, function(data){ alert("The model was successfully created and saved in the database."); });
    }
    else
      alert("The model could not be created.");
}