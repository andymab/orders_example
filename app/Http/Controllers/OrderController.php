<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Mail\OrderMailer;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
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
    public function index(Request $request)
    {
        //admin показываем все заявки
        //manager только тe где его id =  manager_id
        //user только тe где его id =  user_id
        //также работа с фильтрами запроса

        $orderBy = ['updated_at DESC']; // default
        $sort_date = ['desc' => 'DESC', 'asc' => 'ASC'];
        if ($date_key =  filter_input(INPUT_GET, 'date_sort')) {
            if (array_key_exists($date_key, $sort_date)) {
                $orderBy = ['updated_at ' . $sort_date[$date_key]];
            }
        }

        $where = [];
        // $where[] = ['status', '=', 'Active']; // default это будет сразу убирать кучи мусора и облегчать запрос
        $status_where = ['Resolved', 'Active'];
        if ($status_key =  filter_input(INPUT_GET, 'status')) {
            if (in_array($status_key, $status_where)) {
                $where[] = ['status', '=', $status_key];
            }
        }

        $date_first = '1970-01-01'; //выставить квартал или год
        $date_last  = date('Y-m-d');
        if ($date_first_key =  filter_input(INPUT_GET, 'date_first')) {
            $date_first =  $date_first_key;
        }
        if ($date_last_key =  filter_input(INPUT_GET, 'date_last')) {
            $date_last =  $date_last_key;
        }


        if (Auth::user()->is_Manager()) {
            $where[] = ['manager_id', '=', Auth::user()->id];
        } elseif(Auth::user()->is_User()) {
            $where[] = ['user_id', '=', Auth::user()->id];
        }

        $orders = DB::table('orders')
            ->where($where)
            ->whereDate('orders.updated_at', '<=', $date_last)
            ->whereDate('orders.updated_at', '>=', $date_first)
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('users as user_manager', 'orders.manager_id', '=', 'user_manager.id')
            ->select('orders.*', 'users.name as user_name', 'user_manager.name as manager_name')
            ->orderByRaw(implode(", ", $orderBy))
            ->paginate(7);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $element = false;
        $managers = false;
        return view('orders.create', compact('element', 'managers'));
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
        $order->manager_id = $admin->id;
        $order->status = 'Active';
        $order->message = $request->message;
        $order->comment = '';
        $order->save();
        $mail = new stdClass;
        $mail->name = Auth::user()->name;
        $mail->message = $order->message ."<br><br> Ваша заявка будет обработана нашими менеджерами в ближайшее время";
        $mail->subject = "Вы оставили у нас заявку";

        Mail::to(Auth::user()->email)->send(new OrderMailer($mail));
        return redirect(route('orders.show', $order->id))->with('success', 'Заявка успешно создана, уведомление отправлено на почту');
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
            ->select('orders.*', 'users.name as user_name', 'user_manager.name as manager_name')
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
        $managers = false;
        if (Auth::user()->is_Admin()) {
            $managers = DB::table('users')
                ->where('role', '=', 'manager')
                //->where('role', '=', 'admin')
                ->get();
        }

        $element = DB::table('orders')
            ->where('orders.id', '=', $id)
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('users as user_manager', 'orders.manager_id', '=', 'user_manager.id')
            ->select('orders.*', 'users.name as user_name', 'user_manager.name as manager_name')
            ->first();
        return view('orders.edit', compact('element', 'managers'));
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

        $validated = $request->validate([
            'message' => 'required|min:15',
        ]);
$message = "";
        $el_db =  Order::where('id', $id)->first();

        if (!Auth::user()->is_Manager() and !Auth::user()->is_Admin()) {
            if ($el_db->user_id != Auth::user()->id) {
                return redirect(route('orders.show', $el_db->id))->with('success', 'Вы не можете изменить эту заявку');
            }
        }
        if (Auth::user()->is_Manager() and  $el_db->manager_id != Auth::user()->id) {
            return redirect(route('orders.show', $el_db->id))->with('success', 'За вами не закреплена эта заявка, Вы не можете изменить эту заявку');
        }

        //$el_db->manager_id = $request->manager_id; для админа
        $el_db->status = 'Active';
        $el_db->comment = '';

        if ((Auth::user()->is_Manager() or Auth::user()->is_Admin()) and $request->comment) {
            $el_db->comment = $request->comment;
            $el_db->status = 'Resolved';
            $user = USER::find($el_db->user_id);
            $mail = new stdClass;
            $mail->name = $user->name;
            $mail->message = $el_db->comment ;
            $mail->subject = "Ответ на Вашу заявку от " . Auth::user()->name;
            Mail::to($user->email)->send(new OrderMailer($mail));
            $message = " письмо отправлено $user->email ";
        }
        if (Auth::user()->is_Admin()) {
            $el_db->manager_id = $request->manager;
        }
        $el_db->message = $request->message;
        $el_db->update();
        return redirect(route('orders.show', $el_db->id))->with('success', 'Заявка успешно обновленна');
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
