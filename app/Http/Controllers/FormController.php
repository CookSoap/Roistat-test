<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Client;

class FormController extends Controller
{   
    public function index() {
        return view('form');
    }

    public function send(Request $request) 
    {
        $request->validate([
            'name'  => ['required', 'string'],   
            'email' => ['required', 'string', 'email'],       
            'phone' => ['required', 'size:11'],
            'price' => ['required', 'integer'],   
        ]);

        $access_token = '';
        $domen        = '';

        $data = [[
                    "price"  => (int) request()->input('price'),
                    "custom_fields_values" => [[
                        "field_id" => 516923,
                            "values" => [[
                            "value"  => request()->input('moreThanThirty'), 
                        ]]
                    ]],
                    "_embedded" =>  [
                        "contacts"  => [[
                            "name" => request()->input('name'),
                            "custom_fields_values" => [  
                            ["field_id" => 546757,
                                "values" => [[
                                "value"  =>  request()->input('email'),
                                ]]
                            ],
                            ["field_id" => 546695,
                                "values" => [[
                                "value"  => request()->input('phone'), ]
                                ]]
                            ]
                        ]] 
                    ]
                ]];

        $response = Http::withoutVerifying()
        ->withHeaders([
                'Authorization' => "Bearer $access_token",
            ])
        ->withBody(json_encode($data), 'application/json')
        ->post("https://$domen.amocrm.ru/api/v4/leads/complex");
        
        if(isset($response->json()[0]['id'])) {
            return redirect( route('form.index') )->with('success', 'Форма успешно отправлена');
        }
       
        return redirect( route('sending.create') )->withErrors([
            'formError' => 'Ошибка отправки формы'
        ]); 
    }
}