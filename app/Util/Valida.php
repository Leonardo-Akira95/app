<?php

    class Valida{

        public static function Entrada($string){

            $string = strip_tags($string); // Retira tags html
            $string = htmlspecialchars($string); // Transforma tags html em strings
            $string = trim($string); // Retira espaços
            $string = stripslashes($string); //Retira barras invertidas
            $string = addslashes($string); // Adiciona barras invertidas 
            $string = str_replace("<script", " ", $string); // str_replace substitui o primeiro parâmetro pelo segundo
            $string = str_replace("</script", " ", $string);
            $string = str_replace("DELETE", " ", $string);
            $string = str_replace("DROP", " ", $string);
            $string = str_replace("TABLE", " ", $string);
            $string = str_replace("DATABASE", " ", $string);
            $string = str_replace("TRUNCATE", " ", $string);
            return $string;

        }

    }

?>

