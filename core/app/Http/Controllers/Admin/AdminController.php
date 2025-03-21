<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\CurlRequest;
use App\Models\AdminNotification;
use App\Models\CouponCode;
use App\Models\Deposit;
use App\Models\GiftItem;
use App\Models\GiftOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\UserLogin;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{


    public function user_delete(request $request)
    {

        User::where('id', $request->id)->delete();
        return back()->with('message', "User deleted successfully");

    }




    public function gift_view(request $request)
    {

        $data['pageTitle'] = "Gift";
        $data['gift_items'] = GiftItem::paginate('5');
        $data['gift_orders'] = GiftOrder::with('user')->paginate('10');


        return view('admin.gift', $data);

    }



    public function gift_delete(request $request)
    {

        $data['pageTitle'] = "Gift";
        $data['gift_items'] = GiftItem::where('id', $request->id)->delete();
        return back()->with('message', "Gift has been successfully deleted");


        return view('admin.gift', $data);

    }




    public function gift_update(request $request)
    {

        $file = $request->file('image');
        $receipt_fileName = date("ymis") . $file->getClientOriginalName();
        $directory = date("Y")."/".date("m")."/".date("d");
        $path = getFilePath('verify').'/'.$directory;
        $request->image->move($path, $receipt_fileName);
        $url = url('')."/".$path."/".$receipt_fileName;



        GiftItem::where('id', $request->id)->update([

            'title'=> $request->title,
            'image'=> $url,

        ]);

        $data['gift_items'] = GiftItem::all();
        return back()->with('message', "Gift has been successfully updated");

    }


    public function order_gift_delete(request $request)
    {
        GiftOrder::where('id', $request->id)->delete();
        return back()->with('message', "Order has been deleted successfully");


    }



    public function order_gift_update(request $request)
    {

        GiftOrder::where('id', $request->id)->update([
            'status' => $request->status
        ]);

        return back()->with('message', "Order has been successfully updated");



    }




    public function new_gift(request $request)
    {
        $file = $request->file('image');
        $receipt_fileName = date("ymis") . $file->getClientOriginalName();
        $directory = date("Y")."/".date("m")."/".date("d");
        $path = getFilePath('verify').'/'.$directory;
        $request->image->move($path, $receipt_fileName);
        $url = url('')."/".$path."/".$receipt_fileName;


        $cup = new GiftItem();
        $cup->title = $request->title;
        $cup->image = $url;
        $cup->save();
        return back()->with('message', 'Gift Item Created Successfully');

    }




    public function coupon(request $request)
    {

        $data['pageTitle'] = "Coupon";
        $data['coupons'] = CouponCode::where('id', 2)->first() ?? null;

        return view('admin.coupon', $data);

    }

    public function new_coupon(request $request)
    {

        $cup = new CouponCode();
        $cup->coupon_code = $request->coupon_code;
        $cup->amount = $request->amount;
        $cup->save();
        return back()->with('message', 'Cuopon Created Successfully');

    }

    public function update_coupon(request $request)
    {
        CouponCode::where('id', $request->id)->update
        ([
            'coupon_code' => $request->coupon_code,
            'amount' => $request->amount,
            'status' => $request->status
        ]);

        return back()->with('message', 'Cuopon Updated Successfully');

    }


    public function delete_coupon(request $request)
    {
        CouponCode::where('id', $request->id)->delete();
        return back()->with('message', 'Cuopon Deleted Successfully');

    }



    public function dashboard()
    {
        $pageTitle = 'Dashboard';

        // User Info
        $widget['total_users']             = User::count();
        $widget['verified_users']          = User::active()->count();
        $widget['email_unverified_users']  = User::emailUnverified()->count();
        $widget['mobile_unverified_users'] = User::mobileUnverified()->count();

        $widget['total_orders'] = Order::count();
        $widget['total_paid_orders'] = Order::paid()->count();
        $widget['total_unpaid_orders'] = Order::unpaid()->count();
        $widget['total_products'] = Product::count();


        // user Browsing, Country, Operating Log
        $userLoginData = UserLogin::where('created_at', '>=', Carbon::now()->subDay(30))->get(['browser', 'os', 'country']);

        $chart['user_browser_counter'] = $userLoginData->groupBy('browser')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $chart['user_os_counter'] = $userLoginData->groupBy('os')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $chart['user_country_counter'] = $userLoginData->groupBy('country')->map(function ($item, $key) {
            return collect($item)->count();
        })->sort()->reverse()->take(5);


        $deposit['total_deposit_amount']        = Deposit::successful()->sum('amount');
        $deposit['total_deposit_pending']       = Deposit::pending()->count();
        $deposit['total_deposit_rejected']      = Deposit::rejected()->count();
        $deposit['total_deposit_charge']        = Deposit::successful()->sum('charge');

        // Monthly Payment
        $report['months'] = collect([]);
        $report['deposit_month_amount'] = collect([]);

        $depositsMonth = Deposit::where('created_at', '>=', Carbon::now()->subYear())
            ->where('status', Status::PAYMENT_SUCCESS)
            ->selectRaw("SUM( CASE WHEN status = ".Status::PAYMENT_SUCCESS." THEN amount END) as depositAmount")
            ->selectRaw("DATE_FORMAT(created_at,'%M-%Y') as months")
            ->orderBy('created_at')
            ->groupBy('months')->get();

        $depositsMonth->map(function ($depositData) use ($report) {
            $report['months']->push($depositData->months);
            $report['deposit_month_amount']->push(getAmount($depositData->depositAmount));
        });

        $months = $report['months'];

        for($i = 0; $i < $months->count(); ++$i) {
            $monthVal      = Carbon::parse($months[$i]);
            if(isset($months[$i+1])){
                $monthValNext = Carbon::parse($months[$i+1]);
                if($monthValNext < $monthVal){
                    $temp = $months[$i];
                    $months[$i]   = Carbon::parse($months[$i+1])->format('F-Y');
                    $months[$i+1] = Carbon::parse($temp)->format('F-Y');
                }else{
                    $months[$i]   = Carbon::parse($months[$i])->format('F-Y');
                }
            }
        }
        return view('admin.dashboard', compact('pageTitle', 'widget', 'chart','deposit','depositsMonth','months'));
    }


    public function profile()
    {
        $pageTitle = 'Profile';
        $admin = auth('admin')->user();
        return view('admin.profile', compact('pageTitle', 'admin'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'image' => ['nullable','image',new FileTypeValidate(['jpg','jpeg','png'])]
        ]);
        $user = auth('admin')->user();

        if ($request->hasFile('image')) {
            try {
                $old = $user->image;
                $user->image = fileUploader($request->image, getFilePath('adminProfile'), getFileSize('adminProfile'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $notify[] = ['success', 'Profile updated successfully'];
        return to_route('admin.profile')->withNotify($notify);
    }

    public function password()
    {
        $pageTitle = 'Password Setting';
        $admin = auth('admin')->user();
        return view('admin.password', compact('pageTitle', 'admin'));
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = auth('admin')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notify[] = ['error', 'Password doesn\'t match!!'];
            return back()->withNotify($notify);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $notify[] = ['success', 'Password changed successfully.'];
        return to_route('admin.password')->withNotify($notify);
    }

    public function notifications(){
        $notifications = AdminNotification::orderBy('id','desc')->with('user')->paginate(getPaginate());
        $pageTitle = 'Notifications';
        return view('admin.notifications',compact('pageTitle','notifications'));
    }


    public function notificationRead($id){
        $notification = AdminNotification::findOrFail($id);
        $notification->is_read = Status::YES;
        $notification->save();
        $url = $notification->click_url;
        if ($url == '#') {
            $url = url()->previous();
        }
        return redirect($url);
    }

    public function requestReport()
    {
        $pageTitle = 'Your Listed Report & Request';
        $arr['app_name'] = systemDetails()['name'];
        $arr['app_url'] = env('APP_URL');
        $arr['purchase_code'] = env('PURCHASECODE');
        $url = "https://license.viserlab.com/issue/get?".http_build_query($arr);
        $response = CurlRequest::curlContent($url);
        $response = json_decode($response);
        if ($response->status == 'error') {
            return to_route('admin.dashboard')->withErrors($response->message);
        }
        $reports = $response->message[0];
        return view('admin.reports',compact('reports','pageTitle'));
    }

    public function reportSubmit(Request $request)
    {
        $request->validate([
            'type'=>'required|in:bug,feature',
            'message'=>'required',
        ]);
        $url = 'https://license.viserlab.com/issue/add';

        $arr['app_name'] = systemDetails()['name'];
        $arr['app_url'] = env('APP_URL');
        $arr['purchase_code'] = env('PURCHASECODE');
        $arr['req_type'] = $request->type;
        $arr['message'] = $request->message;
        $response = CurlRequest::curlPostContent($url,$arr);
        $response = json_decode($response);
        if ($response->status == 'error') {
            return back()->withErrors($response->message);
        }
        $notify[] = ['success',$response->message];
        return back()->withNotify($notify);
    }

    public function readAll(){
        AdminNotification::where('is_read',Status::NO)->update([
            'is_read'=>Status::YES
        ]);
        $notify[] = ['success','Notifications read successfully'];
        return back()->withNotify($notify);
    }

    public function downloadAttachment($fileHash)
    {
        $filePath = decrypt($fileHash);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $title = slug(gs('site_name')).'- attachments.'.$extension;
        $mimetype = mime_content_type($filePath);
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($filePath);
    }


}
