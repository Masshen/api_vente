<?php

namespace App\Http\Controllers\Api;

use App\Models\cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Cartcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = cart::all();
        return response()->json($list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
           'quantite'=>'required|numeric',
           'prix'=>'required|numeric',
           'devise'=>['required',Rule::in(['$','Fc'])],//rule definie la regle
           'id_produit'=>'required|exists:products,id',
           'id_vente'=>'required|exists:sales,id'
        ]);
        if($validation->fails()){
            return response()->json($validation->getMessageBag(),422);
        }

        $model = new cart();
        $model->quantity = $request->quantite;
        $model->price = $request->prix;
        $model->device = $request->devise;
        $model->product_id = $request->id_produit;
        $model->sale_id = $request->id_vente;
        $model->save();
        return response()->json($model);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = cart::find($id);
        if($model==null){
            return response()->json(["l'information introduite n'est pas conforme"],404);
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
        $model=new cart();
        $fillable=$model->getFillable();//récupérer les champs modifiables
        $requests=$request->all();//récupérer tous les champs envoyés
        foreach ($requests as $key => $value) {
            if(in_array($key,$fillable)){
                $data[$key]=$value;
            }
        }
        $validation=Validator::make($data,[
           'quantite'=>'numeric',
           'prix'=>'numeric',
           'devise'=>[Rule::in(['$','Fc'])],//rule definie la regle
           'id_produit'=>'exists:products,id',
           'id_vente'=>'exists:sales,id'
        ]);
        if($validation->fails()){
            return response()->json($validation->getMessageBag(),422);// fails verifier s'il ya echec
        }
        $model=cart::find($id);
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
        $model = cart::find($id);
        if($model==null){
            return response()->json(["l'information introduite n'est pas correcte"],404);
        }
        $model->delete();
        return response()->json($model);
    }
}
