<?php

namespace App\Models\Users;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Auth;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable,
        CanResetPassword,
        EntrustUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','last_name','postal_code', 'email', 'password', 'status', 'username', 'avatar', 'provider', 'provider_id', 'address', 'city', 'province', 'phone', 'mob_phone','activation_code'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'activation_code'];
    protected $appends = ['is_active'];

    public function getIsActiveAttribute() {
        $status = $this->attributes['status'];
        if ($status == '1') {
            return '<i class="label label-success">Active</i>';
        }
        return '<i class="label label-default">In-Active</i>';
    }

    public function accountIsActive($code) {
        $user = User::where('activation_code', '=', $code)->first();
        $user->status = 1;
        $user->activation_code = '';
        if ($user->save()) {
            Auth::login($user);
        }
        return true;
    }

//    public function scopeDtUser($query) {
//        $aColumns = array('id', 'name', 'email', 'display_name');
//        $rResult = $query->groupBy('product.id')->leftJoin('product_category as category', 'category.id', '=', 'product.id_category')
//                ->leftJoin('product_img as gambar', 'product.id', '=', 'gambar.id_product')
//                ->select(DB::raw("SQL_CALC_FOUND_ROWS product.id,product.product_name,product.product_price,product.status,gambar.path_thumb,IFNULL(category.name,'') AS name"));
//        /* Indexed column (used for fast and accurate table cardinality) */
//        $sIndexColumn = "id";
//        /*
//         * Paging
//         */
//        $sLimit = '';
//        if (Request::has('iDisplayStart') && Request::get('iDisplayLength') != '-1') {
//            $rResult = $rResult->skip(Request::get('iDisplayStart'))->take(Request::get('iDisplayLength'));
////            $sLimit = "LIMIT " . intval(Request::get('iDisplayStart')) . ", " .
////                    intval(Request::get('iDisplayLength'));
//        }
//        /*
//         * Ordering
//         */
//        $sOrder = "";
//        if (Request::has('iSortCol_0')) {
//            $sOrder = "ORDER BY  ";
//            for ($i = 0; $i < intval(Request::get('iSortCol_0')); $i++) {
//                if (Request::get('bSortable_' . intval(Request::get('iSortCol_' . $i))) == "true") {
////                    $sOrder .= "`" . $aColumns[intval(Request::get('iSortCol_' . $i))] . "` " .
////                            (Request::get('sSortDir_' . $i) === 'asc' ? 'asc' : 'desc') . ", ";
//                    $rResult = $rResult->orderBy($aColumns[intval(Request::get('iSortCol_' . $i))], (Request::get('sSortDir_' . $i) === 'asc' ? 'asc' : 'desc'));
//                }
//            }
//            $sOrder = substr_replace($sOrder, "", -2);
//            if ($sOrder == "ORDER BY") {
//                $sOrder = "";
//            }
//        }
//        /*
//         * Filtering
//         * NOTE this does not match the built-in DataTables filtering which does it
//         * word by word on any field. It's possible to do here, but concerned about efficiency
//         * on very large tables, and MySQL's regex functionality is very limited
//         */
//        $sWhere = "";
//        if (Request::has('sSearch') && Request::get('sSearch') != "") {
//            //           $sWhere = "WHERE (";
//            $rResult = $rResult->orWhere(function($query) use ($aColumns) {
//                for ($i = 0; $i < count($aColumns); $i++) {
////                    $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . Request::get('sSearch') . "%' OR ";
//                    if ($aColumns[$i] == 'id') {
//                        $aColumns[$i] = 'product.id';
//                    }
//                    $query->orWhere($aColumns[$i], 'LIKE', '%' . Request::get('sSearch') . '%');
//                }
//            });
////            $sWhere = substr_replace($sWhere, "", -3);
////            $sWhere .= ')';
//            //          dd($sWhere);
//        }
//        /* Individual column filtering */
//        for ($i = 0; $i < count($aColumns); $i++) {
//            if (Request::has('bSearchable_' . $i) && Request::get('bSearchable_' . $i) == "true" && Request::get('sSearch_' . $i) != '') {
//                if ($sWhere == "") {
//                    $sWhere = "WHERE ";
//                } else {
//                    $sWhere .= " AND ";
//                }
//                $rResult = $rResult->where($aColumns, 'LIKE', '%' . Request::get('sSearch_' . $i) . '%');
//            }
//        }
////        $rResult = DB::select("SELECT SQL_CALC_FOUND_ROWS `" . str_replace(" , ", " ", implode("`, `", $aColumns)) . "`
////		FROM   product
////		$sWhere
////		$sOrder
////		$sLimit
////		");
//        $rResult = $rResult->get();
//        $sQuery = DB::select("
//		SELECT FOUND_ROWS() as row
//	");
//        $iFilteredTotal = $sQuery[0]->row;
//        $aResultTotal = DB::select("
//		SELECT COUNT(`id`) as countid
//		FROM  users
//	");
//        $iTotal = $aResultTotal[0]->countid;
//        /*
//         * Output
//         */
//        $output = [
//            "sEcho" => intval(Request::get('sEcho')),
//            "iTotalRecords" => $iTotal,
//            "iTotalDisplayRecords" => $iFilteredTotal,
//            "aaData" => []
//        ];
//        foreach ($rResult->toArray() as $aRow) {
//            $row = [];
//            for ($i = 0; $i < count($aColumns); $i++) {
//                if ($aColumns[$i] == "version") {
//                    /* Special output formatting for 'version' column */
//                    $row[] = ($aRow[$aColumns[$i]] == "0") ? '-' : $aRow[$aColumns[$i]];
//                } else if ($aColumns[$i] != ' ') {
//                    /* General output */
//                    $row[$aColumns[$i]] = $aRow[$aColumns[$i]];
//                }
//            }
//            $output['aaData'][] = $row;
//        }
//        return $output;
//    }
}
