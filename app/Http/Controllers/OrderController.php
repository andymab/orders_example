<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //admin показываем все заявки
        //manager только тe где его id =  manager_id
        //user только тe где его id =  user_id
        if (Auth::user()->is_Admin()) {
            $orders = DB::table('orders')
                ->where('status', '=', 'Active')
                ->leftJoin('users', 'orders.user_id', '=', 'users.id')
                ->leftJoin('users as user_manager', 'orders.manager_id', '=', 'user_manager.id')
                ->select('orders.*', 'user.name as user_name', 'user_manager.name as manager_name')
                ->get();
            return view('orders.index', compact('orders'));
        } elseif (Auth::user()->is_Manager()) {
            $orders = DB::table('orders')
                ->where('status', '=', 'Active')
                ->where('manager_id', '=', Auth::user()->id)
                ->leftJoin('users', 'orders.user_id', '=', 'users.id')
                ->leftJoin('users as user_manager', 'orders.manager_id', '=', 'user_manager.id')
                ->select('orders.*', 'user.name as user_name', 'user_manager.name as manager_name')
                ->get();
            return view('orders.index', compact('orders'));
        } else {
            $orders = DB::table('orders')
                ->where('status', '=', 'Active')
                ->where('user_id', '=', Auth::user()->id)
                ->leftJoin('users', 'orders.user_id', '=', 'users.id')
                ->leftJoin('users as user_manager', 'orders.manager_id', '=', 'user_manager.id')
                ->select('orders.*', 'user.name as user_name', 'user_manager.name as manager_name')
                ->get();
            return view('orders.index', compact('orders'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $element = new stdClass();
        return view('orders.create', compact('element'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = User::where('role', '=', 'admin')->first();
        $order =  new Order();
        $order->user_id = Auth::user()->id;
        $order->manager_id = $admin;
        $order->status = 'Active';
        $order->message = $request->message;
        $order->comment = '';
        $order->save();
        return redirect(route('orders.show', $order->id))->with('success', 'Заявка успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $element_order = DB::table('orders')
            ->where('orders.id', '=', $id)
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('users as user_manager', 'orders.manager_id', '=', 'user_manager.id')
            ->select('orders.*', 'user.name as user_name', 'user_manager.name as manager_name')
            ->first();
        return view('orders.show', compact('element_order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $element = DB::table('orders')
            ->where('orders.id', '=', $id)
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('users as user_manager', 'orders.manager_id', '=', 'user_manager.id')
            ->select('orders.*', 'user.name as user_name', 'user_manager.name as manager_name')
            ->first();
        return view('orders.edit', compact('element'));
        //далее для админа кинем еще менеджеров для выбора
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $el_db =  Order::where('id', $id)->first();

        if (!Auth::user()->is_Manager() and !Auth::user()->is_Admin()) {
            if ($el_db->user_id != Auth::user()->id) {
                return redirect(route('oredrs.show', $el_db->id))->with('success', 'Вы не можете изменить эту заявку');
            }
        }
        if (Auth::user()->is_Manager() and  $el_db->manager_id != Auth::user()->id) {
            return redirect(route('oredrs.show', $el_db->id))->with('success', 'За вами не закреплена эта заявка, Вы не можете изменить эту заявку');
        }

        //$el_db->manager_id = $request->manager_id; для админа
        if ((Auth::user()->is_Manager() or Auth::user()->is_Admin()) and $request->comment) {
            $el_db->comment = $request->comment;
            $el_db->status = 'Resolved';
        } else {
            $el_db->status = 'Active';
        }
        $el_db->message = $request->message;
        $el_db->update();
        return redirect(route('oredrs.show', $el_db->id))->with('success', 'Заявка успешно обновленна');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $el_db =  Order::where('id', $id)->first();
        if (!Auth::user()->is_Admin()) {
            if ($el_db->user_id != Auth::user()->id) {
                return redirect(route('oredrs.show', $el_db->id))->with('success', 'Вы не можете удалить эту заявку');
            }
        }
        $el_db->delete();
        return redirect(route('orders.index'))->with('success', 'Заявка успешно удалена');
    }
}
