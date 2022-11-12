<?php namespace App\Http\Controllers;

		use Session;
		use Request;
		use DB;
		use CRUDBooster;

		class ApiCreateReportController extends \crocodicstudio\crudbooster\controllers\ApiController {

		    function __construct() {    
				$this->table       = "gizi_reports";        
				$this->permalink   = "create_report";    
				$this->method_type = "post";
		    }
		

		    public function hook_before(&$postdata) {
		        //This method will be execute before run the main process

		    }

		    public function hook_query(&$query) {
				
		    }

		    public function hook_after($postdata,&$result) {
// get value from gizi_nutrition_foods where id_food=$postdata

				$value_nutrition_food = DB::table('gizi_nutrition_foods')->where('id_food',  Request::get('id_food'))->get('value');
				$id_nutritions_foods = DB::table('gizi_nutrition_foods')->where('id_food',  Request::get('id_food'))->get('');
		        //This method will be execute after run the main process
		        DB::table('total_nutritions_day')->insert([
					'id_food'=> Request::get('id_food'),
					'id_nutritions'=> Request::get($id_nutritions_foods),
					'id_user'=> Request::get('id_user'),
					'value'=> Request::get($value_nutrition_food),
					'date'=> now()
				]);
		    }

		}