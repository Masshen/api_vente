<?php

namespace App\Http\Controllers\Api;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list=product::all();
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
        $validation=Validator::make($request->all(),[
            'name'=>'required|unique:products,name',
            'category'=>'required|exists:categories,id',//vérifier que cet id de catégories existe dans la table catégorie
            'logo'=>'image',
            'price'=>'required|numeric',
            'device'=>[Rule::in(['$','Fc'])]
        ]);
           if($validation->fails()){
            return response()->json($validation->getMessageBag(),422);// fails verifier s'il ya echec
        }
        $model = new product();
        $model->name=$request->name;
        $model->category_id=$request->category;
        $model->price=$request->price;
        $model->device=$request->device;
        $model->save();// methode pour enregistrer
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
        $model=product::find($id);
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
        $model=new product();
        $fillable=$model->getFillable();//récupérer les champs modifiables
        $requests=$request->all();//récupérer tous les champs envoyés
        foreach ($requests as $key => $value) {
            if(in_array($key,$fillable)){
                $data[$key]=$value;
            }
        }
        $validation=Validator::make($data,[
            'name'=>'min:5',
            'category'=>'exists:categories,id',//vérifier que cet id de catégories existe dans la table catégorie
            'logo'=>'image',
            'price'=>'required',
            'devise'=>[Rule::in(['$','Fc'])]//rule definie la regle
        ]);
        if($validation->fails()){
            return response()->json($validation->getMessageBag(),422);// fails verifier s'il ya echec
        }
        $model=product::find($id);
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
        $model=product::find($id);
        if($model==null){
            return response()->json(["L'id ne correspond à aucune information"],404);// fails verifier s'il ya echec
        }
        $model->delete();
        return response()->json($model);
    }
}
