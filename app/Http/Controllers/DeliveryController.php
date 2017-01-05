<?php
namespace larashop\Http\Controllers;

use Illuminate\Http\Request;
use larashop\Clients;
use larashop\Purchase;
use Mail;
use Setting;
use Spatie\Newsletter\Newsletter;
use Validator;

class DeliveryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //

        $data = ['NewOrderCounter' => Purchase::Neworders()->count()];
        return view('admin.message')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //

        $validator = Validator::make($request->all(), ['subj' => 'required', 'text' => 'required']);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {

            (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');

            $data = ['logoMain' => $logoMain, 'msg' => $request->text];

            $clients = Clients::all();
            $counter = 0;
            $counterTime = 5;
            foreach ($clients as $client) {

                $subj = $request->subj;
                $email = $client->email;

                if (++$counter % 5 === 0) {
                    $counterTime = $counterTime + 10;
                }

                Mail::later($counterTime, 'mail.message', $data, function ($message) use ($email, $subj) {

                    $message->from(Setting::get('config.email'), Setting::get('config.sitename'));
                    $message->subject($subj);
                    $message->to($email);
                });
            }

            $data = ['count' => $counter];

            Mail::later($counterTime, 'mail.messageSuccess', $data, function ($message) {
                $message->from(Setting::get('config.email'), Setting::get('config.sitename'));
                $message->subject('Рассылка завершена!');
                $message->to(Setting::get('config.email'));
            });
            // code...*/

            /*//dd($client->email);
            $subj=$request->subj;
            $email=$client->email;
            
            Mail::later(5, 'mail.message', $data, function ($message) use ($email,$subj) {
            
                $message->from(Setting::get('config.email') , Setting::get('config.sitename'));
                $message->subject($subj);
                $message->to($email);
            
            });*/

            //}

            $request->session()->flash('alert-success', 'Рассылка будет создана в ближайшее время!');
            return redirect('message');
        }
    }


    public function author(Newsletter $newsletter)
    {

        $test = $newsletter->getMembers('subscribers')['members'];
        $data = ['NewOrderCounter' => Purchase::Neworders()->count(), 'author' => $test];
        return view('admin.delivery.author')->with($data);
    }


//  display subscribers
    public function subscribers(Newsletter $newsletter)
    {

        $subscribers = $newsletter->getMembers('subscribers')['members'];
        $data = ['NewOrderCounter' => Purchase::Neworders()->count(), 'subscribers' => $subscribers];
        return view('admin.delivery.subscribers')->with($data);
    }

//  unsubscribe subscriber
    public function unsubscribe($email, Newsletter $newsletter, Request $request)
    {
        $newsletter->unsubscribe($email, config('laravel-newsletter.defaultListName'));
        $request->session()->flash('alert-success', 'Подписчик успешно отписан!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function campaigns(Newsletter $newsletter)
    {
        $campaigns = $newsletter->getCampaigns();
        if (isset($campaigns['status']) && isset($campaigns['detail'])) {
            exit($campaigns['detail']);
        } elseif ($campaigns == '') {
            exit('API MAILCHIMP временно недоступно');
        }
        $data = ['NewOrderCounter' => Purchase::Neworders()->count(), 'campaigns' => $campaigns];
        return view('admin.delivery.campaigns')->with($data);
    }

    public function campaignReports($id, Newsletter $newsletter)
    {
        $reports = $newsletter->getCampaignReports($id);
        $content = $newsletter->getCampaignTemplate($id);
        $campaign = $newsletter->getCampaign($id);
        $data = ['NewOrderCounter' => Purchase::Neworders()->count(), 'reports' => $reports, 'content' => $content, 'campaign' => $campaign];
        return view('admin.delivery.campaignReports')->with($data);
    }

    public function deleteCampaign($id, Newsletter $newsletter, Request $request)
    {
        $newsletter->deleteCampaign($id);
        $request->session()->flash('alert-success', 'Компания успешно удалена!');
    }

    public function createCampaign(Newsletter $newsletter)
    {
        $lists = $newsletter->getLists()['lists'];
        $templates = $newsletter->getTemplates()['templates'];
        $data = ['NewOrderCounter' => Purchase::Neworders()->count(), 'lists' => $lists, 'templates' => $templates];
        return view('admin.delivery.createCampaign', $data);
    }

    public function storeCampaign(Request $request, Newsletter $newsletter)
    {
        $validator = Validator::make($request->all(), ['title' => 'required|min:2']);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $response = $newsletter->createCampaign($data['from_name'], $data['reply_to'], $data['subject'], $data['title']);


//        return dd($response_campaign);
        if (isset($response['id'])) {
            $request->session()->flash('alert-success', 'Компания успешно создана!');
            return redirect(url('delivery/campaigns'));
        }
        else{
            $request->session()->flash('alert-success', 'Что-то пошло не так');
            return redirect()->back()->withInput();
        }

    }

    public function sendCampaign($id, Newsletter $newsletter, Request $request)
    {
        $newsletter->sendCampaign($id);
        $request->session()->flash('alert-success', 'Компания отослана');
        return redirect()->back();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //

    }
}
