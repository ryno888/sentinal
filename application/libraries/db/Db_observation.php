<?php
/**
 * Description of lib
 *
 * @author Ryno
 */
class Db_observation extends Lib_db{
    
    public function __construct() {
        $this->set_key("obs_id");
        $this->set_table("observation");
        
        $this->set_fields_arr([
            "obs_id"                    => ["name" => "id"                      , "default" => "null"   , "type" => DB_INT],
            "obs_ref_person"            => ["name" => "person"                  , "default" => "null"   , "type" => DB_REFERENCE, "reference" => "person"],
            "obs_term"                  => ["name" => "term"                    , "default" => 0        , "type" => DB_TINYINT],
            "obs_info_evening"          => ["name" => "info evening"            , "default" => 0        , "type" => DB_TINYINT],
            "obs_report_discuss"        => ["name" => "report discuss"          , "default" => 0        , "type" => DB_TINYINT],
            "obs_other_meetings"        => ["name" => "other meetings"          , "default" => 0        , "type" => DB_TINYINT],
            "obs_message_book_signed"   => ["name" => "message book signed"     , "default" => 0        , "type" => DB_TINYINT],
            "obs_work_book_signed"      => ["name" => "work book signed"        , "default" => 0        , "type" => DB_TINYINT],
            "obs_homework"              => ["name" => "homework"                , "default" => 0        , "type" => DB_TINYINT],
            "obs_discipline"            => ["name" => "discipline"              , "default" => 0        , "type" => DB_TINYINT],
            "obs_adjustment"            => ["name" => "adjustment"              , "default" => 0        , "type" => DB_TINYINT],
            "obs_neatness"              => ["name" => "neatness"                , "default" => 0        , "type" => DB_TINYINT],
            "obs_days_absent"           => ["name" => "days absent"             , "default" => 0        , "type" => DB_INT],
            "obs_other_info"                 => ["name" => "other info"         , "default" => ""       , "type" => DB_TEXT],
        ]);
    }

    //----------------------------------------------------------------------------------------
    public $obs_term = [
        "" => "-- Not Selected --",
        1 => "Term 1",
        2 => "Term 2",
        3 => "Term 3",
        4 => "Term 4",
    ];
    //----------------------------------------------------------------------------------------
    public $obs_neatness = [
        "" => "-- Not Selected --",
        1 => "Yes/Good",
        2 => "Satisfactory",
        3 => "No/Weak",
    ];
    //----------------------------------------------------------------------------------------
    public $obs_adjustment = [
        "" => "-- Not Selected --",
        1 => "Yes/Good",
        2 => "Satisfactory",
        3 => "No/Weak",
    ];
    //----------------------------------------------------------------------------------------
    public $obs_discipline = [
        "" => "-- Not Selected --",
        1 => "Yes/Good",
        2 => "Satisfactory",
        3 => "No/Weak",
    ];
    //----------------------------------------------------------------------------------------
    public $obs_homework = [
        "" => "-- Not Selected --",
        1 => "Yes/Good",
        2 => "Satisfactory",
        3 => "No/Weak",
    ];
    //----------------------------------------------------------------------------------------
    public $obs_work_book_signed = [
        "" => "-- Not Selected --",
        1 => "Yes/Good",
        2 => "Satisfactory",
        3 => "No/Weak",
    ];
    //----------------------------------------------------------------------------------------
    public $obs_message_book_signed = [
        "" => "-- Not Selected --",
        1 => "Yes/Good",
        2 => "Satisfactory",
        3 => "No/Weak",
    ];
    //----------------------------------------------------------------------------------------
    public $obs_other_meetings = [
        "" => "-- Not Selected --",
        1 => "Yes/Good",
        2 => "Satisfactory",
        3 => "No/Weak",
    ];
    //----------------------------------------------------------------------------------------
    public $obs_report_discuss = [
        "" => "-- Not Selected --",
        1 => "Yes/Good",
        2 => "Satisfactory",
        3 => "No/Weak",
    ];
    //----------------------------------------------------------------------------------------
    public $obs_info_evening = [
        "" => "-- Not Selected --",
        1 => "Yes/Good",
        2 => "Satisfactory",
        3 => "No/Weak",
    ];
    //----------------------------------------------------------------------------------------
    public function get_available_terms($per_id){
        $term_item_arr = $this->obs_term;
        $existing_terms = Lib_database::selectlist("SELECT obs_id, obs_term FROM observation WHERE obs_ref_person = $per_id", "obs_id", "obs_term");
        
        foreach ($existing_terms as $obs_id => $obs_term) {
            if(array_key_exists($obs_term, $term_item_arr)){
                unset($term_item_arr[$obs_term]);
            }
        }
        return $term_item_arr;
    }
    //----------------------------------------------------------------------------------------
}
