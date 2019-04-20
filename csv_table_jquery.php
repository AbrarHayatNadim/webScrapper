<html>
<head><title>CSV</title></head>
<script src="js/d3.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<body>


<script type="text/javascript">
    function processFile(){
        var filesize = 0;
        var thefile=document.getElementById("myFile").files[0];
        var thename =thefile.name;
//        console.log(thename);
        var table =document.getElementById("mytable");
        var headerLine = "";
        var fileExtension = thename.split('.').pop();
        var filemime = thefile.type;


        if( fileExtension == "csv" & (filemime == "application/vnd.ms-excel" || filemime == "csv" || filemime == "comma-separated-values")){
            if(thefile){
                var myreader = new FileReader();
                myreader.onload = (function (e) {
                    var content =myreader.result;
                    var arrayfromfile = d3.csvParse(content);
                    var therows =e.target.result.split("\n");
                        console.log(therows.length);
//
//
//

                    for( var row=0; row<therows.length; row++) {

                        $('#myTable').empty();
                        $.each(therows[row].split(","),function (i, v) {
                            $('#myTable').append("<tr><td>" +$.trim(v)+"</td></tr>"+"<tr><td>");



                        });
                    }









//








            });
                myreader.readAsText(thefile);
            }
            return false;
        }
        else {
        }
    }




</script>

<form onsubmit="return processFile();" action="#" name="myForm" id="aForm" method="POST" >
    <input type="file" id="myFile" name="myFile"><br>
    <input type="submit" name="submitMe" value="Process File">
</form>
<section>
    <table id="myTable"></table>
</section>

<div id="mydiv">
    <p id="new">

    </p>

</div>
</body>
</html>