<?php

namespace App\Http\Controllers;

use App\Address;
use App\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contacts = Contact::all();
        return $contacts;
    }

    public function search($search)
    {
        //
        if(isset($search) &&  strlen($search) > 0){
            $contacts = Contact::with(['address'])->where('name','LIKE',"%{$search}%")->get();
        }else{
            $contacts = Contact::all();
        }

        return $contacts;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ContactRequest $request)
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $contact = new Contact();
        $contact->name= $request->get('name');
        $contact->surname= $request->get('surname');
        $contact->nameComplete= $contact->name." ".$contact->surname;
        $contact->age= $request->get('age');
        $contact->siteWeb= $request->get('siteWeb');
        if ( $request->get('dateOfBirth')!= null){
            $dateOfBirth = Carbon::createFromFormat('d/m/Y', $request->get('dateOfBirth'));
            $contact->dateOfBirth = $dateOfBirth;
        }
        $contact->save();
        if (!is_null($request->get('addresses'))) {
            $addressesNew = [];
            $addresses = $request->get('addresses');
            foreach ($addresses as $k) {
                $address = new  Address();
                $address->street = $k['street'];
                $address->state =$k['state'];
                $address->city = $k['city'];
                $address->postalCode = $k['postalCode'];
                $address->save();
                array_push($addressesNew, $address);
            }
            $contact->addresses()->saveMany($addressesNew);
        }
        return $contact->load('addresses');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $contact = Contact::with('address')->where('id',$id)->first();
        return $contact;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $contact = Contact::with('address')->where('id',$id)->first();
        return $contact;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, $id)
    {
        //

        $contact = Contact::with(['address'])->where('id',$id)->first();

        // $contact->address()->street = $request->get('street');
        // $contact->address()->state = $request->get('state');
        // $contact->address()->city = $request->get('city');
        // $contact->address()->postalCode = $request->get('postalCode');

        $contact->name= $request->get('name');
        $contact->surname= $request->get('surname');
        $contact->nameComplete= $request->get('nameComplete');
        $contact->dateOfBirth= $request->get('dateOfBirth');
        $contact->age= $request->get('age');
        $contact->email= $request->get('email');
        $contact->celphone= $request->get('celphone');
        $contact->telphone= $request->get('telphone');
        $contact->work= $request->get('work');
        $contact->siteWeb= $request->get('siteWeb');
        $contact->save();

        return $contact;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $contact = Contact::find($id);
        $contact->delete();
        return $contact;
    }
}
