<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Mail\ContactMail;
use Mail;

class ContactController extends AppController
{
    public function __construct( ) {
        parent::__construct();
        $this->dirResource = 'contact';
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
                'comment' => 'required'
            ] ,$messages );
            
            $data = $request->all();
            
            Mail::to( env('MAIL_ADMIN') )->send( new ContactMail($data) );
            
            return redirect()->route('contacts')->with('status', 'Письмо отправлено');
        }

        $this->out['content'] = view($this->dirResource . '.content')->render();
        
        return $this->renderOutput();
    }
    
}
