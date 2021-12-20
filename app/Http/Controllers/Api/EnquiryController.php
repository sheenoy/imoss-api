<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEnquiryRequest;
use App\Models\{Enquiry};
use Illuminate\Support\Facades\Mail;
use App\Mail\EnquiryResponseToUser;

class EnquiryController extends Controller
{
    public function save(StoreEnquiryRequest $request) {

        $data = [
                    "name" => $request->get('name'),
                    "email" => $request->get('email'),
                    "phone" => $request->get('phone'),
                    "message" => $request->get('message'),
                ];
        $save_enquiry = Enquiry::insert($data);
        if ($save_enquiry) {
            try{
                $thank_you_email = Mail::to($request->get('email'))
                                    ->bcc("shoaib2fly@gmail.com")
                                    ->send(new EnquiryResponseToUser());
            } catch(\Exception $e) {

            }
            return response()->json(['message' => "Form submitted successfully!!"]);
        } else {
            return response()->json(['message' => "Oops! Server unreachable at the moment, please try again later"], 400);
        }
    }

}