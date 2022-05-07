<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FanArt;
use App\Models\Category;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Redirect;
use Auth;

class EvaluationController extends Controller
{
    //


    public $pageTitle = "Avaliações";
    public $titleButton = "Cadastrar ";
    public $route = "/fanart/new";

    public function  index(){
        $users = Auth::user();

        if ($users->type == 'admin' || $users->type == 'moderator' ){
            $evaluations = Evaluation::all()->sortByDesc("id");

        }
        else{
            $use_id = $users->id;
            $evaluations = Evaluation::where('id_user', $use_id)->get();
        }

        foreach ($evaluations as $key => $value)
        {
            $evaluations[$key]->user = User::find($evaluations[$key]->id_user);
            $evaluations[$key]->fanArt = FanArt::find($evaluations[$key]->id_fanArt);

        }

        return view('evaluation/evaluations', ['evaluations' => $evaluations, 'pageTitle' => $this->pageTitle]);
    }

    public  function  store(Request $request){
        $users = Auth::user();
//        dd($_POST);

        $evaluation = new Evaluation();
        $evaluation->star = $request->star;
        $evaluation->description = $request->description;
        $evaluation->status = 'pending';
        $evaluation->id_user = $users->id; //id for user evaluator
        $evaluation->id_fanArt = $request->id_fanArt;
        $inserted = $evaluation->save();

        if ($inserted){
          return redirect('public/index');

        }
    }

    public function show($id)
    {
        $evaluation = Evaluation::find($id);
        $evaluation->user = User::find($evaluation->id_user);
        $evaluation->fanart = FanArt::find($evaluation->id_fanArt);

        return view('evaluation/show', compact('evaluation'));
    }
    public function edit($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        if($evaluation){
            return view('evaluation/edit',['evaluation' => $evaluation]);
        }
        return Redirect::to('evaluation/evaluations');
    }

    public function update( $id, Request $request ){

        $evaluation = Evaluation::findOrFail($id);
        $data = $request->all();

        $evaluation->update($data);

        return Redirect::to('evaluation/evaluations');
    }

    public function toApprove(Request $request, $id){
        $evaluations = Evaluation::find($id);
        $data = $request->all();
        $data['status'] = 'approved';

        $response = $evaluations->update($data);



        $fanart_id = $evaluations->id_fanArt;

        if ($response){

            $averageRating = $this->evaluationFanartCount($fanart_id);
            $fanart = FanArt::find($fanart_id);
            $fanart->mediaRating = $averageRating;

            $fanart->update();

            $user_id = $fanart->id_user;

            $averageRatingUser = $this->evaluationUserCount($user_id);
            $user = User::find($user_id);
//            DD($user);
            $user->mediaRating = $averageRatingUser;
            $user->update();

            return redirect('evaluation/evaluations');
        }

    }
    public function destroy($id)
    {
        $evaluation = Evaluation::find($id);

        if (isset($evaluation)) {
            $evaluation->delete();
        }

        return redirect('evaluation/evaluations');
    }

    public function  evaluationFanartCount($fanart_id){
        $sumEvaluation = 0;
        $averageRating = 0;
        $cont = 0;
        $evaluations = Evaluation::where('id_fanArt',$fanart_id)->get();

        foreach($evaluations as $evaluation){
            if($evaluation->status == 'approved'){
                $sumEvaluation = $sumEvaluation + intval($evaluation->star);
                $cont++;
            }
        }
        if($cont > 0){
            $averageRating = floatval($sumEvaluation /  $cont);
        }

        return $averageRating;
    }

    public function evaluationUserCount($user_id){
        $sumEvaluation = 0;
        $averageRating = 0;
        $cont = 0;
        $evaluations = Evaluation::all();

        foreach ($evaluations as $key => $value)
        {
            $evaluations[$key]->fanArt = FanArt::find($evaluations[$key]->id_fanArt);
        }

        foreach($evaluations as $evaluation){
            $idUser = $evaluation->fanArt->id_user;
            if( $idUser == $user_id && $evaluation->status == 'approved'){
                $sumEvaluation = $sumEvaluation + intval($evaluation->star);
                $cont++;
            }
        }
        if($cont > 0){
            $averageRating = floatval($sumEvaluation /  $cont);
        }

        return $averageRating;
    }
}
