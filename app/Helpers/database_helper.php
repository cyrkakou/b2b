<?php
if (! function_exists('db')) {

    function db(string $tablename = ''): object
    {
        if(!empty($tablename)){
            return \Config\Database::connect()
                ->table($tablename);
        }
        return \Config\Database::connect();
    }
    function datatable(): object
    {
        return \Config\Services::datatable();
    }
    if(!function_exists('mysql_to_date')){
        function mysql_to_date($date, $glue = '-')
        {
            if (@preg_match('#^(\d{4})[/-](\d{2})[/-](\d{2})$#', $date, $matches)) {
                $year  = trim($matches[1]);
                $month = trim($matches[2]);
                $day   = trim($matches[3]);
                if(checkdate ( (int) $month , (int) $day , (int) $year )) return("$day$glue$month$glue$year");
            } else {
                // 'invalid format';
            }
            return '';
        }
    }
    if(!function_exists('date_to_mysql')){
        function date_to_mysql($date, $glue = '-')
        {
            if (preg_match('#^(\d{2})[/-](\d{2})[/-](\d{4})$#', trim($date), $matches)) {
                $day  = trim($matches[1]);
                $month = trim($matches[2]);
                $year   = trim($matches[3]);
                if(checkdate ( (int) $month , (int) $day , (int) $year )) return("$year$glue$month$glue$day");
            } else {
                // 'invalid format';
            }
            return '';
        }
    }
    function sql_docteurs_list():string{
     return  "SELECT 
                    docteurs.docteurID, 
                    CONCAT(docteurSpecialite,' -> ',UPPER(personnes.nom),' ',personnes.prenoms) AS nom_complet
               FROM docteurs
          LEFT JOIN docteurs_personnes ON docteurs_personnes.docteurID = docteurs.docteurID
          LEFT JOIN personnes ON personnes.personneID = docteurs_personnes.personneID
           ORDER BY docteurSpecialite";
    }
    function sql_assurance_list():string{
        return  "SELECT assureurID,raison_sociale FROM assureurs";
    }
    function sql_patients_list():string{
        return  "SELECT 
                    patients.patientID, 
                    CONCAT(personnes.nom,' ',personnes.prenoms) AS nom_complet
               FROM patients
          LEFT JOIN personnes ON personnes.personneID = patients.personneID";
    }
}
?>
