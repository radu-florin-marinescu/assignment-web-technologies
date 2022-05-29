<?php
function getStatusNameByEnumType($enumType)
{
    switch ($enumType) {
        case "received" :
            return "Primit";
        case "processing" :
            return "In procesare";
        case "sent : return" :
            return "Trimis";
        case "completed" :
            return "Terminat";
        case "out_of_stock" :
            return "Fara stoc";
        case "returned" :
            return "Retur";
    }
}

function getStatusColorByEnumType($enumType)
{
    switch ($enumType) {
        case "received" :
            return "color-green";
        case "processing" :
            return "color-violet";
        case "sent" :
            return "color-green-darker";
        case "completed" :
            return "color-blue";
        case "out_of_stock" :
            return "color-orange";
        case "returned" :
            return "color-red";
    }
}