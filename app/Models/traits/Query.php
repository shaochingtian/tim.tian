<?php
namespace App\Models\traits;
use App\Models\User;

trait Query
{
    //查询，并在Base.php中被引用
    public function search($request,$qname) {
        $kw = $request->get('kw', '');    //搜索
        $datemin = !empty($request->get('datemin')) ? $request->get('datemin') : '2021-09-01';
        $datemax = !empty($request->get('datemax')) ? $request->get('datemax') : date('Y-m-d');
        $datemin .= ' 00:00:00';
        $datemax .= ' 23:59:59';
        #dump($datemin);

        //排序，报错？？？
        #$order = $request->get('order')[0];    //得到排序的序号和规则
        #$dir = $request->get('columns')[$order['column']['data']]; //以序号为数组的字段

        $map = [];
        if ($kw) {
            $map[] = [$qname, 'like', "%{$kw}%"];
        }
        //查询对象
        $query = $this::whereBetween('created_at', [$datemin, $datemax])->where($map);
        #dump($query);
        #dump(get_class_methods($query));   //查询类的全部方法

        return [
            'draw'=>$request->get('draw'),  //客户端调用服务器端次数标识
            'recordsTotal'=>$query->count(), //获取记录总数，为记录总条数
            'recordsFiltered'=>$query->count(), //数据过滤后的总数，为记录总条数，同上
            #'data'=>User::orderBy($dir,$order['dir'])->offset($request->get('start'))->limit($request->get('length'))->get(),  //获取的具体数据
            'data'=>User::offset($request->get('start'))->limit($request->get('length'))->withTrashed()->get()
                                                                                    //withTrashed()显示软删除的用户
        ];
    }
}
