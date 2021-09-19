<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';   //默认使用类名复数形式的数据表，如不是则需要标明指明
    protected $primaryKey = 'id';   //默认id是主键，如不是则需要指明
    public $timestamps =false; //是否使用时间戳；默认true
/*    protected function getDateFormat() {    //使用Unix时间戳存入数据库
        return time();
    }*/
/*    protected function asDatetime($val) {   //取出Unix时间戳时不做转换为日期，直接输出一串数值，可自行转化
        return $val;
    }*/
    protected $guarded=[];  //设置黑名单(不允许批量赋值的字段)，为了使用在控制器中使用create()
    #protected $fillable = ['name', 'age']; //允许批量赋值的字段 白名单设置


    public function fromDateTime($val)
    {
        return empty($val)?$val:$this->getDateFormat() ;
    }
}

