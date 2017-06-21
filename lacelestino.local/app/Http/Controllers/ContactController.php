<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Mail\ContactsMail;
use Mail;

class ContactController extends AppController
{

    public function __construct( ) {
        parent::__construct();
        $this->dirResource = 'contact';
        $this->template = $this->dirResource . '.index';
    }
    
    public function index(Request $request) {
        if ($request->isMethod('post')) {
            $messages = [
                'required' => 'Поле :attribute обязательно к заполнению',
                'email' => 'Поле :attribute должно содержать правильный email адрес',
            ];
            
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'message' => 'required'
            ] ,$messages );
            $data = $request->all();
            Mail::to( env('MAIL_ADMIN') )->send( new ContactsMail($data) );

            /*$result = Mail::send( $this->dirResource. '.email', ['data' => $data], function ($m) use ($data) {
                $m->from($data['email'], $data['name']);
                $m->to( 's@mail.ru' , 'Mr. Admin')->subject('Question');
            });*/

            return redirect()->route('contacts')->with('status', 'Письмо отправлено');
        }
        $this->out['page_meta'] = view($this->dirResource . '.page_meta')->render();
        $this->out['content'] = view($this->dirResource . '.content')->render();
        
        return $this->renderOutput();
    }
}
