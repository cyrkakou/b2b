<?php
namespace App\Modules\Api\Models;
use App\Controllers\IbemsModel;

class Datatable extends IbemsModel
{
    private static $request;
    private static $field_list;
    private static $columns;
    private static $wherClause;
    public function __construct()
    {
        parent::__construct();
        self::$request = $_REQUEST;
    }
    public static function fetch_data($args = [])
    {
        if(!isset($args['query'])) die('requête non définie');
        if(!isset($args['columns'])) die('columns non définies');
        $default_sort = @$args['$default_sort'];
        $sOrder = '';
        $sGroupBy = '';
        $sLimit = '';
        $like = [];
        $query_base = $args['query'];
        self::$wherClause = @$args['where'];
        self::$columns = $args['columns'];
        //
        //main where clause
        if(is_array(self::$wherClause) && count(self::$wherClause) > 0)
        {
            $query_base.=' WHERE ('.implode(' AND ',self::$wherClause).' )';
        }
        if(isset($args['group_by'])){
            $sGroupBy = $args['group_by'];
        }
        //
        $q1 = db()->query($query_base.$sGroupBy);
        $iTotalRecords = $q1->getNumRows();
        //getting columns
        foreach ($q1->getFieldNames() as $field)
        {
            self::$field_list[] = $field;
        }
        /* Global Searching */
        $globalSearch = self::global_search();
        /* Columns Searching */
        $columnSearch = self::column_search();
        $where = '';
        if ( !empty( $globalSearch ) ) {
            $where = $globalSearch;
        }
        if ( !empty( $columnSearch ) ) {
            $where = $where === '' ? $columnSearch :
                $where .' AND '. $columnSearch;
        }
        if ( $where !== '' ) {
            if(is_array(self::$wherClause) && count(self::$wherClause) > 0)
            {
                $query_base.= ' AND '.$where;
            }else{
                $query_base.= 'WHERE '.$where;
            }
        }




        //group by
        $query_base.=$sGroupBy;
        //order clause
        if(isset($_POST['order']))
        {
            if(in_array($_POST['order']['0']['column'], self::$field_list))
            {
                $c = $_POST['order']['0']['column'];
                $d = @$_POST['order']['0']['dir'];
                $sOrder = " ORDER BY `$c` $d";
            }
        }elseif(!empty($default_sort))
        {
            $sOrder = " ORDER BY `$default_sort` DESC";
        }
        $query_base.=$sOrder;
        //
        $query_base.=self::limit();


        $q2 = db()->query($query_base);
        //qd();


        $iTotalDisplayRecords = $q2->getNumRows();
        $resp = [];
        $resp["order"] = @$_POST['order']['0']['column'];
        $resp["sql"] = str_replace(["\r", "\n"], '', $query_base);
        $resp["draw"] = intval(@$_POST["draw"]);
        $resp["fnRecordsTotal"] = @$iTotalRecords;
        $resp["iTotalRecords"] = @$iTotalRecords;
        $resp["iTotalDisplayRecords"] = @$iTotalDisplayRecords;
        $resp["sEcho"] = intval(@$_POST["sEcho"]);
        $resp["sColumns"] = "";
        $resp["aaData"] = $q2->getResult() ;
        header('Content-Type: application/json');
        echo json_encode($resp, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit(0);
    }
    public static function order(){
        // Individual column filtering
        $columnSearch = [];
        if ( isset( $_REQUEST['columns'] ) ) {
            foreach ($_REQUEST['columns'] as $index=>$column)
            {
                $data = $column['data'];
                $name = $column['name'];
                $searchable =$column['searchable'];
                $orderable = $column['orderable'];
                $search_key = $column['search']['value'];
                $search_regex = $column['search']['regex'];
                if($searchable == 'true' && !empty($search_key)){
                    $columnSearch[$data] = $search_key;
                }
            }
        }
        return $columnSearch;
    }
    public static function limit(){
        $sLimit = '';
        if(isset(self::$request["length"]) && intval(self::$request["length"]) > 0)
        {
            $sLimit =' LIMIT '.intval(@self::$request['start']).', '.intval(@self::$request['length']);
        }
        return $sLimit;
    }
    public static function column_search(){
        // Individual column filtering
        $columnSearch = [];
        if ( isset( self::$request['columns'] ) ) {
            foreach (self::$request['columns'] as $index=>$column)
            {
                $data = $column['data'];
                $name = $column['name'];
                $searchable =$column['searchable'];
                $orderable = $column['orderable'];
                $search_key = filter_var($column['search']['value'], FILTER_SANITIZE_STRING);
                $search_regex = $column['search']['regex'];
                if($searchable == 'true' && !empty($search_key) && strtolower($search_key)!='null'){
                    $columnSearch[] = self::field($data)." LIKE '%{$search_key}%' ESCAPE '!'";
                }
            }
            return count($columnSearch) > 0 ? '('.implode(' AND ',$columnSearch).' )':'';
        }
        return false;
    }
    /* Global Searching */
    public static function global_search(){
        $like = [];
        $match = @filter_var(@self::$request['search']['value'], FILTER_SANITIZE_STRING);
        if (!empty($match))
        {
            if ( isset( self::$request['columns'] ) ) {
                foreach (self::$request['columns'] as $index=>$column)
                {
                    $field = $column['data'];
                    $searchable = $column['searchable'];
                    if($searchable == 'true' && !empty($match) && strtolower($match)!='null'){
                        if(in_array($field, self::$field_list)||strrpos($field,'.'))
                        {
                            //definition avancée des colonnes
                            if(isset(self::$columns[$field])){
                                $field = self::$columns[$field];
                            }
                            $regex = explode('|',$match);
                            if(count($regex ) > 1){
                                foreach ($regex as $v){
                                    $like[] = self::field($field)." LIKE '%{$v}%' ESCAPE '!'";
                                }
                            }else{
                                $like[] = self::field($field)." LIKE '%{$match}%' ESCAPE '!'";
                            }

                        }
                    }
                }
                return (count($like) > 0)?'('.implode(' OR ',$like).' )':'';
            }
        }
        return false;
    }
    private static function field($field){
        //definition avancée des colonnes
        return (isset(self::$columns[$field])) ? self::$columns[$field]:$field;
    }
}
?>
