<html>
<head>
    <link href="roboto.css" rel="stylesheet" type="text/css" >
    <link href="table_from_web.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery.js"></script>
<!--    <script type="text/javascript" src="js/dragtable.js"></script>-->
</head>
<body>

</body>

</html>




<?php



function select_option($selectoptions, $selectoptionsvalue)
{
    $selecthtml = "    <select title=\"Select List\" class='selectoption' id=\"selectoptions\">\n" .
        "<option value=\"-1\">Select effect</option>\n";
    for ($i = 0; $i < count($selectoptions); $i++) {

        $selecthtml .= '<option value="' . $selectoptionsvalue[$i] . '" >' . $selectoptions[$i] . '</option>\n';
    }
    $selecthtml .= "</select>";
    return $selecthtml;

}








function output_twodimensional_array_table($s, $s_column)
{
    $given_selectoptions = ["Wrap with '()'", "Wrap with '{}'", "Wrap with '[]'", "prepend with '-'"];
    $given_selectoptionsvalue = ["wrap_with_parenthesis", "wrap_with_brackets", "wrap_with_third_bracket", "prepend_with_dash"];
    $php_html =select_option($given_selectoptions, $given_selectoptionsvalue);
    echo '<table class="Table_full draggable">';

    for ($i = 0; $i < count($s_column); $i++)
        echo '<th class="tablehead column'.$i.' draggable">'.$php_html . $s_column[$i] . '</th>';
    echo '</tr>';

    for ($j = 0; $j < count($s); $j++) {
        $bg_color = $j % 2 == 0 ? "#E6E6FA" : "#B0E0E6";
        echo '<tr style="background-color:' . $bg_color . '">';
        for ($i = 0; $i < count($s[$j]); $i++) {
            echo '<td class="datafont col'.$i.'" contenteditable="false">' . $s[$j][$i] . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';





}
$data = file_get_contents("city.csv");
$rows = explode("\n", $data);
$given_array = array();
foreach ($rows as $row) {
    $given_array[] = str_getcsv($row);
}
$given_column = $given_array[0];
array_shift($given_array);
output_twodimensional_array_table($given_array, $given_column);
?>
<script type="text/javascript">



    function wrap_brackets(first_delimeter, second_delimeter) {
        $('.col0').text(function(i, t) {
            var text= t.replace( /(^.*\[|\].*$)/g, '' );
            text = text.replace(/(^.*\{|\}.*$)/g,'');
            text = text.replace(/(^.*\(|\).*$)/g,'');
            text = text.replace(/(^.*\-|\ .*$)/g,'');
            return text.replace(text, first_delimeter+text+second_delimeter);
        });
    }


    $('.selectoption').on('change', function()
    {
        var combo = $(this).children("option:selected").val();
        if(combo=="wrap_with_parenthesis"){
            wrap_brackets("(",")");
        }
        else if(combo=="wrap_with_third_bracket"){
            wrap_brackets("[","]");
        }else if(combo=="wrap_with_brackets"){
            wrap_brackets("{","}");

        }else if(combo =="prepend_with_dash"){
            wrap_brackets("-"," ");

        } else{
            wrap_brackets("","");

        }
    });

</script>



