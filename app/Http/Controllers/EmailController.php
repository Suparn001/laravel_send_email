<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\welcomeemail;
class EmailController extends Controller
{
    public function sendEmail(){
        //$toEmail = "suparngautam@yopmail.com";
        $message= "Hi, Welcome to mail";
        $subject="WELCOME";
        $details = [
            'name' =>'gautam',
            'product'=>'test product',
            'price'=>250
          

        ];
        $emails= ['a@yopmail.com','b@yopmail.com','c@yopmail.com','d@yopmail.com','e@yopmail.com','f@yopmail.com'];
        foreach($emails as $sending){
            $request = Mail::to($sending)->send(new welcomeemail($message,$subject,$details));       
        }
      
           dd($request);   
    }

    public function contact(){
        return view('contact');
    }

    public function sendContactEmail(Request $request){
             $request->validate([
                'name'=>'required|max:255',
                'image'=>'required|mimes:jpg, jpeg, png|max:2048'

             ]);

             $fileName = time().'.'.$request->file('image')->extension();
             $request->file('image')->move('uploads',$fileName);
             $guest = 'suparngautam@zapbuild.com';
             $response = Mail::to($guest)->send(new welcomeemail($request->all(),$fileName )); 
             if($response){
                return back()->with('success', "thanks for contacting us");
             }else{
                return back()->with('error',"not fulfilled");
             }

             //dd($fileName);
    }
}
