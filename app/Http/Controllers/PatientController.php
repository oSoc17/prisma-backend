<?php

namespace App\Http\Controllers;

use Validator;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();

        return $patients;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->exception($validator->errors(), 400);
        }

        $profile = new Patient;
        $profile->firstname = $request->input('firstName');
        $profile->lastname = $request->input('lastName');
        $profile->care_home = $request->input('carehome');
        $profile->date_of_birth = $request->input('dateOfBirth');
        $profile->birth_place = $request->input('birthPlace');
        $profile->location = $request->input('location');

        $patient->save();

        $createdPatient = [
            'id' => $patient->id,
            'firstName' => $patient->firstname,
            'lastName' => $patient->lastname,
            'carehome' => $patient->care_house,
            'dateOfBirth' => $patient->date_of_birth,
            'birthPlace' => $patient->birth_place,
            'location' => $patient->location
        ];

        $location = $request->url() . '/' . $profile->id;
        return response()->success($createdPatient, 201, 'Created', $location);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($patientId)
    {
        try {
            Patient::findOrFail($patientId);
        } catch (ModelNotFoundException $e) {
            $failingResource = class_basename($e->getModel());
            return response()->exception("There is no $failingResource resource with the provided id.", 400);
        }

        $patient = Patient::find($patientId)->first();
        $gotPatient = [
            'id' => $patient->id,
            'firstName' => $patient->firstname,
            'lastName' => $patient->lastname,
            'carehome' => $patient->care_home,
            'dateOfBirth' => $patient->date_of_birth,
            'birthPlace' => $patient->birth_place,
            'location' => $patient->location,
            'createdAt' => $patient->created_at
        ];

        return response()->success($gotPatient, 200, 'OK');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(patient $patient)
    {
        //
    }
}
