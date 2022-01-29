<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class Categoriecontoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//avec get
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //avec post
    {
        $validataire= Validator::make($request->all(),[
'name'=>'required',
'logo'=>'required|unique:Categories'
        ]);
            if($validataire->fails()){
            return response()->json($validataire->getMessageBag(),422);
            }
        $model= new Category();
        $model->name=$request->name;
        $model->logo=$request->logo;
        $model->save();
        return response()->json($model);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)//get
    {
        $model=Category::find($id);
        if($model==null){
            return response()->json(["L'id ne correspond à aucune information"],404);// fails verifier s'il ya echec
        }
        return response()->json($model);
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
        $data=array();
        $model=new Category();
        $fillable=$model->getFillable();//récupérer les champs modifiables
        $requests=$request->all();//récupérer tous les champs envoyés
        foreach ($requests as $key => $value) {
            if(in_array($key,$fillable)){
                $data[$key]=$value;
            }
        }
        $validation=Validator::make($data,[
            'name'=>'min:1',
            'logo'=>'min:1'
            //rule definie la regle
        ]);
        if($validation->fails()){
            return response()->json($validation->getMessageBag(),422);// fails verifier s'il ya echec
        }
        $model=Category::find($id);
        if($model==null){
            return response()->json(["L'id ne correspond à aucune information"],404);// fails verifier s'il ya echec
        }
        $model->update($data);
        return response()->json($model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model=Category::find($id);
        if($model==null){
            return response()->json(["L'id ne correspond à aucune information"],404);// fails verifier s'il ya echec
        }
        $model->delete();
        return response()->json($model);
    }
}
